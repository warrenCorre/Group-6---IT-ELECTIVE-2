@extends('layouts.app')

@section('title', 'Create Member - Group 6')

@section('content')
<div class="max-w-3xl mx-auto px-4">

    {{-- Header --}}
    <div class="text-center mb-8">
        <div class="eyebrow mb-3">Admin Panel</div>
        <h2 class="section-title">Create Member</h2>
        <div class="section-divider"></div>
    </div>

    <div class="member-card p-8">
        <form method="POST" action="{{ route('admin.members.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Top row: avatar + core fields --}}
            <div class="flex flex-col md:flex-row gap-8 mb-6">

                {{-- Avatar upload --}}
                <div class="md:w-48 flex-shrink-0 text-center">
                    <div class="relative inline-block">
                        <div class="profile-avatar mx-auto" style="width: 96px; height: 96px;">
                            <img src="https://ui-avatars.com/api/?name=New+Member&background=3b5570&color=fff&size=96"
                                 alt="Preview" id="preview" class="w-full h-full object-cover">
                        </div>
                        <label for="profile_photo"
                               class="absolute -bottom-1 -right-1 w-8 h-8 rounded-full bg-blue-600 border-2 border-slate-900 flex items-center justify-center cursor-pointer hover:bg-blue-500 transition-colors shadow-lg"
                               title="Upload photo">
                            <i class="fa-solid fa-camera text-xs text-white"></i>
                        </label>
                    </div>
                    <input type="file" name="profile_photo" id="profile_photo"
                           class="hidden" accept="image/*">
                    <p class="text-slate-600 text-xs mt-3">JPG, PNG · max 2MB</p>
                    @error('profile_photo')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Core fields --}}
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-input" placeholder="e.g. Juan dela Cruz" required>
                        @error('name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-input" placeholder="email@example.com" required>
                        @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-input" placeholder="Min. 6 characters" required>
                        @error('password') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Second row: role + age --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select a role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    @error('role') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Age</label>
                    <input type="number" name="age" value="{{ old('age') }}"
                           class="form-input" placeholder="e.g. 20" min="1" max="99">
                    @error('age') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Bio --}}
            <div class="mb-7">
                <label class="form-label">Bio</label>
                <textarea name="bio" rows="3" class="form-textarea"
                          placeholder="Brief description about this member...">{{ old('bio') }}</textarea>
                @error('bio') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent mb-6"></div>

            {{-- Actions --}}
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 py-3">
                    <i class="fa-solid fa-user-plus"></i>
                    Create Member
                </button>
                <a href="{{ route('admin.members') }}" class="btn-primary flex-1 py-3 text-center" style="background: linear-gradient(145deg, #1e2a3a, #151f2e); border-color: rgba(60,80,110,0.5);">
                    Cancel
                </a>
            </div>
        </form>
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
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush