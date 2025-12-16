@extends('layouts.app')
@section('title','Contact Message')
@section('content')
    <div class="container mx-auto px-4 py-10 max-w-2xl">
        <h1 class="text-3xl font-bold mb-6">Contact us</h1>
        @if (session('message'))
            <div class="mb-4 p-4 bg-green-600 text-white rounded-lg">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block mb-1 font-semibold">Name</label>
                <input type="text" name="name"
                    class="w-full p-3 rounded-lg border dark:bg-[#0b1220] dark:border-gray-700" value="{{ old('name') }}"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email"
                    class="w-full p-3 rounded-lg border dark:bg-[#0b1220] dark:border-gray-700" value="{{ old('email') }}"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-1 font-semibold">The message</label>
                <textarea name="message" rows="5" class="w-full p-3 rounded-lg border dark:bg-[#0b1220] dark:border-gray-700"
                    required>{{ old('message') }}</textarea>
                @error('message')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Send the message
            </button>
        </form>
    </div>
@endsection
