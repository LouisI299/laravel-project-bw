<x-app-layout>
    <x-slot name="header">
        <h2>Propose a Question</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <form action="{{ route('proposed-faq.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="question" class="block font-semibold">Question</label>
                <input type="text" name="question" id="question" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="details" class="block font-semibold">Details (optional)</label>
                <textarea name="details" id="details" class="w-full border rounded p-2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</x-app-layout>
