@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-indigo-700 mb-8 text-center">All Workshops</h1>

        @if($workshops->isEmpty())
            <p class="text-center text-gray-500 text-lg">No workshops available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($workshops as $workshop)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 flex flex-col">
                        {{-- Workshop Image --}}
                        @if(!empty($workshop->img))
                            <img src="{{ $workshop->img }}" alt="{{ $workshop->title }}"
                                class="rounded-md mb-4 object-cover h-48 w-full">
                        @else
                            <div class="bg-gray-200 rounded-md mb-4 h-48 flex items-center justify-center text-gray-400">
                                No Image Available
                            </div>
                        @endif

                        {{-- Title --}}
                        <h2 class="text-2xl font-semibold text-indigo-600 mb-2">{{ $workshop->title }}</h2>

                        {{-- Description --}}
                        <p class="text-gray-700 mb-4 flex-grow">{{ $workshop->description }}</p>

                        {{-- Workshop Details --}}
                        <ul class="text-gray-600 text-sm space-y-1 mb-4">
                            <li><strong>Duration:</strong> {{ $workshop->duration }} hours</li>
                            <li><strong>Size:</strong> {{ $workshop->size }}</li>
                            <li><strong>Available Spaces:</strong>
                                {{ optional($workshop->reservations->first())->available_spaces ?? $workshop->size }}</li>
                            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($workshop->date)->format('F j, Y, g:i A') }}</li>
                            <li><strong>Price:</strong> ${{ number_format($workshop->price, 2) }}</li>
                            <li><strong>Status:</strong> {{ $workshop->finish ? 'Finished' : 'Ongoing' }}</li>
                        </ul>

                        {{-- Related User --}}
                        <div class="text-sm text-gray-500 mb-2">
                            <strong>Coach:</strong> {{ $workshop->user->name ?? 'N/A' }}
                        </div>

                        {{-- Related Category --}}
                        <div class="text-sm text-gray-500 mb-4">
                            <strong>Category:</strong> {{ $workshop->category->name ?? 'N/A' }}
                        </div>

                        {{-- Book Button --}}
                        <div class="mt-auto">
                            <form action="{{ route('reservation.store', $workshop->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="reservation" value="{{ $workshop->id }}" />
                                <button type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                                    Book Now
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection