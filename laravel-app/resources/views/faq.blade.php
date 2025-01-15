<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FAQ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 faqDescription">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('faq.create') }}" class="btn btn-success">Create FAQ</a>
                            <a href="{{ route('admin.proposed-faqs.index')}}" class="btn btn-success">See proposed FAQ's</a>
                        @else
                            <p>Welcome to our Frequently Asked Questions page! Can't find the answers you are looking for? Propose a FAQ question or navigate to the Contact page.</p>
                            <a href="{{ route('faq.propose') }}" class="btn btn-success">Propose FAQ</a>
                        @endif
                        
                    @endauth
                    @guest
                        <p>Welcome to our Frequently Asked Questions page!</p>
                        <p>Can't find the answers you are looking for? Log in to propose a FAQ question or access the Contact page.</p> 
                    @endguest
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($categories as $category)
                        <h2 class="categoryName">{{ $category->name }}</h2>
                        @foreach ($category->faqs as $faq)
                            <div class="faqDiv">
                                <h3>Q: {{ $faq->question }}</h3>
                                <p>A: {{ $faq->answer }}</p>
                                @auth
                                    @if(auth()->user()->is_admin)
                                        <a href="{{ route('faq.edit', $faq) }}" class="btn btn-primary">Edit FAQ</a>
                                        <form method="POST" action="{{ route('faq.destroy', $faq) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete FAQ</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
