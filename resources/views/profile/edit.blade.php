@extends('layouts.app')

@section('title', 'Edit Profile - Group 6')

@section('content')
<div class="max-w-3xl mx-auto">

    {{-- Header --}}
    <div class="text-center mb-8">
        <div class="eyebrow mb-3">Account</div>
        <h2 class="section-title">Edit Profile</h2>
        <div class="section-divider"></div>
    </div>

    <div class="flex justify-center">
        <div class="member-card w-full max-w-md p-8">

            {{-- FIX: enctype="multipart/form-data" is required for file upload (was present, kept here) --}}
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Avatar upload --}}
                <div class="text-center mb-2">
                    <div class="relative inline-block">
                        <div class="profile-avatar mx-auto" style="width: 100px; height: 100px; margin-bottom: 10px; overflow: hidden; border-radius: 50%;">
                            @if($user->profile_photo)
                                {{-- FIX: added w-full h-full object-cover so stored photo fills the circle --}}
                                <img src="{{ asset('storage/' . $user->profile_photo) }}"
                                     alt="{{ $user->name }}"
                                     id="preview"
                                     class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b5570&color=fff&size=100"
                                     alt="{{ $user->name }}"
                                     id="preview"
                                     class="w-full h-full object-cover">
                            @endif
                        </div>
                        <label for="profile_photo"
                               class="absolute bottom-1 right-0 w-8 h-8 rounded-full bg-blue-600 border-2 border-slate-900 flex items-center justify-center cursor-pointer hover:bg-blue-500 transition-colors shadow-lg"
                               title="Change photo">
                            <i class="fa-solid fa-camera text-xs text-white"></i>
                        </label>
                    </div>
                    {{-- FIX: file input must have name="profile_photo" matching the controller validation --}}
                    <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*">
                    <p class="text-slate-600 text-xs mt-2">JPG, PNG, GIF · max 2MB</p>
                    @error('profile_photo') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Divider --}}
                <div class="h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent"></div>

                {{-- Name --}}
                <div>
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="form-input" placeholder="Full name" required>
                    @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="form-input" placeholder="email@example.com" required>
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Age --}}
                <div>
                    <label class="form-label">Age</label>
                    <input type="number" name="age" value="{{ old('age', $user->age) }}"
                           class="form-input" placeholder="e.g. 25" min="1" max="99">
                    @error('age') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Bio --}}
                <div>
                    <label class="form-label">Bio</label>
                    <textarea name="bio" rows="4" class="form-textarea"
                              placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Divider --}}
                <div class="h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent"></div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-1">
                    <button type="submit" class="btn-primary flex-1 py-3">
                        <i class="fa-solid fa-floppy-disk"></i> Save Changes
                    </button>
                    <a href="{{ route('profile.show') }}"
                       class="btn-primary flex-1 py-3 text-center"
                       style="background: linear-gradient(145deg, #1e2a3a, #151f2e); border-color: rgba(60,80,110,0.5);">
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
// Live preview when a new photo is picked
document.getElementById('profile_photo')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => { document.getElementById('preview').src = e.target.result; };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush