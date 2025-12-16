<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" href="{{ asset('image/favicon.png') }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Control Panel')</title>
<script src="https://cdn.tiny.cloud/1/eo5n8jjvdpzwedpx79h1x7jkjtnba0yliktms2n5nv79utd6/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 w-64 h-screen bg-white border-l border-gray-200 flex flex-col">

        <!-- Logo / Title -->
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">Control Panel</h2>
        </div>
        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Home
            </a>
            @if (auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('admin.users.index') }}"
                    class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                    User Management
                </a>
            @endif
            <a href="{{ route('admin.articles.index') }}"
                class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Articles
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Categories
            </a>
            <a href="{{ route('admin.comments.index') }}"
                class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Comments
            </a>
            <a href="{{ route('admin.contact.index') }}"
                class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Messages
            </a>
            <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                Return to the site
            </a>
        </nav>
        <!-- Logout -->
        <div class="p-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-right text-red-600 hover:underline">
                    Logout
                </button>
            </form>
        </div>
    </aside>
    <!-- Main Content -->
    <main class="ml-64 p-8">
        <!-- Header -->
        <header class="mb-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">@yield('page-title')</h1>
            <div class="flex items-center gap-3">
                <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>
            </div>
        </header>
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
