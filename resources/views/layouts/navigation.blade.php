<header class="w-full bg-white dark:bg-[#0b1220] shadow-sm border-b border-gray-200 dark:border-gray-800">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600 dark:text-blue-400">
            {{ config('app.name', 'CMS_APP') }}
        </a>
        {{-- Navigation --}}
        <nav class="bg-white dark:bg-[#0b1220] border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50">
            <div class="container mx-auto px-4 py-4 flex items-center justify-between">
                {{-- LINKS --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Home
                    </a>
                    <a href="{{ route('articles.index') }}"
                        class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Articles
                    </a>
                    <a href="{{ route('categories.index') }}"
                        class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Categories
                    </a>
                    <a href="{{ route('contact.show') }}"
                        class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Contact us
                    </a>
                    @auth
                        @if (auth()->user()->hasAnyRole(['admin', 'editor']))
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm text-gray-700 hover:text-indigo-600 transition">
                                Control Panel
                            </a>
                        @endif
                    @endauth
                    {{-- AUTH LINKS --}}
                    @auth
                        <span class="text-gray-600 dark:text-gray-300">
                            {{ auth()->user()->name }}
                        </span>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="text-red-600 hover:text-red-700">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Login
                        </a>
                        <a href="/register" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Register
                        </a>
                    @endauth
                </div>
                {{-- MOBILE MENU BUTTON --}}
                <button id="menuBtn" class="md:hidden text-2xl">
                    ☰
                </button>
            </div>
            {{-- MOBILE MENU --}}
            <div id="mobileMenu"
                class="hidden md:hidden bg-white dark:bg-[#0b1220] border-t border-gray-200 dark:border-gray-800">
                <div class="flex flex-col p-4 gap-4">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('articles.index') }}">Articles</a>
                    <a href="{{ route('contact.show') }}">Contact us</a>
                    @auth
                        <span>{{ auth()->user()->name }}</span>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="text-red-600">Logout</button>
                        </form>
                    @else
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    @endauth
                </div>
            </div>
        </nav>
        <script>
            const btn = document.getElementById('menuBtn');
            const menu = document.getElementById('mobileMenu');
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        </script>
    </div>
</header>
