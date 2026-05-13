<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Maximum failed attempts before lockout.
     */
    protected int $maxAttempts = 3;

    /**
     * Lockout duration in minutes.
     */
    protected int $lockoutMinutes = 15;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Check if account is currently locked out
            if ($user->locked_until && Carbon::now()->lessThan($user->locked_until)) {
                $remaining = (int) ceil(Carbon::now()->diffInMinutes($user->locked_until, false));
                $remaining = max(1, $remaining);

                return back()->withErrors([
                    'email' => "Your account is temporarily locked due to too many failed attempts. Try again in {$remaining} minute(s), or use \"Forgot Password\" to reset your password.",
                ])->onlyInput('email');
            }

            // If lockout has naturally expired, reset counters
            if ($user->locked_until && Carbon::now()->greaterThanOrEqualTo($user->locked_until)) {
                $user->failed_login_attempts = 0;
                $user->locked_until          = null;
                $user->save();
            }
        }

        // Attempt authentication
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Reset failed attempts on successful login
            if ($user) {
                $user->failed_login_attempts = 0;
                $user->locked_until          = null;
                $user->save();
            }

            return redirect()->intended('/');
        }

        // Authentication failed — track failed attempt
        if ($user) {
            $user->failed_login_attempts = ($user->failed_login_attempts ?? 0) + 1;

            if ($user->failed_login_attempts >= $this->maxAttempts) {
                // Lock the account
                $user->locked_until          = Carbon::now()->addMinutes($this->lockoutMinutes);
                $user->failed_login_attempts = 0;
                $user->save();

                return back()->withErrors([
                    'email' => "Too many failed attempts. Your account has been locked for {$this->lockoutMinutes} minutes. You can also use \"Forgot Password\" to reset your password.",
                ])->onlyInput('email');
            }

            $user->save();

            $attemptsLeft = $this->maxAttempts - $user->failed_login_attempts;

            return back()->withErrors([
                'email' => "Incorrect credentials. You have {$attemptsLeft} attempt(s) remaining before your account is temporarily locked.",
            ])->onlyInput('email');
        }

        // No matching email — generic error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}