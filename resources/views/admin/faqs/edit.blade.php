@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </a>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Edit FAQ</h1>
                <p class="text-sm text-gray-600 mt-1">Update the frequently asked question.</p>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                        Question <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="question" 
                        name="question" 
                        value="{{ old('question', $faq->question) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter the question"
                        required
                    >
                    @error('question')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">
                        Answer <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="answer" 
                        name="answer" 
                        rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter the answer"
                        required
                    >{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                            Sort Order
                        </label>
                        <input 
                            type="number" 
                            id="sort_order" 
                            name="sort_order" 
                            value="{{ old('sort_order', $faq->sort_order) }}"
                            min="1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter sort order"
                        >
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center mt-7">
                            <input 
                                type="checkbox" 
                                name="is_published" 
                                value="1"
                                {{ old('is_published', $faq->is_published) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >
                            <span class="ml-2 text-sm text-gray-700">Published</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Delete this FAQ?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100">
                            Delete
                        </button>
                    </form>
                </div>
                <button type="submit" class="inline-flex items-center rounded-lg bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                    Update FAQ
                </button>
            </div>
        </form>
    </div>
@endsection
