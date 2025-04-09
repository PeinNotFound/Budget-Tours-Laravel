<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('Users.index')->with('users', User::all());
    }

    public function edit(User $user)
    {
        return view('Users.edit')->with('user', $user);
    }

    public function update(Request $request, User $user)
    {
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
            ->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function makeAdmin(User $user)
    {
        $user->is_admin = !$user->is_admin;
        $user->save();

        return redirect(route('users.index'))->with('success', 
            $user->is_admin ? 'User has been made admin' : 'Admin privileges have been removed');
    }
}
