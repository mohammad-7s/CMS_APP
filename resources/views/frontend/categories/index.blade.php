@extends('layouts.app')
@section('title','All Categories')
@section('content')
<div class="py-12">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($categories as $category)
            <div class="bg-white shadow-sm rounded p-4">
                <h3 class="text-lg font-bold mb-2">
                    <a href="{{ route('categories.show', $category->id) }}">
                        {{ $category->name }}
                    </a>
                </h3></div>
    @endforeach
            </div>
</div>
@endsection
