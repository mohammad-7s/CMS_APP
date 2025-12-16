@extends('layouts.admin')
@section('title', 'Edit Article')
@section('page-title', 'Edit Article')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-8 max-w-3xl">
        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                let valid = true;

                // content validation (TinyMCE)
                const contentText = tinymce.get('content').getContent({
                    format: 'text'
                }).trim();
                const contentError = document.getElementById('content-error');

                if (!contentText) {
                    contentError.textContent = 'Content is required';
                    contentError.classList.remove('hidden');
                    valid = false;
                } else {
                    contentError.classList.add('hidden');
                }

                if (!valid) {
                    e.preventDefault();
                }
            });
        </script>

        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Article Title</label>
                <input type="text" name="title"
                    class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('title', $article->title) }}">

                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- Content -->
            <x-forms.tinymce-editor name="content" id="content" :value="old('content', $article->content ?? '')" />
            <!-- Current Image -->
            @if ($article->image)
                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-gray-700">The current image</label>
                    <img src="{{ asset('storage/' . $article->image) }}" class="w-48 rounded-lg shadow mb-3">
                </div>
            @endif
            <!-- Categories -->
            <div x-data="{
                open: false,
                selected: @json($article->categories->pluck('id')->map(fn($id) => (string) $id)),
                cats: @json($categories->pluck('name', 'id'))
            }" class="mb-6">

                <label class="block mb-2 font-semibold text-gray-800">Categories</label>

                <div @click="open = !open"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white cursor-pointer flex flex-wrap gap-2 min-h-[42px] items-center">

                    <template x-for="id in selected" :key="id">
                        <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded text-xs" x-text="cats[id]"></span>
                    </template>

                    <span x-show="selected.length === 0" class="text-gray-400 text-sm">
                        Choose categories...
                    </span>
                </div>

                <div x-show="open" @click.outside="open = false" x-transition
                    class="mt-2 bg-white border rounded-lg shadow-lg max-h-60 overflow-y-auto">

                    @foreach ($categories as $cat)
                        <label class="flex items-center gap-2 px-4 py-2 hover:bg-gray-50 cursor-pointer text-sm">
                            <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                :checked="selected.includes('{{ (string) $cat->id }}')"
                                @change="
                                    if ($event.target.checked) {
                                        if (!selected.includes($event.target.value)) {
                                            selected.push($event.target.value)
                                        }
                                    } else {
                                        selected = selected.filter(i => i !== $event.target.value)
                                    }
                                "
                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span>{{ $cat->name }}</span>
                        </label>
                    @endforeach
                </div>

                @error('categories')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Change Image -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Change the image</label>
                <input type="file" name="image" class="w-full">

                @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Publish -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Publish Status</label>

                <select name="published"
                    class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">

                    <option value="1" {{ old('published', $article->published) == 1 ? 'selected' : '' }}>Published
                    </option>
                    <option value="0" {{ old('published', $article->published) == 0 ? 'selected' : '' }}>Unpublished
                    </option>

                </select>

                @error('published')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-semibold">
                Update the Article
            </button>

        </form>

    </div>
@endsection
