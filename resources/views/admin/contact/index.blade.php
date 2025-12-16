@extends('layouts.admin')
@section('title', 'Contact Message')
@section('page-title', 'Contact Message')
@section('content')

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-6 border border-green-200">
            {{ session('success') }}
        </div>
    @endif
    <form method="GET" class="mb-6 flex gap-4">
        <input type="text" name="search" placeholder="Search by name or email"
            value="{{ request('search') }}"
            class="border-gray-300 rounded-lg px-4 py-2 w-64 focus:ring-indigo-500 focus:border-indigo-500">
        <select name="status"
                class="border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">All Cases</option>
            <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
            <option value="reviewed" {{ request('status') === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
        </select>
        <button class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
            Search
        </button>
    </form>
    <div class="bg-white rounded-xl shadow-md p-6">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Message</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Contr</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $msg)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">{{ $msg->name }}</td>
                        <td class="p-3">{{ $msg->email }}</td>
                        <td class="p-3 text-gray-700">{{ Str::limit($msg->message, 50) }}</td>
                        <td class="p-3">
                            @if($msg->reviewed)
                                <span class="px-3 py-1 text-sm rounded-lg bg-green-100 text-green-700">
                                    Reviewed
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm rounded-lg bg-yellow-100 text-yellow-700">
                                    New
                                </span>
                            @endif
                        </td>
                        <td class="p-3 flex gap-3">
                            @if(!$msg->reviewed)
                                <form action="{{ route('admin.contact.review', $msg->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-indigo-700 transition">
                                        Education as references
                                    </button>
                                </form>
                            @endif
                        <form action="{{ route('admin.contact.destroy', $msg->id) }}"
                                method="POST"
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
                        <td colspan="5" class="p-3 text-center text-gray-500">
                            There are no messages currently
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
