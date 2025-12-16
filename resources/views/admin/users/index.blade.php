@extends('layouts.admin')
@section('title', 'Users Management')
@section('page-title', 'Users Management')
@section('content')
    <div class="bg-white rounded-xl shadow-md p-8">
        @if (session('message'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-6 border border-green-200">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-3 text-right font-semibold text-gray-700">#</th>
                        <th class="p-3 text-right font-semibold text-gray-700">Name</th>
                        <th class="p-3 text-right font-semibold text-gray-700">Email</th>
                        <th class="p-3 text-right font-semibold text-gray-700">Current role</th>
                        <th class="p-3 text-right font-semibold text-gray-700">Update role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3">{{ $user->id }}</td>
                            <td class="p-3">{{ $user->name }}</td>
                            <td class="p-3">{{ $user->email }}</td>
                            <td class="p-3">
                                <span
                                    class="px-3 py-1 text-sm rounded-lg
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : '' }}
                                {{ $user->role === 'editor' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $user->role === 'user' ? 'bg-gray-200 text-gray-700' : '' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="p-3">
                                <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST"
                                    class="flex items-center gap-3">
                                    @csrf
                                    <select name="role"
                                        class="border-gray-300 rounded-lg px-3 py-1.5 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin
                                        </option>
                                        <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>editor
                                        </option>
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                                    </select>
                                    <button type="submit"
                                        class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-indigo-700 transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-8">
        {{ $users->links() }}
    </div>
@endsection
