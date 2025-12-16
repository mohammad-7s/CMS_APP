@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-4 py-8">
        {{-- HERO --}}
        <section
            class="mb-12 bg-white dark:bg-[#0f1720] rounded-2xl p-8 shadow-md border border-gray-100 dark:border-gray-800">
            <div class="lg:flex lg:items-center lg:justify-between gap-8">
                {{-- TEXT --}}
                <div class="lg:w-2/3 space-y-4">
                    <h1 class="text-4xl font-extrabold leading-tight">
                        Welcome to<span class="text-blue-600"> The blog</span>
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg">
                        Browse the latest articles, read what interests you, and discover the newest topics.
                    </p>
                    {{-- SEARCH FORM --}}
                    <form action="{{ route('home') }}" method="GET" class="flex flex-col sm:flex-row gap-3 mt-4">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search for an article..."
                            class="flex-1 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2
                                focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-[#0b1220]">
                        <select name="category"
                            class="border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 dark:bg-[#0b1220]">
                            <option value="">All categories</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Search
                        </button>
                    </form>
                </div>
                {{-- IMAGE --}}
                <div class="hidden lg:block lg:w-1/3">
                    <img src="{{ asset('image/hero-illustration.png') }}" class="max-w-sm mx-auto drop-shadow-lg"
                        alt="Hero">
                </div>
            </div>
        </section>
        {{-- LATEST ARTICLES --}}
        <section class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Latest articles</h2>
                <a href="{{ route('articles.index') }}" class="text-blue-600 hover:underline text-sm">
                    Show All
                </a>
            </div>
            @if ($articles->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($articles as $article)
                        <article
                            class="bg-white dark:bg-[#111827] rounded-2xl shadow-md overflow-hidden border border-gray-100 dark:border-gray-800 flex flex-col">
                            {{-- IMAGE --}}
                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div
                                    class="w-full h-48 bg-gray-100 dark:bg-[#0b1220] flex items-center justify-center text-gray-400">
                                    Virtual image
                                </div>
                            @endif
                            {{-- CONTENT --}}
                            <div class="p-5 flex flex-col flex-1">
                                <a href="{{ route('articles.show', $article->id) }}"
                                    class="text-lg font-semibold hover:text-blue-600 transition mb-2">
                                    {{ $article->title }}
                                </a>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 flex-1 leading-relaxed">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($article->content ?? ($article->body ?? '')), 140) !!}
                                </p>
                                <div class="flex items-center justify-between mt-auto">
                                    <a href="{{ route('articles.show', $article->id) }}"
                                        class="text-sm bg-blue-600 text-white px-4 py-1.5 rounded-lg hover:bg-blue-700 transition">
                                        Read more
                                    </a>
                                    <span class="text-xs text-gray-500">
                                        {{ $article->created_at->format('Y-m-d') }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                {{-- PAGINATION --}}
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @else
                <div
                    class="bg-white dark:bg-[#0b1220] rounded-2xl p-10 text-center shadow-md border border-gray-100 dark:border-gray-800">
                    <h3 class="text-xl font-semibold mb-3">There are currently no articles</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        You can create your first article from the dashboard.
                    </p>
                    @auth
                        @if (auth()->user()->role !== 'user')
                            <a href="{{ route('admin.articles.create') }}"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                                Create a new article
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </section>
    </div>
@endsection
