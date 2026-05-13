@extends('layouts.app')

@section('title', 'Manage Members - Group 6')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="text-center mb-8">
        <div class="eyebrow mb-3">Admin Panel</div>
        <h2 class="section-title">Manage Members</h2>
        <div class="section-divider"></div>
    </div>

    {{-- Action bar --}}
    <div class="flex justify-end mb-8 px-2">
        <a href="{{ route('admin.members.create') }}" class="btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            Create New Member
        </a>
    </div>

    @if($users->count() > 0)
    <div class="members-grid">
        @foreach($users as $user)
        <div class="member-card grid-card" style="animation: pageIn 0.4s cubic-bezier(0.22, 1, 0.36, 1) both; animation-delay: {{ $loop->index * 50 }}ms;">

            {{-- "You" indicator --}}
            @if($user->id === auth()->user()->id)
            <div class="absolute -top-2 left-1/2 -translate-x-1/2">
                <span class="badge badge-blue text-xs py-1 px-3 shadow-lg">
                    <i class="fa-solid fa-user text-xs"></i> You
                </span>
            </div>
            @endif

            {{-- Avatar --}}
            <div class="profile-avatar">
                @if($user->profile_photo)
                    <img src="{{ url('storage-file/' . $user->profile_photo) }}" alt="{{ $user->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b5570&color=fff&size=84" alt="{{ $user->name }}">
                @endif
            </div>

            {{-- Name & role --}}
            <h3 class="member-name mt-1 border-b-5">{{ $user->name }}</h3>
            <div class="mt-1.5">
                @if($user->isAdmin())
                    <span class="badge badge-purple">
                        <i class="fa-solid fa-shield-halved text-xs"></i> {{ ucfirst($user->role) }}
                    </span>
                @else
                    <span class="badge badge-blue">{{ ucfirst($user->role) }}</span>
                @endif
            </div>

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-transparent via-slate-600/50 to-transparent my-3"></div>

            {{-- Info --}}
            <div class="info-line justify-center">
                <i class="fa-regular fa-envelope"></i>
                <span class="truncate text-xs" title="{{ $user->email }}">{{ $user->email }}</span>
            </div>

            @if($user->age)
            <div class="info-line justify-center">
                <i class="fa-regular fa-calendar"></i>
                <span class="text-xs">{{ $user->age }} y.o.</span>
            </div>
            @endif

            {{-- Bio --}}
            <div class="bio-text mt-3">
                {{ Str::limit($user->bio ?? 'No bio provided.', 60) }}
            </div>

            {{-- Actions --}}
            @if($user->id !== auth()->user()->id)
                <div class="mt-4 flex gap-2 justify-center">
                    @if(!$user->isAdmin() || auth()->user()->isAdmin())
                        <a href="{{ route('admin.members.edit', $user) }}"
                           class="btn-primary text-xs px-4 py-2">
                            <i class="fa-solid fa-pen-to-square text-xs"></i> Edit
                        </a>
                    @endif

                    @if(!$user->isAdmin())
                        <form method="POST" action="{{ route('admin.members.destroy', $user) }}"
                              onsubmit="return confirm('Delete {{ addslashes($user->name) }}? This cannot be undone.');">
                            @csrf
                            <button type="submit" class="btn-danger text-xs px-4 py-2">
                                <i class="fa-solid fa-trash-can text-xs"></i> Delete
                            </button>
                        </form>
                    @endif
                </div>
            @else
                <div class="mt-4">
                    <a href="{{ route('profile.edit') }}" class="btn-primary text-xs px-4 py-2">
                        <i class="fa-solid fa-pen-to-square text-xs"></i> Edit Profile
                    </a>
                </div>
            @endif

        </div>
        @endforeach
    </div>

    @else
    <div class="text-center py-16">
        <div class="member-card p-10 max-w-sm mx-auto text-center">
            <div class="w-16 h-16 rounded-full bg-slate-800/60 flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-users text-3xl text-slate-500"></i>
            </div>
            <h3 class="member-name mb-2">No Members Found</h3>
            <p class="text-slate-500 text-sm mb-6">There are no members to display.</p>
            <a href="{{ route('admin.members.create') }}" class="btn-primary text-sm">
                <i class="fa-solid fa-plus text-xs"></i> Create First Member
            </a>
        </div>
    </div>
    @endif

</div>
@endsection

@push('styles')
<style>
.member-card.grid-card { position: relative; overflow: visible; }
</style>
@endpush