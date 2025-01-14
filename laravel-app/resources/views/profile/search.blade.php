<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Search Results for "{{ $query }}"
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 rounded shadow-sm">
            @if ($users->count())
                <ul>
                    @foreach ($users as $user)
                        <li class="border-b border-gray-200 dark:border-gray-700 p-4">
                            <a href="{{ route('profile.show', $user->id) }}" class="text-blue-500">
                                {{ $user->name }}
                            </a>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </li>
                    @endforeach
                </ul>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            @else
                <p class="p-4 text-gray-500">No users found for "{{ $query }}".</p>
            @endif
        </div>
    </div>
</x-app-layout>
