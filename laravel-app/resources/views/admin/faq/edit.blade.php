<x-app-layout>
    <h1>Edit FAQ</h1>

    <form action="{{ route('faq.store') }}" method="POST">
        @csrf
        <div>
            <label for="question">Question</label>
            <input type="text" name="question" id="question" required value="{{ $faq->question }}">
        </div>

        <div>
            <label for="answer">Answer</label>
            <textarea name="answer" id="answer" placeholder="{{ $faq->answer }}"></textarea>
        </div>

        <div>
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Update FAQ</button>
    </form>
</x-app-layout>
