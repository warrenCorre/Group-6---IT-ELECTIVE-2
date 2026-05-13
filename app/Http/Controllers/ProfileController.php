<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        // Always fetch fresh from DB — Auth::user() returns a cached copy
        $user = User::findOrFail(Auth::id());
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        // Always fetch fresh from DB so the current photo is shown
        $user = User::findOrFail(Auth::id());
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'bio'           => 'nullable|string',
            'age'           => 'nullable|integer|min:1|max:150',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'bio'   => $request->bio,
            'age'   => $request->age,
        ];

        if ($request->hasFile('profile_photo')) {
            // Delete the old photo file from disk
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            // Store new photo under storage/app/public/profiles/
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $data['profile_photo'] = $path;
        }

        $user->update($data);

        // Force the session guard to use the updated model so the nav avatar refreshes
        Auth::setUser($user->fresh());

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password updated successfully.');
    }
}