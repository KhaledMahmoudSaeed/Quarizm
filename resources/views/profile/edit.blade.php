<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Settings') }}
        </h2>
        <div class="text-sm text-indigo-600 dark:text-indigo-400">
            {{ __('Last updated: ') }} {{ now()->format('M d, Y') }}
        </div>
    </div>
</x-slot>

<div class="py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Profile Card -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">
                        {{ __('Personal Information') }}
                    </h3>
                    <div class="flex space-x-2">
                        <span class="px-3 py-1 text-xs font-semibold text-indigo-600 bg-white rounded-full">
                            {{ __('Active') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="p-6 md:p-8">
                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('patch')

                    <!-- Profile Photo Section -->
                    <div class="flex flex-col items-center md:flex-row md:items-start gap-6">
                        <div class="relative group">
                            @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}"
                                    class="h-32 w-32 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-lg">
                            @else
                                <div class="h-32 w-32 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 flex items-center justify-center text-4xl font-bold text-indigo-600 dark:text-indigo-300">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input type="file" name="photo" id="photo" class="hidden" accept="image/*">
                        </div>
                        <div class="flex-1">
                            <label for="photo" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ __('Change Profile Photo') }}
                            </label>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ __('JPG, GIF or PNG. Max size of 2MB') }}
                            </p>
                            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                        </div>
                    </div>

                    <!-- Form Grid -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Full Name') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                                    class="pl-10 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Email Address') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                    class="pl-10 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-yellow-600 dark:text-yellow-400">
                                        {{ __('Your email address is unverified.') }}
                                        <button form="send-verification" class="underline hover:text-yellow-700 dark:hover:text-yellow-300">
                                            {{ __('Click to resend verification email.') }}
                                        </button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-1 text-sm text-green-600 dark:text-green-400">
                                            {{ __('A new verification link has been sent.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Phone Number') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <input id="phone" name="phone" type="tel" value="{{ old('phone', $user->phone) }}" required
                                    class="pl-10 w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Country') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="country" name="country"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="" disabled>{{ __('Select country') }}</option>
                                    <option value="US" {{ old('country', $user->country) == 'US' ? 'selected' : '' }}>United States</option>
                                    <option value="CA" {{ old('country', $user->country) == 'CA' ? 'selected' : '' }}>Canada</option>
                                    <option value="UK" {{ old('country', $user->country) == 'UK' ? 'selected' : '' }}>United Kingdom</option>
                                    <option value="AU" {{ old('country', $user->country) == 'AU' ? 'selected' : '' }}>Australia</option>
                                    <option value="IN" {{ old('country', $user->country) == 'IN' ? 'selected' : '' }}>India</option>
                                </select>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('country')" />
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                {{ __('Gender') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center space-x-3 p-3 border rounded-lg hover:border-indigo-500 transition-colors
                                    {{ old('gender', $user->gender) == 'male' ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/30' : 'border-gray-300 dark:border-gray-600' }}">
                                    <input type="radio" name="gender" value="male" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500"
                                        {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                    <span class="text-gray-700 dark:text-gray-300">{{ __('Male') }}</span>
                                </label>
                                <label class="flex items-center space-x-3 p-3 border rounded-lg hover:border-indigo-500 transition-colors
                                    {{ old('gender', $user->gender) == 'female' ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/30' : 'border-gray-300 dark:border-gray-600' }}">
                                    <input type="radio" name="gender" value="female" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500"
                                        {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                    <span class="text-gray-700 dark:text-gray-300">{{ __('Female') }}</span>
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition-colors">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Card -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">
                    {{ __('Security Settings') }}
                </h3>
            </div>
            <div class="p-6 md:p-8">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Danger Zone Card -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-red-200 dark:border-red-800">
            <div class="bg-red-50 dark:bg-red-900/20 px-6 py-4">
                <h3 class="text-xl font-bold text-red-600 dark:text-red-400">
                    {{ __('Danger Zone') }}
                </h3>
            </div>
            <div class="p-6 md:p-8">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Custom scrollbar for select elements */
    select::-webkit-scrollbar {
        width: 8px;
    }
    select::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    select::-webkit-scrollbar-thumb {
        background: #c7d2fe;
        border-radius: 4px;
    }
    select::-webkit-scrollbar-thumb:hover {
        background: #a5b4fc;
    }
    .dark select::-webkit-scrollbar-track {
        background: #374151;
    }
    .dark select::-webkit-scrollbar-thumb {
        background: #4f46e5;
    }
    .dark select::-webkit-scrollbar-thumb:hover {
        background: #6366f1;
    }
</style>
@endpush