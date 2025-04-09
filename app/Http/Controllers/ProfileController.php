<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatar = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatar;
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->back()
            ->with('success', 'Password updated successfully');
    }

    public function updatePreferences(Request $request)
    {
        $user = auth()->user();
        
        $user->update([
            'email_notifications' => $request->has('email_notifications'),
            'marketing_emails' => $request->has('marketing_emails')
        ]);

        return redirect()
            ->back()
            ->with('success', 'Preferences updated successfully');
    }
} 