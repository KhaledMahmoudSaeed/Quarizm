@extends("layouts.guest")

@section("content")
    <div class="p-8 sm:p-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-100 mb-2">
            {{ __('Welcome Back') }}
        </h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-8">
            {{ __('Sign in to your account') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg"
            :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 dark:text-gray-300 mb-1" />
                <x-text-input id="email"
                    class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="your@email.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 mb-1" />
                <x-text-input id="password"
                    class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="h-5 w-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700 dark:checked:bg-indigo-600"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <x-primary-button
                    class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 text-lg">
                    {{ __('Sign In') }}
                </x-primary-button>
            </div>

            <!-- Registration Link -->
            <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline ml-1">
                    {{ __('Create one') }}
                </a>
            </div>
        </form>
    </div>
@endsection