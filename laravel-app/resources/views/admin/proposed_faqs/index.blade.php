<x-app-layout>
    <x-slot name="header">
        <h2>Proposed FAQ Questions</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-6">
        @foreach ($proposedFaqs as $proposedFaq)
            <div class="mb-4 p-4 border rounded">
                <h3>{{ $proposedFaq->question }}</h3>
                <p>{{ $proposedFaq->details }}</p>
                <p class="text-sm text-gray-500">Proposed by: {{ $proposedFaq->user->name }}</p>
                <form action="{{ route('admin.proposed-faqs.approve', $proposedFaq->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('admin.proposed-faqs.reject', $proposedFaq->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
