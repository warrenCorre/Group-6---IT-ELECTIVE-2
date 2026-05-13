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
        // Always re-fetch from DB so we get the latest profile_photo
        $user = User::find(Auth::id());
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        // Always re-fetch from DB so the edit form shows the current photo
        $user = User::find(Auth::id());
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $rules = [
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'bio'           => 'nullable|string',
            'age'           => 'nullable|integer|min:1|max:150',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $request->validate($rules);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'bio'   => $request->bio,
            'age'   => $request->age,
        ];

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if it exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new photo and save path
            $path = $request->file('profile_photo')->store('profiles', 'public');
            $data['profile_photo'] = $path;
        }

        $user->update($data);

        // Re-login the user so Auth::user() reflects the updated model
        // (the session guard caches the old model; this forces a fresh load)
        Auth::setUser($user->fresh());

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password updated successfully.');
    }
}