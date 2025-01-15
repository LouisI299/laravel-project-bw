<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\FriendRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        $user = Auth::user();
    
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
    // Retrieve only the validated fields the user actually sent
        $data = $request->validated();

    // If profile_picture was uploaded, handle the file upload
        if ($request->hasFile('profile_picture')) {
        $path = $request->file('profile_picture')->store('profile_pics', 'public');
        $data['profile_picture'] = $path;
        }

    // Fill only the fields present in $data
        $request->user()->fill($data);

    // If the user changed email, reset verification
        if (array_key_exists('email', $data)) {
        $request->user()->email_verified_at = null;
        }

    // Save user updates
        $request->user()->save();

    // Redirect back to the edit page with a success message
        return Redirect::route('profile.show', ['user' => $request->user()->id])->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Show the user's account.
     */

     public function show(\App\Models\User $user): View
     {
        if (Auth::user()){
            $request = FriendRequest::where('sender_id', $user->id)
            ->where('receiver_id', Auth::user()->id)
            ->where('status', 'pending')
            ->first();
        
            
            return view('profile.show', compact('user', 'request'));
        }else {
            return view('profile.show', compact('user'));
        }
        
     }

    public function showOwn()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for users based on name, email, or any other field
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->paginate(10); // Paginate results

        return view('profile.search', compact('users', 'query'));
    }

    
}