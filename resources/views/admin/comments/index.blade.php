@extends('layouts.admin')
@section('title', 'Comments Management')
@section('page-title', 'Comments Management')
@section('content')
    <div class="max-w-6xl mx-auto">

        @if (session('message'))
            <div class="mb-4 p-4 bg-green-50 text-green-700 border border-green-200 rounded-lg shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        {{-- filters --}}
        <form method="GET" class="mb-8 bg-white p-5 rounded-xl shadow-md flex items-center gap-4">
            <select name="status" class="border-gray-300 rounded-lg px-8 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All comments</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Under review</option>
                <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>Approved</option>
            </select>
            <select name="article_id"
                class="border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">All Articles</option>
                @foreach ($articles as $a)
                    <option value="{{ $a->id }}" {{ (string) $article_id === (string) $a->id ? 'selected' : '' }}>
                        {{ $a->title }} {{ $a->comments_enabled ? '' : '(Comments are disabled)' }}
                    </option>
                @endforeach
            </select>
            <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700">
                Filter
            </button>
        </form>
        <div class="grid gap-4">
            @foreach ($comments as $c)
                <div class="bg-white border rounded-lg p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start gap-5">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-1">
                                <strong class="text-gray-800">{{ $c->name }}</strong>
                                <small class="text-gray-500">{{ $c->email }}</small>
                                <span class="ml-auto text-xs text-gray-400">{{ $c->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="mt-2 text-sm text-gray-700 leading-relaxed">
                                {!! nl2br(e($c->comment)) !!}
                            </div>
                            <div class="mt-4 flex items-center gap-3">
                                @if (!$c->approved)
                                    <form method="POST" action="{{ route('admin.comments.approve', $c->id) }}">
                                        @csrf
                                        <button
                                            class="px-3 py-1.5 bg-green-600 text-white rounded text-xs hover:bg-green-700 transition">
                                            Approval
                                        </button>
                                    </form>
                                @else
                                    <span class="px-3 py-1.5 bg-green-100 text-green-700 rounded text-xs">
                                        Certified
                                    </span>
                                @endif
                                <form method="POST" action="{{ route('admin.comments.destroy', $c->id) }}"
                                    onsubmit="return confirm('Do you want to delete this comment?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-1.5 bg-red-600 text-white rounded text-xs hover:bg-red-700 transition">
                                        Delete
                                    </button>
                                </form>
                                <a href="{{ route('articles.show', $c->article->id) }}" target="_blank"
                                    class="text-xs text-blue-600 hover:underline ml-2">
                                    Display Article
                                </a>
                            </div>
                        </div>
                        <div class="w-48 text-right border-l pl-4">
                            <div class="text-xs text-gray-500 mb-1">Article:</div>
                            <div class="text-sm font-semibold text-gray-800">{{ $c->article->title }}</div>
                            <div class="mt-4">
                                <form method="POST"
                                    action="{{ route('admin.articles.comments.toggle', $c->article->id) }}">
                                    @csrf
                                    <button
                                        class="px-3 py-1.5 rounded text-xs
                                    {{ $c->article->comments_enabled
                                        ? 'bg-red-600 text-white hover:bg-red-700'
                                        : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                                        {{ $c->article->comments_enabled ? 'Disable comments' : 'Enable comments' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $comments->links() }}
        </div>
    </div>
@endsection
