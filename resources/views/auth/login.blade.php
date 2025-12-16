<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-blue-100">

        <div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8">

            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">
                Login
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block mb-1 font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('email') }}" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-1 font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <label for="remember_me" class="ms-2 text-sm text-gray-600">Remember Me</label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-800">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">
                        Login
                    </button>
                </div>
            </form>

        </div>

    </div>

</x-guest-layout>
