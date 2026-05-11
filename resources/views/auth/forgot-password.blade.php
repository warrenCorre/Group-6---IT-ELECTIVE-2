@extends('layouts.app')

@section('title', 'Forgot Password - Group 6')

@section('content')
<div class="min-h-[82vh] flex items-center justify-center">
    <div class="welcome-card w-full max-w-md">

        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500/20 to-orange-600/20 border border-amber-500/25 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-key text-amber-400 text-lg"></i>
            </div>
            <h2 class="section-title text-2xl">Forgot Password</h2>
            <p class="text-slate-500 text-sm mt-1.5" style="font-family: 'DM Sans', sans-serif;">
                Enter your email and we'll send you a reset link.
            </p>
        </div>

        {{-- Success status --}}
        @if (session('status'))
            <div class="mb-5 flex items-start gap-3 rounded-xl bg-green-500/10 border border-green-500/25 px-4 py-3">
                <i class="fa-solid fa-circle-check text-green-400 mt-0.5 shrink-0"></i>
                <p class="text-green-400 text-sm" style="font-family: 'DM Sans', sans-serif;">{{ session('status') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">
                        <i class="fa-regular fa-envelope text-sm"></i>
                    </span>
                    <input type="email" name="email" id="email"
                           value="{{ old('email') }}"
                           class="form-input pl-10"
                           placeholder="you@example.com"
                           required autofocus autocomplete="email">
                </div>
                @error('email')
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit" class="btn-primary w-full py-3 text-base">
                    <i class="fa-solid fa-paper-plane"></i>
                    Send Reset Link
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
@endsection