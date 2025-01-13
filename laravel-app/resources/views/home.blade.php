<x-app-layout>
    <container class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg text-gray-800 dark:text-gray-300 flex flex-col items-center justify-center gap-2 flex-wrap ">
        <h1 class="text-xl ">Welcome to the Sports Community.</h1>
        
        <section class="flex flex-col gap-2 w-full"> 
            @if ($posts->count())
            @foreach ($posts as $post)
                <div class=" border-solid border rounded border-gray-200 dark:border-gray-700 overflow-scroll  w-[1/2] ">
                    <div class="flex flex-row items-center justify-between px-1"><h2 class="text-lg">{{ $post->title }}</h2>
                        <h2 >By: {{ $post->user ? $post->user->name : 'Unknown' }}</h2>
                    </div>
                    @if ($post->image)
                    <div class= "">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-28 object-fill object-center">

                    </div>
                    @endif
                    
                    
                    <p>{{ $post->content }}</p>
                    

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
        
    </container>

    
</x-app-layout>