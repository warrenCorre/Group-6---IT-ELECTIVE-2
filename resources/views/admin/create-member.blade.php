@extends('layouts.app')

@section('title', 'Manage Members - Group 6')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="text-center mb-8">
        <h2 class="text-4xl font-light text-white/90">Manage Members</h2>
        <div class="h-0.5 w-20 bg-indigo-800/60 mx-auto mt-2"></div>
    </div>

    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.members.create') }}" class="btn-primary inline-flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            Create New Member
        </a>
    </div>

    @if($users->count() > 0)
    <div class="members-grid">
        @foreach($users as $user)
        <div class="member-card">
            <div class="profile-avatar">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b5570&color=fff&size=80" alt="{{ $user->name }}">
                @endif
            </div>
            
            <h3 class="text-2xl font-medium text-white">{{ $user->name }}</h3>
            <div class="text-indigo-300 text-sm font-semibold capitalize mt-0.5">{{ $user->role }}</div>
            
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
                {{ Str::limit($user->bio ?? 'No bio provided.', 50) }}
            </div>

            <div class="mt-4 flex gap-2 justify-center">
                @if(auth()->user()->id !== $user->id)
                    @if(!$user->isAdmin() || auth()->user()->isAdmin())
                        <a href="{{ route('admin.members.edit', $user) }}" class="btn-primary text-sm px-4 py-2">
                            Edit
                        </a>
                    @endif
                    
                    @if(!$user->isAdmin())
                        <form method="POST" action="{{ route('admin.members.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger text-sm px-4 py-2">
                                Delete
                            </button>
                        </form>
                    @endif
                @endif
            </div>
            
            @if($user->id === auth()->user()->id)
                <div class="text-xs text-blue-400 mt-2">
                    <i class="fa-solid fa-user"></i> This is you
                </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <div class="member-card p-8 max-w-md mx-auto">
            <i class="fa-regular fa-users text-5xl text-slate-500 mb-4"></i>
            <h3 class="text-2xl text-slate-300 mb-2">No Members Found</h3>
            <p class="text-slate-400">There are no members to display.</p>
        </div>
    </div>
    @endif
</div>
@endsection