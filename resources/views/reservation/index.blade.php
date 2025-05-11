@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- Success message --}}
        @if(session('fail'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('fail') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 0 0-1.414-1.414L10 7.172 7.066 4.238a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 12.828l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934z" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Your workshopsReserved display here --}}
        @foreach ($workshopsReserved as $reserved)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                {{-- Workshop Title --}}
                <h2 class="text-2xl font-semibold text-indigo-700 mb-2">{{ $reserved->workshop->title ?? 'Untitled Workshop' }}
                </h2>

                {{-- Workshop Description --}}
                <p class="text-gray-700 mb-4">{{ $reserved->workshop->description ?? 'No description available.' }}</p>

                {{-- Workshop Date --}}
                <p class="text-gray-600 mb-2">
                    <strong>Date:</strong> {{ \Carbon\Carbon::parse($reserved->workshop->date)->format('F j, Y, g:i A') }}
                </p>

                {{-- Available Spaces --}}
                <p class="text-gray-600 mb-2">
                    <strong>Available Spaces:</strong> {{ $reserved->available_spaces ?? 'N/A' }}
                </p>

                {{-- Workshop Duration --}}
                <p class="text-gray-600 mb-2">
                    <strong>Duration:</strong> {{ $reserved->workshop->duration ?? 'N/A' }} hours
                </p>

                {{-- Workshop Status --}}
                <p class="text-gray-600 mb-4">
                    <strong>Status:</strong> {{ $reserved->workshop->finish ? 'Finished' : 'Ongoing' }}
                </p>

                {{-- Cancel / Delete Reservation Button --}}
                <form action="{{ route('reservation.destroy', $reserved->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-300">
                        Cancel Reservation
                    </button>
                </form>
            </div>
        @endforeach



    </div>
@endsection