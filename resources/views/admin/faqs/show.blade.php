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
                <h1 class="text-2xl font-semibold text-gray-900">FAQ Details</h1>
                <p class="text-sm text-gray-600 mt-1">View frequently asked question details.</p>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Status</h3>
                    @if($faq->is_published)
                        <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Published</span>
                    @else
                        <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">Draft</span>
                    @endif
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Sort Order</h3>
                    <p class="text-gray-900">{{ $faq->sort_order }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Question</h3>
                <p class="text-gray-900 text-lg font-medium">{{ $faq->question }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-2">Answer</h3>
                <div class="prose max-w-none">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $faq->answer }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 pt-6 border-t border-gray-200">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Created</h3>
                    <p class="text-gray-900">{{ $faq->created_at?->format('M d, Y H:i') }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Last Updated</h3>
                    <p class="text-gray-900">{{ $faq->updated_at?->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-2">
            <form method="POST" action="{{ route('admin.faqs.toggle-published', $faq) }}" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="inline-flex items-center rounded-lg border {{ $faq->is_published ? 'border-yellow-200 bg-yellow-50 text-yellow-700 hover:bg-yellow-100' : 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }} px-4 py-2 text-sm font-semibold">
                    {{ $faq->is_published ? 'Unpublish' : 'Publish' }}
                </button>
            </form>
            <a href="{{ route('admin.faqs.edit', $faq) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Edit
            </a>
        </div>
    </div>
@endsection
