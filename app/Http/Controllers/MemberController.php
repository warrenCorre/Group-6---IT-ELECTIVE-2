<?php

namespace App\Http\Controllers;

use App\Models\User;

class MemberController extends Controller
{
    // Public view - anyone can see (no login required)
    public function publicIndex()
    {
        // Only show regular members (Developer, Designer, QA Tester, Project Manager)
        $members = User::whereIn('role', ['Developer', 'Designer', 'QA Tester', 'Project Manager'])
                      ->orderBy('name')
                      ->get();
        
        return view('members.public', compact('members'));
    }

    // Authenticated users view (same view but different route)
    public function index()
    {
        // Only show regular members
        $members = User::whereIn('role', ['Developer', 'Designer', 'QA Tester', 'Project Manager'])
                      ->orderBy('name')
                      ->get();
        
        return view('members.index', compact('members'));
    }
}