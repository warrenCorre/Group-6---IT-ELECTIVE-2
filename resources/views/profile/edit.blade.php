@extends('layouts.app')

@section('title', 'Edit Profile - Group 6')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h2 class="text-4xl font-light text-white/90">Edit Profile</h2>
        <div class="h-0.5 w-20 bg-indigo-800/60 mx-auto mt-2"></div>
    </div>

    <div class="flex justify-center">
        <div class="member-card w-full max-w-md p-8">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6 text-center">
                    <div class="profile-avatar mx-auto">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" id="preview">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b5570&color=fff&size=80" alt="{{ $user->name }}" id="preview">
                        @endif
                    </div>
                    
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-slate-400 mb-2">Profile Photo</label>
                        <input type="file" name="profile_photo" id="profile_photo" class="form-input" accept="image/*">
                        <p class="text-xs text-slate-500 mt-1">Max 2MB. JPG, PNG, GIF</p>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-400 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                           class="form-input" placeholder="Full name" required>
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-400 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="form-input" placeholder="email@example.com" required>
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-400 mb-2">Age</label>
                    <input type="number" name="age" value="{{ old('age', $user->age) }}" 
                           class="form-input" placeholder="e.g., 25">
                    @error('age') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-400 mb-2">Bio</label>
                    <textarea name="bio" rows="4" class="form-textarea" 
                              placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn-primary flex-1">
                        Update Profile
                    </button>
                    <a href="{{ route('profile.show') }}" class="btn-primary flex-1 text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('profile_photo')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush