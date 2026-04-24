@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Blog & News Analytics</h1>
        <p class="text-sm text-gray-600 mt-1">Comprehensive analytics and reporting for your blog posts and news articles.</p>
    </div>

    <!-- Filters -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-4 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Period</label>
                <select name="period" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="7" {{ $period == '7' ? 'selected' : '' }}>Last 7 days</option>
                    <option value="30" {{ $period == '30' ? 'selected' : '' }}>Last 30 days</option>
                    <option value="90" {{ $period == '90' ? 'selected' : '' }}>Last 90 days</option>
                    <option value="365" {{ $period == '365' ? 'selected' : '' }}>Last year</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="all" {{ $type == 'all' ? 'selected' : '' }}>All Posts</option>
                    <option value="blog" {{ $type == 'blog' ? 'selected' : '' }}>Blog Posts</option>
                    <option value="news" {{ $type == 'news' ? 'selected' : '' }}>News Articles</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                    Apply Filters
                </button>
                <a href="{{ route('admin.analytics.blogs.export', ['type' => $type]) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                    Export CSV
                </a>
            </div>
        </form>
    </div>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Total Posts</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $totalPosts }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $postsInPeriod }} created in selected period</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Published</div>
                    <div class="mt-1 text-2xl font-bold text-green-600">{{ $publishedPosts }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $publishedInPeriod }} published in period</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Total Views</div>
                    <div class="mt-1 text-2xl font-bold text-indigo-600">{{ $totalViews }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $viewsInPeriod }} views in period</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Unique Views</div>
                    <div class="mt-1 text-2xl font-bold text-teal-600">{{ $uniqueViewsInPeriod }}</div>
                    <div class="text-xs text-gray-500 mt-1">Unique visitors in period</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Most Viewed Posts -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Most Viewed Posts</h2>
            <div class="space-y-3">
                @forelse ($mostViewedPosts as $index => $post)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <div class="font-medium text-gray-900">{{ Str::limit($post->title, 50) }}</div>
                            <div class="text-sm text-gray-500">{{ $post->author ?? 'Unknown' }} · {{ $post->type }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-semibold text-indigo-600">{{ $post->blog_views_count }}</div>
                            <div class="text-xs text-gray-500">views</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-8">No view data available</div>
                @endforelse
            </div>
        </div>

        <!-- Category Analytics -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Category Performance</h2>
            <div class="space-y-3">
                @forelse ($categoryAnalytics as $category)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <div class="font-medium text-gray-900">{{ $category->name }}</div>
                            <div class="text-sm text-gray-500">{{ $category->published_blogs }} published, {{ $category->blogs_count - $category->published_blogs }} drafts</div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-semibold text-gray-900">{{ $category->published_blogs }}</div>
                            <div class="text-xs text-gray-500">posts</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-8">No categories found</div>
                @endforelse
            </div>
        </div>

        <!-- Popular Categories -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Top Categories by Posts</h2>
            <div class="space-y-3">
                @forelse ($popularCategories as $index => $category)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-semibold">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">{{ $category->name }}</div>
                                <div class="text-sm text-gray-500">{{ $category->description ? Str::limit($category->description, 50) : 'No description' }}</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-semibold text-gray-900">{{ $category->blogs_count }}</div>
                            <div class="text-xs text-gray-500">posts</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-8">No categories with posts found</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Author Statistics -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Top Authors</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($authorStats as $index => $author)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-semibold">
                            {{ strtoupper(substr($author->author, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">{{ $author->author }}</div>
                            <div class="text-sm text-gray-500">{{ $author->total_posts }} posts</div>
                        </div>
                    </div>
                    <div class="text-lg font-semibold text-gray-900">#{{ $index + 1 }}</div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-8">No authors found</div>
            @endforelse
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($recentPosts as $post)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($post->title, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->author ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->type == 'blog' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($post->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $post->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No recent activity found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Daily View Trends -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Daily View Trends</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Views</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unique Views</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($dailyViewTrends as $trend)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($trend->date)->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">{{ $trend->total_views }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-teal-600">{{ $trend->unique_views }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">No view data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Monthly Trends -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Monthly Trends (Last 12 Months)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Posts</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($monthlyTrends as $trend)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $trend->month }} {{ $trend->year }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trend->total }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">{{ $trend->published }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-600">{{ $trend->featured }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No trend data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Chart data loading (optional enhancement)
    document.addEventListener('DOMContentLoaded', function() {
        // You can add Chart.js integration here for visual charts
        console.log('Blog Analytics Dashboard loaded');
    });
</script>
@endpush
