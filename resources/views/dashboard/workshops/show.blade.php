@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex-shrink-0">
                    <img class="h-40 w-40 rounded-md object-cover"
                        src="{{ $workshop->img ?? 'https://via.placeholder.com/150?text=Workshop' }}"
                        alt="{{ $workshop->title }}">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-2">{{ $workshop->title }}</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $workshop->description }}</p>
                    <ul class="text-gray-700 dark:text-gray-300 space-y-2">
                        <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($workshop->date)->format('M d, Y') }}</li>
                        <li><strong>Duration:</strong> {{ $workshop->duration }} hours</li>
                        <li><strong>Size:</strong> {{ $workshop->size }}</li>
                        <li><strong>Price:</strong> ${{ number_format($workshop->price, 2) }}</li>
                        <li><strong>Status:</strong>
                            @if($workshop->finish)
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Completed</span>
                            @else
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Upcoming</span>
                            @endif
                        </li>
                        <li><strong>Instructor:</strong> {{ $workshop->user->name ?? 'N/A' }}</li>
                        <li><strong>Category:</strong> {{ $workshop->category->name ?? 'Uncategorized' }}</li>
                    </ul>
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('workshop.edit', $workshop->id) }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Edit Workshop
                        </a>
                        <a href="{{ route('workshop.index') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition-colors">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection