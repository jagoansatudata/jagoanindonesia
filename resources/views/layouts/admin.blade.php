<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin' }} - {{ config('app.name', 'Jagoan Indonesia') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/fav.svg') }}">

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900" style="font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
@php
    $user = auth()->user();

    $pendingCount = cache()->remember('admin.pending_comments_count', now()->addSeconds(30), function () {
        try {
            return \App\Models\Comment::where('is_approved', false)->count();
        } catch (\Throwable $e) {
            return 0;
        }
    });

    $unreadCount = cache()->remember('admin.unread_messages_count', now()->addSeconds(30), function () {
        try {
            return \App\Models\Message::where('is_read', false)->count();
        } catch (\Throwable $e) {
            return 0;
        }
    });
@endphp
<div class="min-h-screen flex">
    <aside class="w-72 hidden lg:flex flex-col border-r border-gray-200 bg-white">
        <div class="h-16 px-6 flex items-center gap-3 border-b border-gray-200">
            <img src="{{ asset('images/logo-ji.svg') }}" alt="Jagoan Indonesia" class="h-8 w-auto" />
            <div class="leading-tight">
                <div class="text-sm font-semibold">JAGOAN INDONESIA</div>
                <div class="text-[11px] text-gray-500">DASHBOARD</div>
            </div>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">
            <div class="px-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Overview</div>

            @if($user?->canAccessRouteName('admin.dashboard'))
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">D</span>
                    <span>Dashboard</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.activities.index'))
                <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.activities.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">A</span>
                    <span>Activities</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('clients.index'))
                <a href="{{ route('clients.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('clients.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">C</span>
                    <span>Clients</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('universities.index'))
                <a href="{{ route('universities.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('universities.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">U</span>
                    <span>Universities</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('team-members.index'))
                <a href="{{ route('team-members.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('team-members.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">T</span>
                    <span>Team Members</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('client-reviews.index'))
                <a href="{{ route('client-reviews.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('client-reviews.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">R</span>
                    <span>Client Reviews</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('intern-experiences.index'))
                <a href="{{ route('intern-experiences.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('intern-experiences.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">I</span>
                    <span>Intern Experiences</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.faqs.index'))
                <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.faqs.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">F</span>
                    <span>FAQs</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.career-stats.index'))
                <a href="{{ route('admin.career-stats.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.career-stats.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">S</span>
                    <span>Career Stats</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.hero-sections.index'))
                <a href="{{ route('admin.hero-sections.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.hero-sections.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">H</span>
                    <span>Hero Sections</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.blogs.index'))
                <a href="{{ route('admin.blogs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">B</span>
                    <span>News & Blogs</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.blog-categories.index'))
                <a href="{{ route('admin.blog-categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.blog-categories.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">C</span>
                    <span>Categories</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.comments.index'))
                <a href="{{ route('admin.comments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.comments.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700 relative">
                        M
                        @if($pendingCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">{{ $pendingCount > 99 ? '99+' : $pendingCount }}</span>
                        @endif
                    </span>
                    <span>Comments</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.messages.index'))
                <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.messages.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700 relative">
                        P
                        @if($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                        @endif
                    </span>
                    <span>Messages</span>
                </a>
            @endif

            @if($user?->canAccessRouteName('admin.analytics.blogs'))
                <a href="{{ route('admin.analytics.blogs') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.analytics.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">N</span>
                    <span>Analytics</span>
                </a>
            @endif

            <div class="px-3 text-[11px] font-semibold text-gray-400 uppercase tracking-wider mt-6 mb-2">Management</div>

            @if($user?->canAccessRouteName('admin.users.index'))
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">U</span>
                    <span>Users</span>
                </a>
            @endif

            <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.pages.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <span class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center text-gray-700">P</span>
                <span>Page Access</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <div class="text-sm font-semibold truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6">
            <div class="flex items-center gap-3 w-full max-w-xl">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <input type="text" placeholder="Search anything..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-200 bg-gray-50 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.messages.index') }}" class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 bg-white text-gray-700 hover:bg-gray-50" aria-label="Messages">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 8H18M6 12H18M6 16H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20 14V6C20 4.89543 19.1046 4 18 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 min-w-5 h-5 px-1 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-semibold">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                    @endif
                </a>

                @if(request()->routeIs('admin.faqs.*'))
                    <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New FAQ</span>
                    </a>
                @elseif(request()->routeIs('admin.career-stats.*'))
                    <a href="{{ route('admin.career-stats.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New Career Stat</span>
                    </a>
                @elseif(request()->routeIs('admin.hero-sections.*'))
                    <a href="{{ route('admin.hero-sections.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New Hero Section</span>
                    </a>
                @elseif(request()->routeIs('admin.blogs.*'))
                    <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New Post</span>
                    </a>
                @elseif(request()->routeIs('admin.blog-categories.*'))
                    <a href="{{ route('admin.blog-categories.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New Category</span>
                    </a>
                @elseif(request()->routeIs('admin.users.*'))
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New User</span>
                    </a>
                @elseif(request()->routeIs('admin.pages.*'))
                    <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New Page</span>
                    </a>
                @else
                    <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span class="text-base leading-none">+</span>
                        <span>New Activity</span>
                    </a>
                @endif
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
