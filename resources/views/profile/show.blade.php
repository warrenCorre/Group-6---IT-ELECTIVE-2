@extends('layouts.app')

@section('title', 'My Profile - Group 6')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h2 class="text-4xl font-light text-white/90">My Profile</h2>
        <div class="h-0.5 w-20 bg-indigo-800/60 mx-auto mt-2"></div>
    </div>

    <div class="flex justify-center">
        <div class="member-card w-full max-w-md p-8">
            <div class="profile-avatar">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b5570&color=fff&size=80" alt="{{ $user->name }}">
                @endif
            </div>
            
            <h3 class="text-2xl font-medium text-white">{{ $user->name }}</h3>
            <div class="text-indigo-300 text-sm font-semibold mt-0.5 capitalize">{{ $user->role }}</div>
            
            <div class="info-line">
                <i class="fa-regular fa-envelope"></i>
                <span>{{ $user->email }}</span>
            </div>
            
            @if($user->age)
            <div class="info-line">
                <i class="fa-regular fa-calendar"></i>
                <span>{{ $user->age }} y.o.</span>
            </div>
            @endif
            
            <div class="bio-text">
                {{ $user->bio ?? 'No bio provided.' }}
            </div>

            <div class="mt-6 space-y-3">
                <a href="{{ route('profile.edit') }}" class="btn-primary inline-block w-full text-center">
                    Edit Profile
                </a>
                
                <button type="button" onclick="showPasswordModal()" class="btn-primary inline-block w-full text-center" style="background: linear-gradient(145deg, #2a4b5b, #1d3e44);">
                    Change Password
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Password Change Modal -->
<div id="passwordModal" class="fixed inset-0 bg-black/70 items-center justify-center z-50 hidden" onclick="if(event.target === this) hidePasswordModal()">
    <div class="member-card w-full max-w-md p-6">
        <h3 class="text-2xl font-light text-white/90 mb-4">Change Password</h3>
        
        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-400 mb-2">Current Password</label>
                <input type="password" name="current_password" class="form-input" required>
                @error('current_password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-400 mb-2">New Password</label>
                <input type="password" name="password" class="form-input" required>
                @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-400 mb-2">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1">Update Password</button>
                <button type="button" onclick="hidePasswordModal()" class="btn-primary flex-1">Cancel</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showPasswordModal() {
    const modal = document.getElementById('passwordModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hidePasswordModal() {
    const modal = document.getElementById('passwordModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

@if($errors->has('current_password') || $errors->has('password'))
    showPasswordModal();
@endif
</script>
@endpush
@endsection