@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8 max-w-3xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Create New Workshop</h1>

            <form action="{{ route('workshop.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:border-gray-600 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:border-gray-600 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-gray-700 dark:text-gray-300">Date <span
                                class="text-red-500">*</span></label>
                        <input type="datetime-local" name="date" value="{{ old('date') }}"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('date') border-red-500 @enderror">
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex-1">
                        <label class="block text-gray-700 dark:text-gray-300">Duration (hours) <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="duration" value="{{ old('duration') }}"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('duration') border-red-500 @enderror">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-gray-700 dark:text-gray-300">Size <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="size" value="{{ old('size') }}"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('size') border-red-500 @enderror">
                        @error('size')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex-1">
                        <label class="block text-gray-700 dark:text-gray-300">Price ($) <span
                                class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                            class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Image</label>
                    <input type="file" name="img"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('img') border-red-500 @enderror">
                    @error('img')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Status <span class="text-red-500">*</span></label>
                    <select name="finish"
                        class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:border-gray-600 @error('finish') border-red-500 @enderror">
                        <option value="0" {{ old('finish') == '0' ? 'selected' : '' }}>Upcoming</option>
                        <option value="1" {{ old('finish') == '1' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('finish')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="mt-4 w-full bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                    Create Workshop
                </button>
            </form>
        </div>
    </div>
@endsection