<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function members()
    {
        // Show ALL users EXCEPT the current logged-in admin
        $currentUser = auth()->user();
        $users = User::where('id', '!=', $currentUser->id)
                      ->orderBy('name')
                      ->get();

        return view('admin.members', compact('users'));
    }

    public function createMember()
    {
        $roles = ['Developer', 'Designer', 'QA Tester', 'Project Manager'];
        return view('admin.create-member', compact('roles'));
    }

    public function storeMember(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:6',
            'role'          => 'required|string|in:Developer,Designer,QA Tester,Project Manager',
            'age'           => 'nullable|integer|min:1|max:150',
            'bio'           => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'age'      => $request->age,
            'bio'      => $request->bio,
        ];

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $data['profile_photo'] = $path;
        }

        User::create($data);

        return redirect()->route('admin.members')->with('success', 'Member created successfully.');
    }

    public function editMember(User $user)
    {
        $currentUser = auth()->user();

        if ($user->id === $currentUser->id) {
            return redirect()->route('admin.members')->with('error', 'Use Profile page to edit your own account.');
        }

        $roles = ['Developer', 'Designer', 'QA Tester', 'Project Manager'];

        // Always use a fresh model so the current profile_photo is shown
        $user = $user->fresh();

        return view('admin.edit-member', compact('user', 'roles'));
    }

    public function updateMember(Request $request, User $user)
    {
        $currentUser = auth()->user();

        if ($user->id === $currentUser->id) {
            return redirect()->route('admin.members')->with('error', 'Use Profile page to edit your own account.');
        }

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'role'          => 'required|string|in:Developer,Designer,QA Tester,Project Manager',
            'age'           => 'nullable|integer|min:1|max:150',
            'bio'           => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
            'age'   => $request->age,
            'bio'   => $request->bio,
        ];

        if ($request->hasFile('profile_photo')) {
            // Delete old photo from storage first
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profiles', 'public');
            $data['profile_photo'] = $path;
        }

        $user->update($data);

        return redirect()->route('admin.members')->with('success', 'Member updated successfully.');
    }

    public function destroy(User $user)
    {
        $currentUser = auth()->user();

        if ($user->id === $currentUser->id) {
            return redirect()->route('admin.members')->with('error', 'You cannot delete your own account.');
        }

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();

        return redirect()->route('admin.members')->with('success', 'Member deleted successfully.');
    }
}