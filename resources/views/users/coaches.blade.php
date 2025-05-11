@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <!-- Hero Header -->
        <div class="relative overflow-hidden rounded-2xl mb-12 bg-gradient-to-r from-indigo-900 to-purple-800">
            <div class="relative z-10 py-16 px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Meet Our <span class="text-yellow-300">Elite</span> Coaches
                </h1>
                <p class="text-lg text-indigo-100 max-w-3xl mx-auto">
                    World-class professionals dedicated to your success. Each brings unique expertise and proven results.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-2">
                    <span class="px-4 py-2 text-sm font-medium text-white rounded-full bg-indigo-600">All Coaches</span>
                    <span class="px-4 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-full">Certified</span>
                    <span class="px-4 py-2 text-sm font-medium text-white hover:bg-white/10 rounded-full">Available
                        Now</span>
                </div>
            </div>
        </div>

        @if($users->count())
            <!-- Coach Grid -->
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($users as $user)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                        <!-- Coach Image -->
                        <div class="relative h-56 w-full overflow-hidden">
                            <img src="{{ $user->img ?? 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80' }}"
                                alt="{{ $user->name }}"
                                class="object-cover w-full h-full transition-transform duration-500 hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6">
                                <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                                <span
                                    class="inline-block px-3 py-1 mt-2 text-xs font-semibold tracking-wider text-indigo-100 uppercase bg-indigo-600 rounded-full">
                                    {{ $user->role }}
                                </span>
                            </div>
                        </div>

                        <!-- Coach Info -->
                        <div class="p-6">
                            <!-- Basic Info -->
                            <div class="mb-4 space-y-2 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <a href="mailto:{{ $user->email }}"
                                        class="hover:text-indigo-600 hover:underline">{{ $user->email }}</a>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span>{{ $user->phone ?? 'Not provided' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                    <span>{{ $user->country }} ({{ ucfirst($user->gender) }})</span>
                                </div>
                            </div>

                            <!-- Experience -->
                            <div class="flex items-center space-x-2 mb-4 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $user->coachData->experience_years ?? '0' }} years experience</span>
                            </div>

                            <!-- About Section -->
                            @if($user->coachData && $user->coachData->about)
                                <div class="mb-4">
                                    <h3 class="text-sm font-semibold text-indigo-700 mb-1">About Coach</h3>
                                    <p class="text-xs text-gray-600 line-clamp-3">{{ $user->coachData->about }}</p>
                                </div>
                            @endif

                            <!-- Certificate -->
                            @if($user->coachData && $user->coachData->certificate_img)
                                <div class="mb-4">
                                    <h3 class="text-sm font-semibold text-indigo-700 mb-1">Certification</h3>
                                    <img src="{{ $user->coachData->certificate_img }}" alt="Coach Certification"
                                        class="w-full rounded border border-gray-200 mt-2 max-h-32 object-contain">
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <a href="#" class="px-4 py-2 border rounded-lg hover:bg-indigo-50 text-indigo-600 border-indigo-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    {{ $users->onEachSide(1)->links('pagination::tailwind') }}
                    <a href="#" class="px-4 py-2 border rounded-lg hover:bg-indigo-50 text-indigo-600 border-indigo-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <svg class="w-48 h-48 mx-auto text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <h2 class="mt-6 text-2xl font-bold text-gray-800">No Coaches Available</h2>
                    <p class="mt-2 text-gray-600">We're currently expanding our team of professional coaches. Check back soon!
                    </p>
                    <div class="mt-6">
                        <a href="#"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition-colors duration-300 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                    clip-rule="evenodd" />
                            </svg>
                            Join Our Team
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('styles')
        <style>
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush
@endsection