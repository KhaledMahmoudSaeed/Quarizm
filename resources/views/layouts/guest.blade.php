<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Coachify') }} | {{ $title ?? 'Welcome' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Meta Tags -->
    <meta name="description" content="Transform your life with our professional coaching services">

    @stack('styles')

</head>

<body
    class="font-sans text-gray-900 antialiased bg-gradient-to-br from-indigo-50 to-white dark:from-gray-800 dark:to-gray-900 min-h-screen">
    <!-- Background pattern (hidden in dark mode) -->

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 sm:px-0">
        <!-- Logo with subtle animation -->
        <!-- Main content card with subtle shadow and animation -->
        <div
            class=" w-full sm:max-w-2xl bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>

</html>