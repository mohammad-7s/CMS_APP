@extends('layouts.app')
@section('title', 'Show Article')
@section('content')
    <div class="container mx-auto px-4 py-8">
        @if (session('error'))
            <div class="mb-4 p-3 bg-red-600 text-white rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        <article
            class="bg-white dark:bg-[#0f1720] rounded-2xl shadow-md border border-gray-200 dark:border-gray-800 p-8 mb-12">
            <h1 class="text-3xl font-extrabold mb-4 leading-tight">
                {{ $article->title }}
            </h1>
            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-6">
                <span>The writer: {{ $article->user->name ?? 'Unknown' }}</span>
                <span>•</span>
                <span>{{ optional($article->created_at)->format('Y-m-d') ?? 'Unknown' }}</span>
            </div>
            @if ($article->image)
                <img src="{{ asset('storage/' . $article->image) }}"
                    class="w-full max-h-[450px] object-cover rounded-xl mb-8 shadow" alt="{{ $article->title }}">
            @endif
            <div class="prose prose-lg dark:prose-invert max-w-none leading-relaxed">
                {!! $article->content !!}
            </div>
            <div class="flex gap-2 mb-4">
                @foreach ($article->categories as $cat)
                    <a href="{{ route('categories.show', $cat->id) }}"
                        class="px-3 py-1 bg-gray-100 dark:bg-[#1a2332] rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-[#243044] transition">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </article>
        @if ($related->count())
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($related as $rel)
                        <a href="{{ route('articles.show', $rel->id) }}"
                            class="block bg-white dark:bg-[#111827] rounded-2xl shadow-md border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg transition">
                            @if ($rel->image)
                                <img src="{{ asset('storage/' . $rel->image) }}" class="w-full h-40 object-cover"
                                    alt="{{ $rel->title }}">
                            @else
                                <div
                                    class="w-full h-40 bg-gray-100 dark:bg-[#0b1220] flex items-center justify-center text-gray-400">
                                    Virtual image
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 hover:text-blue-600 transition">
                                    {{ $rel->title }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($rel->content), 90) !!}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Comments</h2>
            @forelse($comments as $comment)
                <div
                    class="mb-4 p-4 bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold">{{ $comment->name }}</span>
                        <span class="text-xs text-gray-500">{{ $comment->created_at->format('Y-m-d') }}</span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">{{ $comment->comment }}</p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">There are no comments yet.</p>
            @endforelse
            <div
                class="mt-8 bg-white dark:bg-[#111827] border border-gray-200 dark:border-gray-800 rounded-xl p-6 shadow-md">
                <h3 class="text-xl font-semibold mb-4">Add a comment</h3>
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        <strong>There are errors in the input:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('articles.comments.store', $article->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Comment</label>
                        <textarea name="message" rows="4" required
                            class="w-full border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-[#0b1220]"></textarea>
                    </div>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Send Comment
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
