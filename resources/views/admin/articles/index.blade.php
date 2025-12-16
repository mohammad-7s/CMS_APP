@extends('layouts.admin')
@section('title', 'Article Management')
@section('page-title', 'Article Management')
@section('content')

    <div class="mb-8">
        <a href="{{ route('admin.articles.create') }}"
            class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition">
            Add New Article
        </a>
    </div>

    <form method="GET" class="mb-8 bg-white p-5 rounded-xl shadow-md flex items-center gap-4">

        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for an article..."
            class="flex-1 border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">

        <select name="category_id"
            class="border-gray-300 rounded-lg px-8 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">All categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700">
            search
        </button>

    </form>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($articles as $article)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">

                @if ($article->image)
                    <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-48 object-cover">
                @endif

                <div class="p-5">

                    <h3 class="text-xl font-bold text-gray-800 mb-3">
                        {{ $article->title }}
                    </h3>

                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        {!! Str::limit($article->content, 120) !!}
                    </p>
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach ($article->categories as $cat)
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs">
                                {{ $cat->name }}
                            </span>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-4 border-t flex flex-col gap-3 sm:flex-row sm:justify-between sm:items-center">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                                class="inline-block bg-indigo-100 text-indigo-700 px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-indigo-200 transition">
                                edit
                            </a>
                            <form action="{{ route('admin.articles.toggle', $article->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="inline-block px-4 py-1.5 rounded-lg text-sm font-medium transition
                                        {{ $article->published ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                    {{ $article->published ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                        </div>

                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-block bg-red-100 text-red-700 px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-red-200 transition">
                                delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- PAGINATION --}}
    <div class="mt-8">
        {{ $articles->links() }}
    </div>
@endsection
