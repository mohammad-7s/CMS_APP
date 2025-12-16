@extends('layouts.admin')

@section('title', 'Add Article')
@section('page-title', 'Add Article')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-8 max-w-3xl">
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Article Title</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded-lg px-4 py-2"
                    value="{{ old('title') }}">

                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <x-forms.tinymce-editor name="content" id="content" :value="old('content', $article->content ?? '')" />
            <!-- Categories -->
            <div x-data="{
                open: false,
                selected: [],
                cats: @json($categories->pluck('name', 'id'))
            }" class="mb-6">

                <label class="block mb-2 font-semibold text-gray-800">Categories</label>

                <div @click="open = !open"
                    class="w-full border rounded-lg px-4 py-2 bg-white cursor-pointer flex gap-2 flex-wrap">
                    <template x-for="id in selected" :key="id">
                        <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded text-xs" x-text="cats[id]"></span>
                    </template>

                    <span x-show="selected.length === 0" class="text-gray-400 text-sm">
                        Choose categories...
                    </span>
                </div>

                <div x-show="open" @click.outside="open = false"
                    class="mt-2 bg-white border rounded-lg shadow max-h-60 overflow-y-auto">

                    @foreach ($categories as $cat)
                        <label class="flex items-center gap-2 px-4 py-2 text-sm">
                            <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                @change="
                                    $event.target.checked
                                        ? selected.push('{{ $cat->id }}')
                                        : selected = selected.filter(i => i !== '{{ $cat->id }}')
                                ">
                            <span>{{ $cat->name }}</span>
                        </label>
                    @endforeach

                </div>

                @error('categories')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Image</label>
                <input type="file" name="image">

                @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Publish -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Publish Status</label>

                <select name="published" class="w-full border rounded-lg px-4 py-2">
                    <option value="1" {{ old('published') == 1 ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ old('published') == 0 ? 'selected' : '' }}>Unpublished</option>
                </select>

                @error('published')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg">
                Save Article
            </button>
        </form>

    </div>
@endsection
