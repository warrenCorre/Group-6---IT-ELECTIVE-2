@extends('layouts.app')

@section('title', 'Group 6 • IT Elective 2 - Home')

@section('content')
<div class="welcome-card text-center">
    <div class="eyebrow text-sm uppercase tracking-widest mb-2">ACADEMIC YEAR 2025-2026</div>
    <h1 class="group-title mb-4">GROUP 6</h1>
    <div class="text-3xl font-light text-slate-300 mb-4 border-y border-slate-700/60 py-3">IT Elective 2</div>
    <p class="text-lg text-slate-400 max-w-xl mx-auto leading-relaxed">
        Welcome to our group page. We are a team of IT students exploring topics in technology.
    </p>
    <div class="mt-8 text-slate-500 text-sm flex items-center justify-center gap-3">
        <span class="h-6 w-px bg-slate-600"></span>
        <span>Meet the Team —</span>
        <span class="h-6 w-px bg-slate-600"></span>
    </div>

    <div class="mt-8">
        <a href="{{ route('team.public') }}" class="btn-primary inline-block">View Our Team</a>
    </div>
</div>
@endsection