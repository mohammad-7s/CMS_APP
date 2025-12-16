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
<body class="bg-gradient-to-br from-indigo-100 via-white to-blue-100 min-h-screen flex items-center justify-center">
    <div class="w-full  bg-white dark:bg-[#0b1220] p-6 rounded-xl shadow-lg">
        {{ $slot }}
    </div>
</body>
</html>
