<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostController extends Controller
{
    public function create()
    {
        
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }


        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('home');

    }

    public function index(){
        $adminIds = User::where('is_admin', 1)->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $adminIds)->latest()->paginate(10);
        return view('home', compact('posts'));
    }

    public function friendsPosts(){
        $user = Auth::user();

    
        $friendIds = $user->friends->pluck('id')->toArray();

    
        $posts = Post::whereIn('user_id', $friendIds)
            ->orWhere('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('dashboard', compact('posts'));
    }

    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    public function edit(Post $post){
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post){
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('post.show', $post);
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('home');
    }
}