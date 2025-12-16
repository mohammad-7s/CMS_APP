@extends('layouts.admin')
@section('title', 'Category Management')
@section('page-title', 'Category Management')
@section('content')

    <div class="mb-8">
        <a href="{{ route('admin.categories.create') }}"
            class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition">
            Add New Category
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Article Number</th>
                    <th class="p-3 text-left">Control</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">{{ $category->name }}</td>
                        <td class="p-3 text-gray-600">
                            {{ $category->articles()->count() }}
                        </td>
                        <td class="p-3 flex gap-3">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                class="bg-indigo-100 text-indigo-700 px-4 py-1.5 rounded-lg text-sm hover:bg-indigo-200 transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-100 text-red-700 px-4 py-1.5 rounded-lg text-sm hover:bg-red-200 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-3 text-center text-gray-500">
                            There are currently no categories
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
