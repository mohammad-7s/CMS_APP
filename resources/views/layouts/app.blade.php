<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="{{ asset('image/favicon.png') }}" type="image/x-icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', config('app.name'))</title>
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="min-h-screen bg-gray-50 dark:bg-[#0f1720] text-gray-900 dark:text-gray-100">
    {{-- NAVBAR --}}
    @include('layouts.navigation')
    {{-- MAIN CONTENT --}}
    <main class="container mx-auto px-4 py-10">
        @if (session('message'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 shadow">
                {{ session('message') }}
            </div>
        @endif
        @yield('content')
    </main>
    {{-- FOOTER --}}
    @include('layouts.footer')
    @stack('scripts')
</body>

</html>
