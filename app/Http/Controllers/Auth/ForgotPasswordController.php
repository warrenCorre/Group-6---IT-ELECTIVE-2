<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    // ─────────────────────────────────────────────────────────
    //  FORGOT PASSWORD — show form
    // ─────────────────────────────────────────────────────────

    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // ─────────────────────────────────────────────────────────
    //  FORGOT PASSWORD — send reset link
    // ─────────────────────────────────────────────────────────

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Always show success message to prevent email enumeration
        if (!$user) {
            return back()->with('status', 'If an account with that email exists, a password reset link has been sent.');
        }

        // Generate a secure token
        $token = Str::random(64);

        // Delete any existing token for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Store the new token (hashed)
        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        // Send the reset email
        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
        } catch (\Exception $e) {
            return back()->withErrors([
                'email' => 'Failed to send reset email. Please check your mail configuration or try again later.',
            ]);
        }

        return back()->with('status', 'If an account with that email exists, a password reset link has been sent. Please check your inbox (and spam folder).');
    }

    // ─────────────────────────────────────────────────────────
    //  RESET PASSWORD — show form
    // ─────────────────────────────────────────────────────────

    public function showResetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    // ─────────────────────────────────────────────────────────
    //  RESET PASSWORD — handle form submission
    // ─────────────────────────────────────────────────────────

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'                 => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        // Find the reset record
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'No password reset request found for this email.']);
        }

        // Verify the token
        if (!Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['email' => 'This password reset token is invalid.']);
        }

        // Check if token has expired (60 minutes)
        $tokenCreatedAt = Carbon::parse($resetRecord->created_at);
        if (Carbon::now()->diffInMinutes($tokenCreatedAt) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'This password reset link has expired. Please request a new one.']);
        }

        // Update the user's password
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with that email address.']);
        }

        $user->password              = Hash::make($request->password);
        $user->failed_login_attempts = 0;
        $user->locked_until          = null;
        $user->save();

        // Delete the used token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset successfully. You can now sign in with your new password.');
    }
}