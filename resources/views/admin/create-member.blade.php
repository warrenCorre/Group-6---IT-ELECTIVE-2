@extends('layouts.app')

@section('title', 'Create Member - Group 6')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="text-center mb-6">
        <h2 class="text-4xl font-light text-white/90">Create Member</h2>
        <div class="h-0.5 w-20 bg-indigo-800/60 mx-auto mt-2"></div>
    </div>

    <div class="flex justify-center">
        <div class="member-card w-full max-w-2xl p-6">
            <form method="POST" action="{{ route('admin.members.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-1/3 text-center">
                        <div class="profile-avatar mx-auto mb-3">
                            <img src="https://ui-avatars.com/api/?name=New+Member&background=3b5570&color=fff&size=80"
                                 alt="Preview" id="preview" class="w-full h-full object-cover">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Profile Photo</label>
                            <input type="file" name="profile_photo" id="profile_photo"
                                   class="form-input text-sm py-1.5" accept="image/*">
                            <p class="text-xs text-slate-500 mt-0.5">Max 2MB</p>
                            @error('profile_photo') <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="md:w-2/3 space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-input py-1.5" placeholder="Full name" required>
                            @error('name') <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-input py-1.5" placeholder="email@example.com" required>
                            @error('email') <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                            <input type="password" name="password"
                                   class="form-input py-1.5" placeholder="Min. 6 characters" required>
                            @error('password') <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-1">Role</label>
                        <select name="role" class="form-select py-1.5" required>
                            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select a role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-400 mb-1">Age</label>
                        <input type="number" name="age" value="{{ old('age') }}"
                               class="form-input py-1.5" placeholder="e.g., 20">
                        @error('age') <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-1">Bio</label>
                    <textarea name="bio" rows="2" class="form-textarea py-1.5"
                              placeholder="Brief description...">{{ old('bio') }}</textarea>
                    @error('bio') <p class="text-red-400 text-xs mt-0.5">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="btn-primary flex-1 py-2 text-sm">
                        Create Member
                    </button>
                    <a href="{{ route('admin.members') }}" class="btn-primary flex-1 text-center py-2 text-sm">
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