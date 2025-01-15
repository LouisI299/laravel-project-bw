<x-app-layout>
    <div class="container flex flex-col items-center">
        <div class="showPost">
            <div class="postHeader"><h2 class="text-lg">{{ $post->title }}</h2>
                <div>By: <a href="{{ route('profile.show', $post->user->id)}}">{{ $post->user ? $post->user->name : 'Unknown' }} <img src="{{ $post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('storage/images/default-avatar.png') }}" alt="{{ $post->user->name }}'s Profile Picture" ></a></div>
                
            </div>
            <div class="postBody">
                @if ($post->image)
            <div class= "postImg">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" >

            </div>
            @endif
            <div class="postContent">{{ $post->content }}</div>
            </div>
            
            <div class="postFooter">
                @auth
                    @if(auth()->user()->id === $post->user_id)
                        <a href="{{ route('post.edit', $post) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('post.destroy', $post) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    @endif
                @endauth
                <p>Posted on: {{ $post->created_at->format('d M Y') }}</p>
            </div>
        </div>
        
        
    
        
    </div>

    
</x-app-layout>