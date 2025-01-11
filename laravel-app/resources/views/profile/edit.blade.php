{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Your Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                
                {{-- Validation and success messages, if any --}}
                @if(session('success'))
                    <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" 
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data"
                >
                    @csrf
                    @method('PATCH')

                    <!-- Example: Birthday -->
                    <div class="mb-4">
                        <label for="birthday" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Birthday') }}
                        </label>
                        <input 
                            type="date"
                            id="birthday"
                            name="birthday"
                            class="mt-1 block w-full"
                            value="{{ old('birthday', $user->birthday ? $user->birthday->format('Y-m-d') : '') }}"
                        >
                    </div>

                    <!-- Example: About Me -->
                    <div class="mb-4">
                        <label for="about_me" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('About Me') }}
                        </label>
                        <textarea 
                            id="about_me"
                            name="about_me"
                            rows="3"
                            class="mt-1 block w-full"
                        >{{ old('about_me', $user->about_me) }}</textarea>
                    </div>

                    <!-- Example: Profile Picture -->
                    <div class="mb-4">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ __('Profile Picture') }}
                        </label>
                        <input 
                            type="file"
                            id="profile_picture"
                            name="profile_picture"
                            class="mt-1 block w-full"
                        >
                        @if($user->profile_picture)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                     class="w-24 h-24 rounded-full object-cover"
                                     alt="Current profile picture">
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button
                            type="submit"
                            class="inline-block px-4 py-2 mt-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                        >
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
