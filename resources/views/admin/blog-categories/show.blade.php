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
            <h1 class="text-2xl font-semibold text-gray-900">{{ $blogCategory->name }}</h1>
            <p class="text-sm text-gray-600 mt-1">Category details and statistics.</p>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 space-y-6">
            <!-- Header Info -->
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-xl flex items-center justify-center" style="background-color: {{ $blogCategory->color }};">
                    <span class="text-white text-xl font-bold">{{ strtoupper(substr($blogCategory->name, 0, 1)) }}</span>
                </div>
                <div class="flex-1">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $blogCategory->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $blogCategory->slug }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.blog-categories.edit', $blogCategory) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Edit
                    </a>
                </div>
            </div>

            <!-- Status Badges -->
            <div class="flex flex-wrap gap-2">
                @if($blogCategory->is_active)
                    <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Active</span>
                @else
                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">Inactive</span>
                @endif
                
                <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 px-2.5 py-1 text-xs font-semibold">
                    Sort Order: {{ $blogCategory->sort_order }}
                </span>
            </div>

            <!-- Description -->
            @if($blogCategory->description)
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Description</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm text-gray-700">{{ $blogCategory->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Statistics -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-4">Statistics</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $blogCategory->blog_count }}</div>
                        <div class="text-xs text-gray-600 mt-1">Published Blog Posts</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $blogCategory->blogs()->count() }}</div>
                        <div class="text-xs text-gray-600 mt-1">Total Blog Posts</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-gray-900">{{ $blogCategory->created_at->format('M d, Y') }}</div>
                        <div class="text-xs text-gray-600 mt-1">Created Date</div>
                    </div>
                </div>
            </div>

            <!-- Color Information -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Color</h3>
                <div class="flex items-center gap-4 bg-gray-50 rounded-lg p-4">
                    <div class="w-12 h-12 rounded-lg border border-gray-300" style="background-color: {{ $blogCategory->color }};"></div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $blogCategory->color }}</p>
                        <p class="text-xs text-gray-600">Category display color</p>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">SEO Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Slug</p>
                        <p class="text-sm font-mono text-gray-900">{{ $blogCategory->slug }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Created</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $blogCategory->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent News Posts -->
            @if($blogCategory->publishedBlogs()->count() > 0)
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Recent News Posts</h3>
                    <div class="space-y-3">
                        @foreach($blogCategory->publishedBlogs()->latest('published_at')->take(5)->get() as $blog)
                            <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                <div class="flex items-center gap-3">
                                    @if($blog->image)
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="w-10 h-10 object-cover rounded">
                                    @else
                                        <div class="w-10 h-10 rounded bg-gray-300"></div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $blog->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $blog->published_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">Edit</a>
                            </div>
                        @endforeach
                    </div>
                    @if($blogCategory->publishedBlogs()->count() > 5)
                        <div class="mt-3 text-center">
                            <a href="{{ route('admin.blogs.index') }}?category={{ $blogCategory->slug }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                                View all {{ $blogCategory->blog_count }} news posts
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-600">No news posts in this category yet.</p>
                    <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center gap-2 mt-3 text-blue-600 hover:text-blue-700 font-semibold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create First News Post
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
