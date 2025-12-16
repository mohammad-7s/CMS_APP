@extends('layouts.app')
@section('title','All Articles')
@section('content')
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @forelse ($articles as $article)
                <div class="bg-white shadow-sm rounded p-4">
                    @if ($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-48 object-cover rounded mb-3">
                    @endif
                    <h3 class="text-lg font-bold mb-2">
                        <a href="{{ route('articles.show', $article->id) }}">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-600 mb-2">
                        By {{ $article->user->name ?? 'Unknown' }} – {{ $article->created_at->format('Y-m-d') }}
                    </p>
                    <p class="text-gray-700 text-sm">
                        {!! Str::limit(strip_tags($article->content), 100) !!}
                    </p>
                </div>
            @empty
                <p class="text-gray-500">There are no articles currently.</p>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
