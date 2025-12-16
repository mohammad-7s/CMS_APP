<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-white to-blue-100">

        <div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8">

            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
                Reset Password
            </h2>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block mb-1 font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('email', $request->email) }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-1 font-medium text-gray-700">New Password</label>
                    <input id="password" type="password" name="password"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block mb-1 font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">
                    Reset Password
                </button>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                        Back to Login
                    </a>
                </div>

            </form>

        </div>

    </div>

</x-guest-layout>
