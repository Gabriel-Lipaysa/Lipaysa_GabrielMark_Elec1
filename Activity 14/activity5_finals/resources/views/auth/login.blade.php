<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-lg border dark:border-gray-800">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6 text-sm text-green-600" :status="session('status')" />

        <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white mb-6">Login to Your Account</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-5">
                <x-input-label for="email" :value="__('Email')" class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200" />
                <x-text-input id="email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-red-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-5">
                <x-input-label for="password" :value="__('Password')" class="mb-1 text-sm font-semibold text-gray-700 dark:text-gray-200" />
                <x-text-input id="password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-red-500"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-600 text-red-600 shadow-sm focus:ring-red-500" name="remember">
                    <span class="ml-2">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-red-600 dark:text-red-400 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-primary-button class="w-full justify-center py-2 text-white bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-800 rounded-lg transition duration-150 ease-in-out">
                {{ __('Log in') }}
            </x-primary-button>
        </form>
    </div>
</x-guest-layout>
