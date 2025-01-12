<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Create New User</h1>

    @if($errors->any())
        <div class="bg-red-500 text-white p-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Name</label>
            <input type="text" id="name" name="name" class="w-full border rounded px-2 py-1" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" class="w-full border rounded px-2 py-1" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" id="password" name="password" class="w-full border rounded px-2 py-1" required>
        </div>

        <div class="mb-4">
            <label for="is_admin" class="flex items-center">
                <input type="checkbox" id="is_admin" name="is_admin" class="mr-2">
                Grant Admin Access
            </label>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create User</button>
    </form>
</x-app-layout>
