{{-- resources/views/posts/create.blade.php --}}
<x-app-layout>
    <div class="p-4 bg-white dark:bg-gray-800 rounded shadow-sm text-gray-800 dark:text-gray-300">
        <h1 class="text-xl mb-4">Create a New Post</h1>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="text-red-500 mb-2">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block font-semibold">Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded p-2"
                    value="{{ old('title') }}"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="content" class="block font-semibold">Content</label>
                <textarea 
                    id="content" 
                    name="content"
                    rows="5"
                    class="w-full border border-gray-300 dark:border-gray-700 rounded p-2"
                    required
                >{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Create
            </button>
        </form>
    </div>
</x-app-layout>
