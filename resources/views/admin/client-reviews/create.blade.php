@extends('layouts.admin')

@section('title', 'Add Client Review')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('client-reviews.index') }}" class="text-gray-600 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-2xl font-semibold text-gray-900">Add New Client Review</h1>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <form action="{{ route('client-reviews.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="reviewer_name" class="block text-sm font-medium text-gray-700 mb-1">Reviewer Name *</label>
                    <input type="text" id="reviewer_name" name="reviewer_name" value="{{ old('reviewer_name') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter reviewer name">
                    @error('reviewer_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="reviewer_title" class="block text-sm font-medium text-gray-700 mb-1">Reviewer Title</label>
                    <input type="text" id="reviewer_title" name="reviewer_title" value="{{ old('reviewer_title') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g., CEO, Manager, Developer">
                    @error('reviewer_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="review_content" class="block text-sm font-medium text-gray-700 mb-1">Review Content *</label>
                <textarea id="review_content" name="review_content" rows="4" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter the review content...">{{ old('review_content') }}</textarea>
                @error('review_content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating *</label>
                <select id="rating" name="rating" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Rating</option>
                    <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>5 Stars - Excellent</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars - Very Good</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars - Good</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars - Fair</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star - Poor</option>
                </select>
                @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="avatar_path" class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                <div class="mt-1 flex items-center gap-4">
                    <input type="file" id="avatar_path" name="avatar_path" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                    <div class="text-sm text-gray-500">
                        <p>Recommended: 150x150px, Max 2MB</p>
                        <p>Formats: JPG, PNG, GIF</p>
                    </div>
                </div>
                @error('avatar_path')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="0">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    </div>
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('client-reviews.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                    Create Review
                </button>
            </div>
        </form>
    </div>
@endsection
