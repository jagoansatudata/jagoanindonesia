@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.comments.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Comments
            </a>
        </div>
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Comment Details</h1>
            <p class="text-sm text-gray-600 mt-1">View and manage comment information.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 space-y-6">
            <!-- Header Info -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Comment by {{ $comment->name }}</h2>
                    <p class="text-sm text-gray-600">Posted on {{ $comment->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <form method="POST" action="{{ route('admin.comments.toggle', $comment) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            {{ $comment->is_approved ? 'Unapprove' : 'Approve' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Delete this comment?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-semibold text-red-700 hover:bg-red-100">Delete</button>
                    </form>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full {{ $comment->is_approved ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-700' }} px-2.5 py-1 text-xs font-semibold">
                    {{ $comment->is_approved ? 'Approved' : 'Pending' }}
                </span>
                @if($comment->parent_id)
                    <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 px-2.5 py-1 text-xs font-semibold">
                        Reply
                    </span>
                @endif
            </div>

            <!-- Comment Content -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Comment</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $comment->body }}</p>
                </div>
            </div>

            <!-- Author Information -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Name</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $comment->name }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Email</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $comment->email }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Status</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $comment->is_approved ? 'Approved' : 'Pending' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Approved Date</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $comment->approved_at?->format('M d, Y H:i') ?? 'Not approved' }}</p>
                </div>
            </div>

            <!-- News Information -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">News Post</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $comment->blog?->title ?? 'News not found' }}</p>
                            @if($comment->blog)
                                <p class="text-xs text-gray-500 mt-1">By {{ $comment->blog->author }} on {{ $comment->blog->formatted_date }}</p>
                            @endif
                        </div>
                        @if($comment->blog)
                            <a href="{{ route('news.show', $comment->blog->slug) }}" target="_blank" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                View Post
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Parent Comment (if reply) -->
            @if($comment->parent)
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Reply To</h3>
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-semibold text-gray-900">{{ $comment->parent->name }}</p>
                            <p class="text-xs text-gray-500">{{ $comment->parent->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $comment->parent->body }}</p>
                    </div>
                </div>
            @endif

            <!-- Reply Form -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Reply to Comment</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <form method="POST" action="{{ route('news.comments.store', $comment->blog->slug) }}" class="space-y-3">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <div>
                            <textarea 
                                name="body" 
                                rows="4" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300 resize-none" 
                                placeholder="Write a reply as admin..."
                                required
                            ></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ auth()->user()->name }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                                placeholder="Your name"
                                required
                            />
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ auth()->user()->email }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                                placeholder="Your email"
                                required
                            />
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-800">
                                Post Reply as Admin
                            </button>
                            <a href="{{ route('admin.comments.show', $comment) }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Replies -->
            @if($comment->approvedReplies->isNotEmpty())
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Replies ({{ $comment->approvedReplies->count() }})</h3>
                    <div class="space-y-3">
                        @foreach($comment->approvedReplies as $reply)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <p class="text-sm font-semibold text-gray-900">{{ $reply->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $reply->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $reply->body }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- SEO Information -->
            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">System Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Comment ID</p>
                        <p class="text-sm font-mono text-gray-900">#{{ $comment->id }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">IP Address</p>
                        <p class="text-sm font-mono text-gray-900">{{ $comment->ip_address ?? 'Not recorded' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">User Agent</p>
                        <p class="text-sm font-mono text-gray-900 truncate" title="{{ $comment->user_agent ?? 'Not recorded' }}">
                            {{ $comment->user_agent ?? 'Not recorded' }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Created</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $comment->created_at->format('M d, Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
