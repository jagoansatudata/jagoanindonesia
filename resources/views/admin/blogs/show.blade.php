@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.blogs.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to News Posts
            </a>
        </div>
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">{{ $blog->title }}</h1>
            <p class="text-sm text-gray-600 mt-1">News post details and preview.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 space-y-6">
            <!-- Header Info -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    @if($blog->image)
                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="w-20 h-20 object-cover rounded-xl border border-gray-200">
                    @else
                        <div class="w-20 h-20 rounded-xl bg-gray-100 flex items-center justify-center border border-gray-200">
                            <span class="text-xs font-semibold text-gray-500">IMG</span>
                        </div>
                    @endif
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">{{ $blog->title }}</h2>
                        <p class="text-sm text-gray-600">By {{ $blog->author }} on {{ $blog->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Edit
                    </a>
                </div>
            </div>

            <!-- Status Badges -->
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full {{ $blog->status === 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-700' }} px-2.5 py-1 text-xs font-semibold">
                    {{ $blog->status === 'published' ? 'Published' : 'Draft' }}
                </span>
                <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 px-2.5 py-1 text-xs font-semibold">
                    {{ $blog->category }}
                </span>
                @if($blog->featured)
                    <span class="inline-flex items-center rounded-full bg-yellow-50 text-yellow-700 px-2.5 py-1 text-xs font-semibold">
                        Featured
                    </span>
                @endif
            </div>

            <!-- Meta Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Author</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $blog->author }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Category</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $blog->category }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Status</p>
                    <p class="text-sm font-semibold text-gray-900">{{ ucfirst($blog->status) }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Published Date</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $blog->published_at?->format('M d, Y') ?? 'Not published' }}</p>
                </div>
            </div>

            <!-- Excerpt -->
            @if($blog->excerpt)
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Excerpt</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-700">{{ $blog->excerpt }}</p>
                    </div>
                </div>
            @endif

            <!-- Content -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Content</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="prose prose-sm max-w-none text-gray-700">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">SEO Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Slug</p>
                        <p class="text-sm font-mono text-gray-900">{{ $blog->slug }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Created</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $blog->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
