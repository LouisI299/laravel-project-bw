{{-- resources/views/profile/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($user->name . "'s Profile") }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Main container --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Profile Card --}}
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    
                    {{-- Profile Picture --}}
                    @if($user->profile_picture)
                        <div class="mb-4">
                            <img 
                                src="{{ asset('storage/' . $user->profile_picture) }}" 
                                alt="{{ $user->name }}'s Profile Picture"
                                class="rounded-full object-cover w-32 h-32"
                            >
                        </div>
                    @else
                        <div class="mb-4">
                            <img 
                                src="{{ asset('images/default-avatar.png') }}" 
                                alt="Default Profile Picture"
                                class="rounded-full object-cover w-32 h-32"
                            >
                        </div>
                    @endif

                    {{-- Name --}}
                    <div class="mb-4">
                        <strong>{{ __('Name:') }}</strong>
                        <span>{{ $user->name }}</span>
                    </div>

                    {{-- Birthday --}}
                    <div class="mb-4">
                        <strong>{{ __('Birthday:') }}</strong>
                        @if($user->birthday)
                            <span>{{ \Carbon\Carbon::parse($user->birthday)->format('d M Y') }}</span>
                        @else
                            <span>{{ __('Not provided') }}</span>
                        @endif
                    </div>

                    {{-- About Me --}}
                    <div class="mb-4">
                        <strong>{{ __('About Me:') }}</strong>
                        <p class="mt-1 text-gray-700 dark:text-gray-300">
                            {{ $user->about_me ?? __('No information provided.') }}
                        </p>
                    </div>

                    @auth
                        @if ($user->id !== auth()->id()) 
        
                            @if (auth()->user()->friends->contains($user))
           
                                <form action="{{ route('friends.remove', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove Friend</button>
                                </form>
                            @elseif(auth()->user()->hasSentFriendRequest($user))
            
                                <p>{{ __('Friend request sent.') }}</p>
                            @elseif(auth()->user()->hasReceivedFriendRequest($user))
            
                                <form action="{{ route('friend-request.accept', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Accept</button>
                                </form>
                                <form action="{{ route('friend-request.decline', $request->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Decline</button>
                                </form>
                            @else
           
                                <form action="{{ route('friend-request.send', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Add Friend</button>
                                </form>
                            @endif
                        @endif
                    @endauth

                    
                    @auth
                        @if(auth()->id() === $user->id)
                            <a 
                                href="{{ route('profile.edit') }}" 
                                class="inline-block px-4 py-2 mt-4 bg-blue-600 text-white rounded hover:bg-blue-700"
                            >
                                {{ __('Edit Profile') }}
                            </a>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>
</x-app-layout>