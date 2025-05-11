@extends('layouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <!-- Hero Section with Animated Background -->
        <div class="relative bg-gradient-to-br from-indigo-900 to-purple-800 py-28 px-6 text-center overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center mix-blend-overlay">
                </div>
            </div>
            <div class="relative z-10 max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 animate-fade-in">
                    Our <span class="text-yellow-300">Story</span> & Mission
                </h1>
                <p class="text-xl text-indigo-100 mb-8">
                    Transforming lives through expert coaching since 2015. We believe everyone deserves access to
                    world-class guidance.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <div
                        class="px-6 py-3 bg-white/10 backdrop-blur-sm rounded-full text-white hover:bg-white/20 transition-all">
                        Meet Our Coaches
                    </div>
                    <div
                        class="px-6 py-3 bg-yellow-400 rounded-full text-indigo-900 hover:bg-yellow-300 transition-all font-medium">
                        Book a Session
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Journey Section -->
        <div class="py-20 px-6 max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span
                    class="inline-block px-4 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full mb-4">OUR
                    JOURNEY</span>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">From Small Beginnings to <span
                        class="text-indigo-600">Global Impact</span></h2>
                <div class="w-24 h-1 bg-indigo-500 mx-auto"></div>
            </div>

            <!-- Timeline -->
            <div class="relative">
                <!-- Timeline line -->
                <div class="hidden md:block absolute left-1/2 h-full w-1 bg-indigo-100 transform -translate-x-1/2"></div>

                <!-- Timeline items -->
                <div class="space-y-12 md:space-y-0">
                    <!-- Item 1 -->
                    <div class="relative md:flex justify-between items-center mb-16">
                        <div class="md:w-5/12 mb-8 md:mb-0 text-right">
                            <h3 class="text-2xl font-bold text-indigo-700 mb-2">Founded in 2015</h3>
                            <p class="text-gray-600">Started with just 3 coaches and a shared passion for helping others
                                achieve their potential.</p>
                        </div>
                        <div class="hidden md:flex justify-center md:w-2/12">
                            <div
                                class="flex items-center justify-center w-16 h-16 rounded-full bg-indigo-600 text-white text-xl font-bold border-4 border-white shadow-lg">
                                1
                            </div>
                        </div>
                        <div class="md:w-5/12">
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                                alt="Early days" class="rounded-xl shadow-md w-full h-64 object-cover">
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="relative md:flex justify-between items-center mb-16">
                        <div class="md:w-5/12 order-3">
                            <h3 class="text-2xl font-bold text-indigo-700 mb-2">First 100 Clients</h3>
                            <p class="text-gray-600">By 2017, we'd helped transform the lives of our first 100 clients
                                across 15 countries.</p>
                        </div>
                        <div class="hidden md:flex justify-center md:w-2/12 order-2">
                            <div
                                class="flex items-center justify-center w-16 h-16 rounded-full bg-indigo-600 text-white text-xl font-bold border-4 border-white shadow-lg">
                                2
                            </div>
                        </div>
                        <div class="md:w-5/12 order-1 mb-8 md:mb-0">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                                alt="Team growth" class="rounded-xl shadow-md w-full h-64 object-cover">
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="relative md:flex justify-between items-center">
                        <div class="md:w-5/12 mb-8 md:mb-0 text-right">
                            <h3 class="text-2xl font-bold text-indigo-700 mb-2">Today's Global Network</h3>
                            <p class="text-gray-600">50+ expert coaches serving clients in 40+ countries with 95%
                                satisfaction rate.</p>
                        </div>
                        <div class="hidden md:flex justify-center md:w-2/12">
                            <div
                                class="flex items-center justify-center w-16 h-16 rounded-full bg-indigo-600 text-white text-xl font-bold border-4 border-white shadow-lg">
                                3
                            </div>
                        </div>
                        <div class="md:w-5/12">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                                alt="Global team" class="rounded-xl shadow-md w-full h-64 object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span
                        class="inline-block px-4 py-1 text-sm font-semibold text-indigo-600 bg-indigo-100 rounded-full mb-4">OUR
                        VALUES</span>
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">The Pillars of <span class="text-indigo-600">Our
                            Success</span></h2>
                    <div class="w-24 h-1 bg-indigo-500 mx-auto"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border-l-4 border-indigo-500">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Integrity</h3>
                        <p class="text-gray-600">We maintain the highest ethical standards in all our coaching relationships
                            and business practices.</p>
                    </div>

                    <!-- Value 2 -->
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border-l-4 border-indigo-500">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Excellence</h3>
                        <p class="text-gray-600">We pursue mastery in our craft and deliver exceptional results for every
                            client we serve.</p>
                    </div>

                    <!-- Value 3 -->
                    <div
                        class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border-l-4 border-indigo-500">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Community</h3>
                        <p class="text-gray-600">We foster supportive networks where clients and coaches grow together
                            through shared experiences.</p>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

    @push('styles')
        <style>
            .animate-fade-in {
                animation: fadeIn 1s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    @endpush
@endsection