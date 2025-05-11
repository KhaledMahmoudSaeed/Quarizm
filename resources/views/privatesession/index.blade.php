@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-indigo-700 mb-8 text-center">Private Sessions</h1>

        @if($privateSessionsData->isEmpty())
            <p class="text-center text-gray-500 text-lg">No private sessions found.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($privateSessionsData as $session)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 flex flex-col">
                        {{-- Session Date --}}
                        <p class="text-gray-700 mb-4 font-semibold">
                            <strong>Your Session Date:</strong> {{ \Carbon\Carbon::parse($session->date)->format('F j, Y, g:i A') }}
                        </p>

                        {{-- Coach Info --}}
                        <div class="flex items-center space-x-4 mb-6">
                            @if(!empty($session->coach->img))
                                <img src="{{ $session->coach->img }}" alt="{{ $session->coach->name }}"
                                    class="w-20 h-20 rounded-full object-cover border border-indigo-300">
                            @else
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif

                            <div>
                                <h2 class="text-xl font-semibold text-indigo-600">{{ $session->coach->name }}</h2>
                                <p class="text-gray-600">{{ $session->coach->email }}</p>
                                <p class="text-gray-600">{{ $session->coach->phone }}</p>
                                <p class="text-gray-600">{{ $session->coach->country }}</p>
                                <p class="text-gray-600 capitalize">{{ $session->coach->gender }}</p>
                            </div>
                        </div>

                        {{-- Additional Coach Info --}}
                        <ul class="text-gray-700 space-y-1">
                            <li><strong>Account Created:</strong>
                                {{ \Carbon\Carbon::parse($session->coach->created_at)->format('F j, Y') }}</li>
                        </ul>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection