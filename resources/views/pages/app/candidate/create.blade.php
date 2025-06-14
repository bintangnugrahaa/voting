@extends('layouts.app')

@section('title', 'Create Candidate')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Create Candidate</h1>
            <a href="{{ route('app.candidate.index') }}"
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300 ease-in-out">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back
            </a>
        </div>

        <div class="mb-6">
            @include('includes.alert')
        </div>

        <div class="bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('app.candidate.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}" placeholder="Enter candidate name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Chairman Field -->
                    <div>
                        <label for="chairman" class="block text-sm font-medium text-gray-700 mb-1">Chairman</label>
                        <input type="text" name="chairman" id="chairman"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('chairman') border-red-500 @enderror"
                            value="{{ old('chairman') }}" placeholder="Enter chairman name">
                        @error('chairman')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vice Chairman Field -->
                    <div>
                        <label for="vice_chairman" class="block text-sm font-medium text-gray-700 mb-1">Vice
                            Chairman</label>
                        <input type="text" name="vice_chairman" id="vice_chairman"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('vice_chairman') border-red-500 @enderror"
                            value="{{ old('vice_chairman') }}" placeholder="Enter vice chairman name">
                        @error('vice_chairman')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Vision Field -->
                    <div>
                        <label for="vision" class="block text-sm font-medium text-gray-700 mb-1">Vision</label>
                        <input type="text" name="vision" id="vision"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('vision') border-red-500 @enderror"
                            value="{{ old('vision') }}" placeholder="Enter vision statement">
                        @error('vision')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mission Field -->
                    <div>
                        <label for="mission" class="block text-sm font-medium text-gray-700 mb-1">Mission</label>
                        <input type="text" name="mission" id="mission"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('mission') border-red-500 @enderror"
                            value="{{ old('mission') }}" placeholder="Enter mission statement">
                        @error('mission')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order Field -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                        <input type="text" name="sort_order" id="sort_order"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('sort_order') border-red-500 @enderror"
                            value="{{ old('sort_order') }}" placeholder="Enter sort order">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
