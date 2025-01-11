<x-app-layout>
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>by {{ $post->user->name }} on {{ $post->created_at->format('d M Y') }}</p>
        <article>
            {{ $post->content }}
        </article>
    
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('post.edit', $post) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('post.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            @endif
        @endauth
    </div>

    
</x-app-layout>