@extends('layouts.app')

@section('title', 'Our Team - Group 6')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="text-center mb-10">
        <div class="eyebrow mb-3">Group 6 • IT Elective 2</div>
        <h2 class="section-title">Our Team</h2>
        <div class="section-divider"></div>
        <p class="text-slate-400 mt-4 text-sm" style="font-family: 'DM Sans', sans-serif;">
            Meet the amazing people behind Group 6
        </p>
    </div>

    {{-- Members grid --}}
    <div class="members-grid">
        @forelse($members as $member)
        <div class="member-card grid-card" style="animation: pageIn 0.4s cubic-bezier(0.22, 1, 0.36, 1) both; animation-delay: {{ $loop->index * 60 }}ms;">

            {{-- Avatar --}}
            <div class="profile-avatar">
                @if($member->profile_photo)
                    <img src="{{ url('storage-file/' . $member->profile_photo) }}" alt="{{ $member->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=3b5570&color=fff&size=84" alt="{{ $member->name }}">
                @endif
            </div>

            {{-- Name & role --}}
            <h3 class="member-name mt-1">{{ $member->name }}</h3>
            <div class="member-role mt-1.5">{{ $member->role }}</div>

            {{-- Divider --}}
            <div class="h-px bg-gradient-to-r from-transparent via-slate-600/50 to-transparent my-3"></div>

            {{-- Info lines --}}
            <div class="info-line justify-center">
                <i class="fa-regular fa-envelope"></i>
                <span class="truncate text-xs" title="{{ $member->email }}">{{ $member->email }}</span>
            </div>

            @if($member->age)
            <div class="info-line justify-center">
                <i class="fa-regular fa-calendar"></i>
                <span class="text-xs">{{ $member->age }} y.o.</span>
            </div>
            @endif

            {{-- Bio --}}
            <div class="bio-text mt-3">
                {{ Str::limit($member->bio ?? 'No bio provided.', 100) }}
            </div>
        </div>

        @empty
        <div class="text-center w-full py-16">
            <div class="member-card p-10 max-w-sm mx-auto text-center">
                <div class="w-16 h-16 rounded-full bg-slate-800/60 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-regular fa-users text-3xl text-slate-500"></i>
                </div>
                <h3 class="member-name mb-2">No Team Members</h3>
                <p class="text-slate-500 text-sm">There are no team members to display at this time.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection