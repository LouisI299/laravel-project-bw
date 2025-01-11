<x-app-layout>
    <div class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg text-gray-800 dark:text-gray-300 flex flex-col justify-center gap-2 flex-wrap ">
        <h1 class="text-xl ">Welcome to the Sports Community.</h1>
        <section class="flex flex-col gap-2 w-5/6"> 
            @if ($posts->count())
            @foreach ($posts as $post)
                <div class=" border-solid border border-gray-200 dark:border-gray-700 overflow-scroll  ">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                    <p>Posted by {{ $post->user ? $post->user->name : 'Unknown' }}</p>

                    <a href="{{ route('post.show', $post) }}">Read More</a>
                </div>
            @endforeach
            @else
                <p>No posts yet.</p>
            @endif

            @auth
                @if(auth()->user()->is_admin)
                    <a href="{{ route('post.create') }}" class="btn btn-success">Create Post</a>
                @endif
            @endauth

        </section>
        
    </div>

    
</x-app-layout>