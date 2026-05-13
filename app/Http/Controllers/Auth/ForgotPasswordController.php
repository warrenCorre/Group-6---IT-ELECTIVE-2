<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    // ══════════════════════════════════════════════════════════
    //  STEP 1 — Show "Forgot Password" form (enter email)
    // ══════════════════════════════════════════════════════════

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // ══════════════════════════════════════════════════════════
    //  STEP 1 — Handle email submission → send 6-digit OTP
    // ══════════════════════════════════════════════════════════

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Always respond generically to prevent email enumeration
        if (!$user) {
            // Save email in session anyway so UX is consistent
            $request->session()->put('otp_email', $request->email);
            return redirect()->route('password.verify-otp')
                ->with('status', 'If that email exists, a 6-digit code has been sent.');
        }

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete any existing codes for this email
        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        // Store hashed OTP — expires in 1 hour
        DB::table('password_reset_codes')->insert([
            'email'      => $request->email,
            'code'       => Hash::make($otp),
            'used'       => false,
            'expires_at' => Carbon::now()->addHour(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Store email in session so subsequent steps don't need re-entry
        $request->session()->put('otp_email', $request->email);

        // Send OTP email
        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user, $otp));
        } catch (\Exception $e) {
            // Show real error in debug mode
            if (config('app.debug')) {
                return back()->withErrors([
                    'email' => '❌ Mail error: ' . $e->getMessage(),
                ]);
            }

            return back()->withErrors([
                'email' => 'Failed to send the code. Please check your mail configuration or try again.',
            ]);
        }

        return redirect()->route('password.verify-otp')
            ->with('status', 'A 6-digit code has been sent to your email. It expires in 1 hour.');
    }

    // ══════════════════════════════════════════════════════════
    //  STEP 2 — Show OTP verification form
    // ══════════════════════════════════════════════════════════

    public function showVerifyOtpForm(Request $request)
    {
        // If no email in session, redirect back to forgot password
        if (!$request->session()->has('otp_email')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please enter your email address first.']);
        }

        return view('auth.verify-otp', [
            'email' => $request->session()->get('otp_email'),
        ]);
    }

    // ══════════════════════════════════════════════════════════
    //  STEP 2 — Handle OTP code submission
    // ══════════════════════════════════════════════════════════

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $email = $request->session()->get('otp_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Session expired. Please start over.']);
        }

        // Find the latest unused, unexpired OTP record for this email
        $record = DB::table('password_reset_codes')
            ->where('email', $email)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->latest('created_at')
            ->first();

        if (!$record) {
            return back()->withErrors([
                'code' => 'This code is invalid or has expired. Please request a new one.',
            ]);
        }

        // Verify the OTP
        if (!Hash::check($request->code, $record->code)) {
            return back()->withErrors([
                'code' => 'Incorrect code. Please try again.',
            ]);
        }

        // Mark OTP as used immediately — cannot be reused
        DB::table('password_reset_codes')
            ->where('id', $record->id)
            ->update(['used' => true, 'updated_at' => Carbon::now()]);

        // Store verified flag and email in session for the reset step
        $request->session()->put('otp_verified', true);
        $request->session()->put('otp_email', $email); // keep email in session

        return redirect()->route('password.reset-form');
    }

    // ══════════════════════════════════════════════════════════
    //  STEP 3 — Show reset password form
    // ══════════════════════════════════════════════════════════

    public function showResetForm(Request $request)
    {
        // Guard: must have verified OTP first
        if (!$request->session()->get('otp_verified')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please verify your code first.']);
        }

        return view('auth.reset-password', [
            'email' => $request->session()->get('otp_email'),
        ]);
    }

    // ══════════════════════════════════════════════════════════
    //  STEP 3 — Handle new password submission
    // ══════════════════════════════════════════════════════════

    public function resetPassword(Request $request)
    {
        // Guard: must have verified OTP first
        if (!$request->session()->get('otp_verified')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Please verify your code first.']);
        }

        $email = $request->session()->get('otp_email');

        $request->validate([
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'No account found. Please start over.']);
        }

        // Update password and clear any lockout
        $user->password              = Hash::make($request->password);
        $user->failed_login_attempts = 0;
        $user->locked_until          = null;
        $user->save();

        // Clean up session
        $request->session()->forget(['otp_email', 'otp_verified']);

        // Clean up any leftover OTP records for this email
        DB::table('password_reset_codes')->where('email', $email)->delete();

        return redirect()->route('login')
            ->with('status', 'Your password has been reset successfully. You can now sign in.');
    }
}