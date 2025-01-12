<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    public function promote(User $user)
    {
        $user->is_admin = true;
        $user->save();

        return redirect()->back()->with('status', 'User promoted to admin!');
    }

    public function demote(User $user){
        $user->is_admin = false;
        $user->save();

        return redirect()->back()->with('status', 'Admin demoted to user!');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.users')->with('status', 'User created successfully!');
    }
}