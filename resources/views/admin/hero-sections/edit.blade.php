@extends('layouts.admin')

@section('title', 'Edit Hero Section')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.hero-sections.index') }}" class="text-gray-600 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Hero Section</h1>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <form action="{{ route('admin.hero-sections.update', $heroSection) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $heroSection->title) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter hero title">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Subtitle *</label>
                <textarea id="subtitle" name="subtitle" rows="3" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter hero subtitle">{{ old('subtitle', $heroSection->subtitle) }}</textarea>
                @error('subtitle')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Button Text *</label>
                <input type="text" id="button_text" name="button_text" value="{{ old('button_text', $heroSection->button_text) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter button text">
                @error('button_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="button_url" class="block text-sm font-medium text-gray-700 mb-1">Button URL *</label>
                <input type="text" id="button_url" name="button_url" value="{{ old('button_url', $heroSection->button_url) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter button URL (e.g., #contact, /about)">
                @error('button_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="background_image" class="block text-sm font-medium text-gray-700 mb-1">Background Image</label>
                @if($heroSection->background_image)
                    <div class="mb-3 flex items-center gap-4">
                        <img src="{{ $heroSection->background_image_url }}" alt="Current background" class="h-20 w-32 object-cover rounded-lg border border-gray-200">
                        <div class="text-sm text-gray-500">
                            <p>Current background image</p>
                            <p class="text-xs">Upload new image to replace</p>
                        </div>
                    </div>
                @endif
                <div class="mt-1 flex items-center gap-4">
                    <input type="file" id="background_image" name="background_image" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                </div>
                <div class="text-sm text-gray-500 mt-2">
                    <p>Recommended: 1920x1080px, Max 5MB</p>
                    <p>Formats: JPG, PNG, GIF, SVG</p>
                    <p>Leave empty to keep current image</p>
                </div>
                @error('background_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <div class="flex items-center h-5">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $heroSection->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                </div>
                <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.hero-sections.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                    Update Hero Section
                </button>
            </div>
        </form>
    </div>
@endsection
