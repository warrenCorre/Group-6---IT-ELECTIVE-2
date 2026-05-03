@extends('layouts.app')

@section('title', 'Login - Group 6')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center">
    <div class="welcome-card w-full max-w-md">
        <h2 class="text-3xl font-light text-center mb-8"><b>Login</b></h2>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-slate-400 mb-2">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       class="form-input" placeholder="Enter your email" required autofocus>
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-slate-400 mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" class="form-input pr-10" 
                           placeholder="Enter your password" required>
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-300">
                        <i class="fa-regular fa-eye" id="password-icon"></i>
                    </button>
                </div>
            </div>

            <div class="mb-6 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded bg-slate-800 border-slate-600">
                <label for="remember" class="ml-2 text-sm text-slate-400">Remember me</label>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="btn-primary px-8 py-3">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush
@endsection