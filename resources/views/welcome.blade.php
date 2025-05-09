@extends("layouts.app")

@section("content")
    <div class="min-h-screen bg-white dark:bg-gray-900">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-indigo-900 to-indigo-700">
            <div class="max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                        Transform your life through coaching
                    </h1>
                    <p class="mt-6 max-w-lg mx-auto text-xl text-indigo-100">
                        Personalized guidance to help you achieve your personal and professional goals
                    </p>
                    <div class="mt-10 flex justify-center space-x-4">
                        <a href="{{ route('register') }}"
                            class="inline-block px-6 py-3 bg-white text-indigo-700 font-medium rounded-md hover:bg-indigo-50 transition-colors">
                            Get Started
                        </a>
                        <a href="#how-it-works"
                            class="inline-block px-6 py-3 border border-white text-white font-medium rounded-md hover:bg-white hover:bg-opacity-10 transition-colors">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="how-it-works" class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">How our coaching works</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-500 dark:text-gray-300">
                        A proven methodology designed for real, measurable results
                    </p>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-12 sm:grid-cols-3">
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 text-indigo-600">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900 dark:text-white">Assessment</h3>
                        <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                            We begin with a comprehensive evaluation of your goals and challenges
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 text-indigo-600">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900 dark:text-white">Strategy</h3>
                        <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                            Develop a customized plan tailored to your unique situation
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 text-indigo-600">
                            <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="mt-6 text-lg font-medium text-gray-900 dark:text-white">Implementation</h3>
                        <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                            Execute with expert guidance and accountability for results
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="bg-gray-50 dark:bg-gray-800 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">Client success stories</h2>
                </div>

                <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div class="p-6">
                        <blockquote class="text-gray-600 dark:text-gray-300">
                            <p class="text-lg italic">
                                "The coaching completely transformed my approach to business. I doubled my revenue in six
                                months."
                            </p>
                            <footer class="mt-4">
                                <p class="font-medium text-gray-900 dark:text-white">Sarah Johnson</p>
                                <p class="text-indigo-600 dark:text-indigo-400">Business Owner</p>
                            </footer>
                        </blockquote>
                    </div>

                    <div class="p-6">
                        <blockquote class="text-gray-600 dark:text-gray-300">
                            <p class="text-lg italic">
                                "The personalized attention and actionable advice made all the difference in my career."
                            </p>
                            <footer class="mt-4">
                                <p class="font-medium text-gray-900 dark:text-white">Michael Chen</p>
                                <p class="text-indigo-600 dark:text-indigo-400">Executive</p>
                            </footer>
                        </blockquote>
                    </div>

                    <div class="p-6">
                        <blockquote class="text-gray-600 dark:text-gray-300">
                            <p class="text-lg italic">
                                "The accountability helped me launch my dream business. Worth every penny!"
                            </p>
                            <footer class="mt-4">
                                <p class="font-medium text-gray-900 dark:text-white">Emma Rodriguez</p>
                                <p class="text-indigo-600 dark:text-indigo-400">Entrepreneur</p>
                            </footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="bg-indigo-700">
            <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold text-white">Ready to begin your transformation?</h2>
                <p class="mt-4 text-lg text-indigo-100">
                    Take the first step toward achieving your goals today
                </p>
                <div class="mt-8">
                    <a href="{{ route('register') }}"
                        class="inline-block px-6 py-3 bg-white text-indigo-700 font-medium rounded-md hover:bg-indigo-50 transition-colors">
                        Start Now
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection