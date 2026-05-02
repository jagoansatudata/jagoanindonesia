@extends('layouts.admin')

@section('title', 'Edit Intern Experience')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('intern-experiences.index') }}" class="text-gray-600 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-2xl font-semibold text-gray-900">Edit Intern Experience</h1>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <form action="{{ route('intern-experiences.update', $internExperience) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="intern_name" class="block text-sm font-medium text-gray-700 mb-1">Intern Name *</label>
                    <input type="text" id="intern_name" name="intern_name" value="{{ old('intern_name', $internExperience->intern_name) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter intern name">
                    @error('intern_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="intern_role" class="block text-sm font-medium text-gray-700 mb-1">Intern Role</label>
                    <input type="text" id="intern_role" name="intern_role" value="{{ old('intern_role', $internExperience->intern_role) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="e.g., UI/UX Designer Intern">
                    @error('intern_role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="experience_content" class="block text-sm font-medium text-gray-700 mb-1">Experience Content *</label>
                <textarea id="experience_content" name="experience_content" rows="4" maxlength="200" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter the experience content..." oninput="updateCharCount()">{{ old('experience_content', $internExperience->experience_content) }}</textarea>
                <div class="mt-1 text-sm text-gray-500">
                    <span id="char-count">0</span>/200 characters
                </div>
                @error('experience_content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating *</label>
                <select id="rating" name="rating" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Rating</option>
                    <option value="5" {{ old('rating', $internExperience->rating) == 5 ? 'selected' : '' }}>5 Stars - Excellent</option>
                    <option value="4" {{ old('rating', $internExperience->rating) == 4 ? 'selected' : '' }}>4 Stars - Very Good</option>
                    <option value="3" {{ old('rating', $internExperience->rating) == 3 ? 'selected' : '' }}>3 Stars - Good</option>
                    <option value="2" {{ old('rating', $internExperience->rating) == 2 ? 'selected' : '' }}>2 Stars - Fair</option>
                    <option value="1" {{ old('rating', $internExperience->rating) == 1 ? 'selected' : '' }}>1 Star - Poor</option>
                </select>
                @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="avatar_path" class="block text-sm font-medium text-gray-700 mb-1">Avatar</label>
                @if($internExperience->avatar_path)
                    <div class="mb-3 flex items-center gap-4">
                        <div class="inline-flex items-center justify-center h-20 w-20 rounded-full border border-gray-200 bg-gray-100 overflow-hidden">
                            <img src="{{ $internExperience->avatar_url }}" alt="{{ $internExperience->intern_name }}" class="h-20 w-20 object-cover" onerror="this.style.display='none'; const fb=this.parentElement.querySelector('[data-img-fallback]'); if(fb){ fb.style.display='block'; }" />
                            <svg data-img-fallback style="display:none" class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="text-sm text-gray-500">
                            <p>Current avatar</p>
                            <p class="text-xs">Upload new avatar to replace</p>
                        </div>
                    </div>
                @endif
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
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $internExperience->sort_order) }}" min="0"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="0">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $internExperience->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    </div>
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('intern-experiences.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                    Update Experience
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateCharCount() {
            const textarea = document.getElementById('experience_content');
            const charCount = document.getElementById('char-count');
            const currentLength = textarea.value.length;
            charCount.textContent = currentLength;
            
            if (currentLength >= 200) {
                charCount.classList.add('text-red-600');
                charCount.classList.remove('text-gray-500');
            } else {
                charCount.classList.remove('text-red-600');
                charCount.classList.add('text-gray-500');
            }
        }

        // Initialize character count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateCharCount();
        });
    </script>
@endsection
