<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
    return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'user_id' => Auth::id(), // Attach logged-in user if available
        ]);

        return redirect()->back()->with('status', 'Your message has been sent successfully!');
    }

    public function showMessages()
    {
        $messages = Contact::latest()->paginate(10);

        return view('admin.contact.index', compact('messages'));
    }
}