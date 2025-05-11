@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-12">
        <h1 class="text-4xl font-extrabold mb-8 text-center text-indigo-700">Explore Our Categories</h1>

        @if(count($categories) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                    <div
                        class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-indigo-600 mb-2">{{ $category['name'] }}</h2>
                            <p class="text-gray-700 mb-4">{{ $category['description'] }}</p>
                        </div>
                        @php
                            $id = $category['id']
                        @endphp
                        <a href="{{ route("categoryRealatedWorkshops", $id) }}"
                            class="inline-block mt-auto self-start bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2
                                                                                                                                                                                                                                        px-4 rounded-lg transition-colors duration-300">
                            Learn More
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 text-lg">No categories found.</p>
        @endif
    </div>
@endsection