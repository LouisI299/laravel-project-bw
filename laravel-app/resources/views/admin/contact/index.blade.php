<x-app-layout>
    <h1>All Messages</h1>

    <table class="min-w-full bg-white shadow-md rounded border">
        <thead>
            <tr>
                <th class="px-4 py-2 border">Name</th>
                <th class="px-4 py-2 border">Email</th>
                <th class="px-4 py-2 border">Message</th>
                <th class="px-4 py-2 border">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td class="px-4 py-2 border">{{ $message->name }}</td>
                    <td class="px-4 py-2 border">{{ $message->email }}</td>
                    <td class="px-4 py-2 border">{{ $message->message }}</td>
                    <td class="px-4 py-2 border">{{ $message->created_at->format('d M Y, H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</x-app-layout>
