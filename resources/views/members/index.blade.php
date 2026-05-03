@extends('layouts.app')

@section('title', 'Our Team - Group 6')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="text-center mb-8">
        <h2 class="text-4xl font-light text-white/90">Our Team</h2>
        <div class="h-0.5 w-20 bg-indigo-800/60 mx-auto mt-2"></div>
        <p class="text-slate-400 mt-4">Meet the amazing people behind Group 6</p>
    </div>

    <div class="members-grid">
        @forelse($members as $member)
        <div class="member-card">
            <div class="profile-avatar">
                @if($member->profile_photo)
                    <img src="{{ asset('storage/' . $member->profile_photo) }}" alt="{{ $member->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=3b5570&color=fff&size=80" alt="{{ $member->name }}">
                @endif
            </div>
            
            <h3 class="text-2xl font-medium text-white">{{ $member->name }}</h3>
            <div class="text-indigo-300 text-sm font-semibold mt-0.5">{{ $member->role }}</div>
            
            <div class="info-line">
                <i class="fa-regular fa-envelope"></i>
                <span>{{ $member->email }}</span>
            </div>
            
            @if($member->age)
            <div class="info-line">
                <i class="fa-regular fa-calendar"></i>
                <span>{{ $member->age }} y.o.</span>
            </div>
            @endif
            
            <div class="bio-text">
                {{ Str::limit($member->bio ?? 'No bio provided.', 100) }}
            </div>
        </div>
        @empty
        <div class="text-center w-full py-12">
            <div class="member-card p-8 max-w-md mx-auto">
                <i class="fa-regular fa-users text-5xl text-slate-500 mb-4"></i>
                <h3 class="text-2xl text-slate-300 mb-2">No Team Members Found</h3>
                <p class="text-slate-400">There are no team members to display at this time.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection