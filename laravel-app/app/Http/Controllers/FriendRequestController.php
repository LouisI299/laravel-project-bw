<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    //

    public function send(Request $request, $receiverId){
        $receiver = User::findOrFail($receiverId);

    // Prevent duplicate requests
        if (FriendRequest::where('sender_id', $request->user()->id)->where('receiver_id', $receiverId)->exists()) {
            return back()->with('error', 'Friend request already sent.');
        }

    // Create the friend request
        FriendRequest::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);
        
        return back()->with('success', 'Friend request sent.');
    }

    public function accept(Request $request, $requestId){
    $friendRequest = FriendRequest::findOrFail($requestId);

    if ($friendRequest->receiver_id !== $request->user()->id) {
        abort(403, 'Unauthorized action.');
    }

    // Update the status and create the friendship
    $friendRequest->update(['status' => 'accepted']);
    $request->user()->friends()->attach($friendRequest->sender_id);

    return back()->with('success', 'Friend request accepted.');
    }
    public function decline(Request $request, $requestId){
    $friendRequest = FriendRequest::findOrFail($requestId);

    if ($friendRequest->receiver_id !== $request->user()->id) {
        abort(403, 'Unauthorized action.');
    }

    // Update the status
    $friendRequest->update(['status' => 'declined']);
    
    return back()->with('success', 'Friend request declined.');
    }

    

   
}