@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-indigo-700 mb-8 text-center">Related Workshops</h1>

        @if($workshops->isEmpty())
            <p class="text-center text-gray-500 text-lg">No workshops found for this category.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($workshops as $workshop)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 p-6 flex flex-col">
                        {{-- Workshop Image --}}
                        @if(!empty($workshop->img))
                            <img src="{{  $workshop->img }}" alt="{{ $workshop->title }}"
                                class="rounded-md mb-4 object-cover h-48 w-full">
                        @else
                            <div class="bg-gray-200 rounded-md mb-4 h-48 flex items-center justify-center text-gray-400">
                                No Image Available
                            </div>
                        @endif

                        {{-- Title --}}
                        <h2 class="text-2xl font-semibold text-indigo-600 mb-2">{{ $workshop->title ?? 'Untitled Workshop' }}</h2>

                        {{-- Description --}}
                        <p class="text-gray-700 mb-4 flex-grow">{{ $workshop->description ?? 'No description available.' }}</p>

                        {{-- Workshop Details --}}
                        <ul class="text-gray-600 text-sm space-y-1 mb-4">
                            <li><strong>Finish Status:</strong> {{ $workshop->finish ? 'Finished' : 'Ongoing' }}</li>
                            <li><strong>Price:</strong> ${{ number_format($workshop->price, 2) }}</li>
                            <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($workshop->date)->format('F j, Y') }}</li>
                            <li><strong>Available Spaces:</strong>
                                {{ optional($workshop->reservations->first())->available_spaces ?? $workshop->size }}</li>
                            <li><strong>Duration:</strong> {{ $workshop->duration }}</li>
                        </ul>

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