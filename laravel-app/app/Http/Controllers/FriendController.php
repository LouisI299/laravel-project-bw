<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller
{
    //
    public function add(Request $request, $friendId)
    {
        $friend = User::findOrFail($friendId);

        if (!$request->user()->friends()->where('friend_id', $friendId)->exists()) {
            $request->user()->friends()->attach($friendId);
            return back()->with('success', 'Friend added!');
        }

        return back()->with('error', 'Already friends!');
    }

    // Remove a friend
    public function remove(Request $request, $friendId)
    {
        $friend = User::findOrFail($friendId);

        $request->user()->friends()->detach($friendId);
        return back()->with('success', 'Friend removed!');
    }
}