<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Your friends:</h3>
                    <ul>
                        @foreach (auth()->user()->friends as $friend)
                            <li>
                                {{ $friend->name }}
                                <form action="{{ route('friends.remove', $friend->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </li>
                        @endforeach
                        @if (auth()->user()->friends->count() === 0)
                            <li>No friends yet.</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Friend Requests</h3>
                    <ul>
                        @foreach (auth()->user()->receivedRequests()->where('status', 'pending')->get() as $request)
                            <li>
                                {{ $request->sender->name }}
                                <form action="{{ route('friend-request.accept', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Accept</button>
                                </form>
                                <form action="{{ route('friend-request.decline', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Decline</button>
                                </form>
                            </li>
                        @endforeach
                        @if (auth()->user()->receivedRequests()->where('status', 'pending')->count() === 0)
                            <li>No friend requests.</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Posts from you and your friends</h3>
                        @if ($posts->count())
                            @foreach ($posts as $post)
                                <div class="post mb-6 p-4 bg-gray-100 dark:bg-gray-700 rounded">
                                    <div class="postHeader"><h2 class="text-lg">{{ $post->title }}</h2>
                                        <div>By: {{ $post->user ? $post->user->name : 'Unknown' }} <img src="{{ $post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : asset('storage/images/default-avatar.png') }}" alt="{{ $post->user->name }}'s Profile Picture" ></div>
                                        
                                    </div>
                                    @if ($post->image)
                                        <div class= "postImg">
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" >

                                        </div>
                                    @endif

                                    <div class="postContent">
                                        <p>{{ $post->content }}</p>
                                    
                
                                        
                                    </div>

                                    <div class="postFooter">
                                        <a href="{{ route('post.show', $post) }}">Read More</a>
                                        <p>Posted on: {{ $post->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No posts to display. Start by creating a post or adding friends!</p>
                        @endif

                        <a href="{{ route('post.create') }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Create a Post
                        </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
