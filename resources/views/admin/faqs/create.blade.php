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
                <h1 class="text-2xl font-semibold text-gray-900">Create FAQ</h1>
                <p class="text-sm text-gray-600 mt-1">Add a new frequently asked question.</p>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <form method="POST" action="{{ route('admin.faqs.store') }}">
            @csrf
            
            <div class="p-6 space-y-6">
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                        Question <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="question" 
                        name="question" 
                        value="{{ old('question') }}"
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
                    >{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="is_published" 
                            value="1"
                            {{ old('is_published') ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        >
                        <span class="ml-2 text-sm text-gray-700">Publish immediately</span>
                    </label>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center rounded-lg bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                    Create FAQ
                </button>
            </div>
        </form>
    </div>
@endsection
