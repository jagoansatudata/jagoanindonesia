@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.blog-categories.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Categories
            </a>
        </div>
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Edit News Category</h1>
            <p class="text-sm text-gray-600 mt-1">Update the category information.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <form method="POST" action="{{ route('admin.blog-categories.update', $blogCategory) }}">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Category Name</label>
                    <input type="text" id="name" name="name" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                           value="{{ old('name', $blogCategory->name) }}" placeholder="Enter category name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                              placeholder="Brief description of the category">{{ old('description', $blogCategory->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Color -->
                    <div>
                        <label for="color" class="block text-sm font-semibold text-gray-900 mb-2">Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="color" name="color" required
                                   class="h-10 w-20 rounded-lg border border-gray-300 cursor-pointer"
                                   value="{{ old('color', $blogCategory->color) }}">
                            <input type="text" id="color-text" name="color-text" 
                                   class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm font-mono focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   value="{{ old('color', $blogCategory->color) }}" placeholder="#000000">
                        </div>
                        @error('color')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Choose a color to represent this category</p>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-gray-900 mb-2">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" min="0"
                               class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                               value="{{ old('sort_order', $blogCategory->sort_order) }}" placeholder="0">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', $blogCategory->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Inactive categories won't be shown in the frontend</p>
                </div>

                <!-- Preview -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Preview</label>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div id="preview-color" class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: {{ old('color', $blogCategory->color) }};">
                                <span id="preview-letter" class="text-white text-xs font-bold">{{ strtoupper(substr(old('name', $blogCategory->name), 0, 1)) }}</span>
                            </div>
                            <div class="min-w-0">
                                <div id="preview-name" class="font-semibold text-gray-900">{{ old('name', $blogCategory->name) }}</div>
                                <div class="text-xs text-gray-500">{{ Str::slug(old('name', $blogCategory->name)) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog Count -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-blue-900">Associated Blog Posts</p>
                            <p class="text-xs text-blue-700">This category currently has {{ $blogCategory->blog_count }} published blog posts</p>
                        </div>
                        <div class="bg-blue-100 text-blue-900 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $blogCategory->blog_count }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
                <a href="{{ route('admin.blog-categories.index') }}" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="rounded-lg bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                    Update Category
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const colorInput = document.getElementById('color');
            const colorTextInput = document.getElementById('color-text');
            const previewColor = document.getElementById('preview-color');
            const nameInput = document.getElementById('name');
            const previewName = document.getElementById('preview-name');
            const previewLetter = document.getElementById('preview-letter');

            // Sync color inputs
            colorInput.addEventListener('change', function() {
                colorTextInput.value = this.value;
                previewColor.style.backgroundColor = this.value;
            });

            colorTextInput.addEventListener('input', function() {
                if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                    colorInput.value = this.value;
                    previewColor.style.backgroundColor = this.value;
                }
            });

            // Update preview name
            nameInput.addEventListener('input', function() {
                const name = this.value || 'Category Name';
                previewName.textContent = name;
                previewLetter.textContent = name.charAt(0).toUpperCase();
            });
        });
    </script>
@endsection
