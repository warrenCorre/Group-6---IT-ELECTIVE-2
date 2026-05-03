@extends('layouts.app')

@section('title', 'Admin Dashboard - Group 6')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="text-center mb-8">
        <h2 class="text-4xl font-light text-white/90">Admin Dashboard</h2>
        <div class="h-0.5 w-20 bg-indigo-800/60 mx-auto mt-2"></div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="member-card p-6 text-center">
            <div class="text-4xl font-light text-indigo-300">{{ $totalMembers }}</div>
            <div class="text-slate-400 mt-2">Total Members</div>
        </div>
        
        <div class="member-card p-6 text-center">
            <div class="text-4xl font-light text-indigo-300">{{ $adminCount }}</div>
            <div class="text-slate-400 mt-2">Admins</div>
        </div>
        
        <div class="member-card p-6 text-center">
            <div class="text-4xl font-light text-indigo-300">{{ $memberCount }}</div>
            <div class="text-slate-400 mt-2">Team Members</div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('admin.members') }}" class="btn-primary inline-block">
            Manage Members
        </a>
    </div>
</div>
@endsection