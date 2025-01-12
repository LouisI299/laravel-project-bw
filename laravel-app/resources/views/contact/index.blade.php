<x-app-layout>
    <h1>Contact Us</h1>

    @if(session('status'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST">
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
            <label for="message" class="block text-sm font-medium">Message</label>
            <textarea id="message" name="message" class="w-full border rounded px-2 py-1" required></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send Message</button>
    </form>
</x-app-layout>
