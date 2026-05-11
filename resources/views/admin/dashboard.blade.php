@extends('layouts.app')

@section('title', 'Admin Dashboard - Group 6')

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="text-center mb-10">
        <div class="eyebrow mb-3">Admin Panel</div>
        <h2 class="section-title">Dashboard</h2>
        <div class="section-divider"></div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">

        {{-- Total Members --}}
        <div class="member-card p-6 text-center group">
            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-500/15 transition-colors">
                <i class="fa-solid fa-users text-blue-400"></i>
            </div>
            <div class="font-syne text-4xl font-bold text-white/90 leading-none mb-2" style="font-family: 'Syne', sans-serif;">
                {{ $totalMembers }}
            </div>
            <div class="text-slate-500 text-sm uppercase tracking-widest" style="font-size: 0.7rem; letter-spacing: 2px;">
                Total Members
            </div>
        </div>

        {{-- Admins --}}
        <div class="member-card p-6 text-center group">
            <div class="w-12 h-12 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-500/15 transition-colors">
                <i class="fa-solid fa-shield-halved text-purple-400"></i>
            </div>
            <div class="font-syne text-4xl font-bold text-white/90 leading-none mb-2" style="font-family: 'Syne', sans-serif;">
                {{ $adminCount }}
            </div>
            <div class="text-slate-500 text-sm uppercase tracking-widest" style="font-size: 0.7rem; letter-spacing: 2px;">
                Admins
            </div>
        </div>

        {{-- Team Members --}}
        <div class="member-card p-6 text-center group">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-500/15 transition-colors">
                <i class="fa-solid fa-user-check text-emerald-400"></i>
            </div>
            <div class="font-syne text-4xl font-bold text-white/90 leading-none mb-2" style="font-family: 'Syne', sans-serif;">
                {{ $memberCount }}
            </div>
            <div class="text-slate-500 text-sm uppercase tracking-widest" style="font-size: 0.7rem; letter-spacing: 2px;">
                Team Members
            </div>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="flex justify-center">
        <a href="{{ route('admin.members') }}" class="btn-primary px-8 py-3 text-base">
            <i class="fa-solid fa-users-gear"></i>
            Manage Members
        </a>
    </div>

</div>
@endsection