@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-600 mt-1">Welcome back, {{ auth()->user()->name ?? 'Admin' }}. Here's what's happening with your admin panel today.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Total Users</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Admin Users</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['admin_users'] }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Activities</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['total_activities'] }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Total Clients</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['total_clients'] }}</div>
                    <div class="text-xs text-gray-500">{{ $stats['active_clients'] }} active</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">New Users (Today)</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['new_users_today'] }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Web Visits</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['web_visits_total'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500">{{ $stats['web_visits_today'] ?? 0 }} today</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-gray-50 text-gray-700 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-2v13"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6v13h6"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10l12-2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">News Views</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['news_views_total'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500">{{ $stats['news_views_today'] ?? 0 }} today</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Blog Views</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['blog_views_total'] ?? 0 }}</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="text-xs font-semibold text-gray-500">Comments</div>
                    <div class="mt-1 text-2xl font-bold text-gray-900">{{ $stats['comments_total'] ?? 0 }}</div>
                    <div class="text-xs text-gray-500">{{ $stats['comments_pending'] ?? 0 }} pending • {{ $stats['comments_approved'] ?? 0 }} approved</div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h6m-6 8l-4-4V4a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2H7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-900">Recent Activities</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Latest activities that appear on Home page.</p>
                </div>
                <a href="{{ route('admin.activities.index') }}" class="text-sm font-semibold text-gray-900 hover:underline">View all</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="text-left font-semibold px-6 py-3">Title</th>
                            <th class="text-left font-semibold px-6 py-3">Category</th>
                            <th class="text-left font-semibold px-6 py-3">Published</th>
                            <th class="text-right font-semibold px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @if($recent_activities->count() > 0)
                            @foreach($recent_activities as $activity)
                            <tr class="hover:bg-gray-50/70">
                                <td class="px-6 py-3 font-semibold text-gray-900">{{ $activity->title }}</td>
                                <td class="px-6 py-3 text-gray-700">{{ $activity->category }}</td>
                                <td class="px-6 py-3">
                                    @if($activity->is_published)
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Yes</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">No</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.activities.edit', $activity) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                    No activities found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-900">Recent Users</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Latest users registered.</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-gray-900 hover:underline">View all</a>
            </div>

            <div class="divide-y divide-gray-100">
                @if($recent_users->count() > 0)
                    @foreach($recent_users as $user)
                    <div class="px-6 py-4 flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <div class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500 truncate">{{ $user->email }}</div>
                        </div>
                        <div>
                            @if($user->is_admin)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Admin</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">User</span>
                            @endif
                        </div>
                    </div>
                @endforeach
                @else
                    <div class="px-6 py-8 text-center text-sm text-gray-500">
                        No users found
                    </div>
                @endif
            </div>
        </div>

    <!-- Trusted by Clients Section -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden mt-4">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h2 class="text-sm font-semibold text-gray-900">Trusted by Clients</h2>
                <p class="text-xs text-gray-500 mt-0.5">Clients that trust your services across various industries.</p>
            </div>
            <a href="{{ route('clients.index') }}" class="text-sm font-semibold text-gray-900 hover:underline">Manage all</a>
        </div>
        <div class="p-6">
            @if($clients->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($clients as $client)
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center justify-center h-24 hover:bg-gray-100 transition-colors">
                            @if($client->logo_path)
                                <img src="{{ asset('storage/' . $client->logo_path) }}" alt="{{ $client->name }}" class="max-h-full max-w-full object-contain">
                            @else
                                <div class="text-center">
                                    <div class="text-xs font-medium text-gray-700 text-center">{{ Str::limit($client->name, 15) }}</div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <p class="text-sm text-gray-500 mb-2">No clients yet</p>
                    <a href="{{ route('clients.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add Client
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
