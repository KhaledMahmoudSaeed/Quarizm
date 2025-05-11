@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Workshop</h1>
            <form action="{{ route('workshop.update', $workshop->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Title</label>
                    <input type="text" name="title" value="{{ old('title', $workshop->title) }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:border-gray-600">{{ old('description', $workshop->description) }}</textarea>
                </div>
                <div class="flex gap-4">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Date</label>
                        <input type="datetime-local" name="date"
                            value="{{ old('date', \Carbon\Carbon::parse($workshop->date)->format('Y-m-d\TH:i')) }}"
                            class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Duration (hours)</label>
                        <input type="number" name="duration" value="{{ old('duration', $workshop->duration) }}"
                            class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </div>
                <div class="flex gap-4">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Size</label>
                        <input type="text" name="size" value="{{ old('size', $workshop->size) }}"
                            class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    </div>
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Price ($)</label>
                        <input type="number" name="price" value="{{ old('price', $workshop->price) }}"
                            class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="img" class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                    @if($workshop->img)
                        <img src="{{ $workshop->img }}" class="h-20 mt-2 rounded-md" alt="Workshop Image">
                    @endif
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Status</label>
                    <select name="finish" class="px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600">
                        <option value="0" {{ !$workshop->finish ? 'selected' : '' }}>Upcoming</option>
                        <option value="1" {{ $workshop->finish ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    Update Workshop
                </button>
            </form>
        </div>
    </div>
@endsection