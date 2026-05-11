@extends('layouts.app')

@section('title', 'Reset Password - Group 6')

@section('content')
<div class="min-h-[82vh] flex items-center justify-center">
    <div class="welcome-card w-full max-w-md">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500/20 to-indigo-600/20 border border-blue-500/25 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-shield-halved text-blue-400 text-lg"></i>
            </div>
            <h2 class="section-title text-2xl">Reset Password</h2>
            <p class="text-slate-500 text-sm mt-1.5" style="font-family: 'DM Sans', sans-serif;">
                Enter your new password below.
            </p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            {{-- Hidden token + email --}}
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email --}}
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">
                        <i class="fa-regular fa-envelope text-sm"></i>
                    </span>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', $email) }}"
                           class="form-input pl-10"
                           placeholder="you@example.com"
                           required autocomplete="email">
                </div>
                @error('email')
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </span>
                    <input type="password" name="password" id="password"
                           class="form-input pl-10 pr-12"
                           placeholder="••••••••"
                           required autocomplete="new-password">
                    <button type="button" onclick="togglePassword('password')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition-colors">
                        <i class="fa-regular fa-eye text-sm" id="password-icon"></i>
                    </button>
                </div>
                <p class="text-slate-600 text-xs mt-1.5" style="font-family: 'DM Sans', sans-serif;">Minimum 8 characters.</p>
                @error('password')
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">
                        <i class="fa-solid fa-lock text-sm"></i>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="form-input pl-10 pr-12"
                           placeholder="••••••••"
                           required autocomplete="new-password">
                    <button type="button" onclick="togglePassword('password_confirmation')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition-colors">
                        <i class="fa-regular fa-eye text-sm" id="password_confirmation-icon"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit" class="btn-primary w-full py-3 text-base">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save New Password
                </button>
            </div>
        </form>

        {{-- Back to login --}}
        <div class="mt-6 text-center">
            <a href="{{ route('login') }}"
               class="text-sm text-slate-500 hover:text-slate-300 transition-colors inline-flex items-center gap-1.5"
               style="font-family: 'DM Sans', sans-serif;">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to Sign In
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon  = document.getElementById(fieldId + '-icon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
@endpush
@endsection