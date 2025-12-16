@extends('layouts.app')
@section('title','Show Category')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">
            Category: {{ $category->name }}
        </h1>
        @if ($articles->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="block bg-white dark:bg-[#111827] rounded-2xl shadow-md border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg transition">
                        @if ($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-40 object-cover"
                                alt="{{ $article->title }}">
                        @else
                            <div
                                class="w-full h-40 bg-gray-100 dark:bg-[#0b1220] flex items-center justify-center text-gray-400">
                                Image not available
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-2 hover:text-blue-600 transition">
                                {{ $article->title }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 90) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400">There are no articles in this category.</p>
        @endif
    </div>
@endsection
