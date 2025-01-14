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
                        @foreach (auth()->user()->receivedRequests as $request)
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
                        @if (auth()->user()->receivedRequests->count() === 0)
                            <li>No friend requests.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
