@extends('layouts.admin')

@section('title', 'Edit Career Stat')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.career-stats.index') }}" class="text-gray-600 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Career Statistic</h1>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <form action="{{ route('admin.career-stats.update', $careerStat) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $careerStat->title) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="e.g., Batch, Applicants, Projects, Clients">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Value *</label>
                <input type="text" id="value" name="value" value="{{ old('value', $careerStat->value) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="e.g., 3 Batch, 30+ Applicants, 10+ Projects">
                @error('value')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                <textarea id="description" name="description" rows="3" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Detailed description of this statistic">{{ old('description', $careerStat->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="icon_path" class="block text-sm font-medium text-gray-700 mb-1">Icon Path</label>
                @if($careerStat->icon_path)
                    <div class="mb-3 flex items-center gap-4">
                        <img src="{{ asset($careerStat->icon_path) }}" alt="{{ $careerStat->title }}" class="h-12 w-12 object-contain rounded-lg border border-gray-200">
                        <div class="text-sm text-gray-500">
                            <p>Current icon</p>
                            <p class="text-xs">{{ $careerStat->icon_path }}</p>
                        </div>
                    </div>
                @endif
                <input type="text" id="icon_path" name="icon_path" value="{{ old('icon_path', $careerStat->icon_path) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="e.g., images/icon-batch.svg">
                <div class="mt-1 text-sm text-gray-500">
                    <p>Enter the path to the icon file relative to the public directory.</p>
                    <p>Example: images/icon-batch.svg</p>
                </div>
                @error('icon_path')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $careerStat->sort_order) }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="0">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $careerStat->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    </div>
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.career-stats.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                    Update Career Statistic
                </button>
            </div>
        </form>
    </div>
@endsection
