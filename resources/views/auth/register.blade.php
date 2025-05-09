@extends("layouts.guest")

@section("content")
    <div class="p-8 sm:p-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-100 mb-2">
            {{ __('Create Your Account') }}
        </h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-8">
            {{ __('Join our community today') }}
        </p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-5">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 dark:text-gray-300 mb-1" />
                        <x-text-input id="name"
                            class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                            type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email Address')"
                            class="text-gray-700 dark:text-gray-300 mb-1" />
                        <x-text-input id="email"
                            class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                            type="email" name="email" :value="old('email')" required placeholder="your@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Gender -->
                    <div>
                        <x-input-label :value="__('Gender')" class="text-gray-700 dark:text-gray-300 mb-1" />
                        <div class="flex items-center space-x-6 mt-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="male"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                                    {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">{{ __('Male') }}</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="female"
                                    class="h-5 w-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600"
                                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">{{ __('Female') }}</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-5">
                    <!-- Phone -->
                    <div>
                        <x-input-label for="phone" :value="__('Phone Number')"
                            class="text-gray-700 dark:text-gray-300 mb-1" />
                        <x-text-input id="phone"
                            class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                            type="tel" name="phone" :value="old('phone')" required placeholder="+1 (555) 123-4567" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>

                    <!-- Country -->
                    <div>
                        <x-input-label for="country" :value="__('Country')" class="text-gray-700 dark:text-gray-300 mb-1" />
                        <select id="country" name="country"
                            class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-gray-700 dark:text-gray-300"
                            required>
                            <option value="" disabled selected>{{ __('Select your country') }}</option>
                            <option value="US">United States</option>
                            <option value="CA">Canada</option>
                            <option value="UK">United Kingdom</option>
                            <option value="AU">Australia</option>
                            <option value="IN">India</option>
                            <!-- More countries... -->
                        </select>
                        <x-input-error :messages="$errors->get('country')" class="mt-1" />
                    </div>

                    <!-- Password -->
                </div>
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 dark:text-gray-300 mb-1" />
                    <x-text-input id="password"
                        class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                        type="password" name="password" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                        class="text-gray-700 dark:text-gray-300 mb-1" />
                    <x-text-input id="password_confirmation"
                        class="block w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm"
                        type="password" name="password_confirmation" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>
            </div>

            <!-- Full-width Submit Button -->
            <div class="pt-6">
                <x-primary-button
                    class="w-full justify-center py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 text-lg">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <div class="text-center text-sm text-gray-600 dark:text-gray-400 mt-4">
                {{ __('Already have an account?') }}
                <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline ml-1">
                    {{ __('Sign in') }}
                </a>
            </div>
        </form>
    </div>
@endsection