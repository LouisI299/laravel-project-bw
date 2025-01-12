<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">User Management</h1>

    @if(session('status'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('admin.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Create New User</a>

    <table class="min-w-full bg-white shadow-md rounded border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Role</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border">{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                    <td class="px-4 py-2 border">
                        @if(!$user->is_admin)
                            <form action="{{ route('admin.promote', $user) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-black px-4 py-1 rounded">Promote</button>
                            </form>
                        @else
                            <form action="{{ route('admin.demote', $user) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-red-500 text-black px-4 py-1 rounded">Demote</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
