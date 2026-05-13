@extends('layouts.app')

@section('title', 'My Profile - Group 6')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="text-center mb-8">
        <div class="eyebrow mb-3">Account</div>
        <h2 class="section-title">My Profile</h2>
        <div class="section-divider"></div>
    </div>

    {{-- Success / Error flash --}}
    @if(session('success'))
        <div class="mb-6 max-w-sm mx-auto px-4 py-3 rounded-lg bg-green-900/40 border border-green-700/50 text-green-300 text-sm text-center">
            <i class="fa-solid fa-circle-check mr-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-center">
        <div class="member-card w-full max-w-sm p-8 text-center">

            {{-- Avatar --}}
            <div class="profile-avatar mx-auto" style="width: 100px; height: 100px; margin-bottom: 18px;">
                @if($user->profile_photo)
                    {{-- FIX: added w-full h-full object-cover so the stored photo fills the avatar circle --}}
                    <img src="{{ url('storage-file/' . $user->profile_photo) }}"
                         alt="{{ $user->name }}"
                         class="w-full h-full object-cover rounded-full">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b5570&color=fff&size=100"
                         alt="{{ $user->name }}"
                         class="w-full h-full object-cover rounded-full">
                @endif
            </div>

            {{-- Name & role --}}
            <h3 class="member-name text-xl">{{ $user->name }}</h3>
            @if($user->isAdmin())
                <div class="mt-1.5">
                    <span class="badge badge-purple">
                        <i class="fa-solid fa-shield-halved text-xs"></i> {{ ucfirst($user->role) }}
                    </span>
                </div>
            @else
                <div class="member-role mt-1.5">{{ ucfirst($user->role) }}</div>
            @endif

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-transparent via-slate-600/50 to-transparent my-4"></div>

            {{-- Info --}}
            <div class="info-line justify-center">
                <i class="fa-regular fa-envelope"></i>
                <span class="text-sm">{{ $user->email }}</span>
            </div>

            @if($user->age)
            <div class="info-line justify-center">
                <i class="fa-regular fa-calendar"></i>
                <span class="text-sm">{{ $user->age }} years old</span>
            </div>
            @endif

            {{-- Bio --}}
            <div class="bio-text text-left mt-4">
                {{ $user->bio ?? 'No bio provided.' }}
            </div>

            {{-- Actions --}}
            <div class="mt-7 space-y-3">
                <a href="{{ route('profile.edit') }}" class="btn-primary w-full py-3">
                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                    Edit Profile
                </a>

                <button type="button" onclick="showPasswordModal()"
                        class="btn-primary w-full py-3"
                        style="background: linear-gradient(145deg, #1e2a3a, #151f2e); border-color: rgba(60,80,110,0.5);">
                    <i class="fa-solid fa-key text-sm"></i>
                    Change Password
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ── Password Change Modal ── --}}
<div id="passwordModal"
     class="fixed inset-0 bg-black/70 backdrop-blur-sm items-center justify-center z-50 hidden p-4"
     onclick="if(event.target === this) hidePasswordModal()">

    <div class="member-card w-full max-w-md p-8" onclick="event.stopPropagation()">

        <div class="flex items-center justify-between mb-6">
            <h3 class="section-title text-xl">Change Password</h3>
            <button onclick="hidePasswordModal()"
                    class="w-8 h-8 rounded-full bg-slate-800/60 border border-slate-700/50 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700/60 transition-all">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
            @csrf

            <div>
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-input" required>
                @error('current_password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-input" required>
                @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>

            <div class="h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent"></div>

            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 py-3">
                    <i class="fa-solid fa-floppy-disk"></i> Update Password
                </button>
                <button type="button" onclick="hidePasswordModal()"
                        class="btn-primary flex-1 py-3"
                        style="background: linear-gradient(145deg, #1e2a3a, #151f2e); border-color: rgba(60,80,110,0.5);">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function showPasswordModal() {
    const m = document.getElementById('passwordModal');
    m.classList.remove('hidden');
    m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function hidePasswordModal() {
    const m = document.getElementById('passwordModal');
    m.classList.add('hidden');
    m.classList.remove('flex');
    document.body.style.overflow = '';
}
@if($errors->has('current_password') || $errors->has('password'))
    showPasswordModal();
@endif
</script>
@endpush
@endsection