<x-app-layout>
    
    <container class="bg-white dark:bg-gray-800   text-gray-800 dark:text-gray-300 flex flex-col items-center justify-center gap-2 flex-wrap ">
        <h1 class="title ">Welcome to the Sports Community.</h1>
        <h2 class="subTitle">Read the latest sports news and connect with your friends!</h2>
        
        <section class="postContainer"> 
            @if ($posts->count())
            @foreach ($posts as $post)
                <div class="post border-solid border rounded border-gray-200 dark:border-gray-700 overflow-scroll  w-[1/2] ">
                    <div class="postHeader"><h2 class="text-lg">{{ $post->title }}</h2>
                        <div>By: <a href="{{ route('profile.show', $post->user->id)}}">{{ $post->user ? $post->user->name : 'Unknown' }} <img src="{{ $post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('storage/images/default-avatar.png') }}" alt="{{ $post->user->name }}'s Profile Picture" ></a></div>
                        
                    </div>
                    <div class="postBody">
                        @if ($post->image)
                    <div class= "postImg">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" >

                    </div>
                    @endif
                    
                    <div class="postContent">
                        <p>{{ $post->content }}</p>
                    

                        
                    </div>
                    </div>
                    

                    <div class="postFooter">
                        <a href="{{ route('post.show', $post) }}">Read More</a>
                        <p>Posted on: {{ $post->created_at->format('d M Y') }}</p>
                    </div>
                    
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