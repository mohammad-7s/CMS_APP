@extends('layouts.admin')
@section('title', 'Add Category')
@section('page-title', 'Add Category')

@section('content')
    <div class="bg-white rounded-xl shadow-md p-8 max-w-xl">

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <!-- Category Name -->
            <div class="mb-6">
                <label class="block mb-2 font-semibold text-gray-700">Category Name</label>

                <input type="text" name="name"
                    class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                    value="{{ old('name') }}">

                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-semibold">
                Category Save
            </button>
        </form>

    </div>
@endsection
