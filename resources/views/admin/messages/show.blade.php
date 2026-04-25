@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Messages
            </a>
        </div>
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Message Details</h1>
            <p class="text-sm text-gray-600 mt-1">View and manage message information.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-6 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Message from {{ $message->name }}</h2>
                    <p class="text-sm text-gray-600">Sent on {{ $message->created_at->format('M d, Y H:i') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <form method="POST" action="{{ route('admin.messages.toggle', $message) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            {{ $message->is_read ? 'Mark Unread' : 'Mark Read' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-semibold text-red-700 hover:bg-red-100">Delete</button>
                    </form>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <span class="inline-flex items-center rounded-full {{ $message->is_read ? 'bg-gray-100 text-gray-700' : 'bg-emerald-50 text-emerald-700' }} px-2.5 py-1 text-xs font-semibold">
                    {{ $message->is_read ? 'Read' : 'Unread' }}
                </span>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">Message</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $message->message }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Name</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $message->name }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Email</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $message->email }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Phone</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $message->phone ?? '-' }}</p>
                </div>
                <div class="bg-gray-50 rounded-lg p-3">
                    <p class="text-xs text-gray-600 mb-1">Read At</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $message->read_at?->format('M d, Y H:i') ?? '-' }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-900 mb-2">System Information</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Message ID</p>
                        <p class="text-sm font-mono text-gray-900">#{{ $message->id }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">IP Address</p>
                        <p class="text-sm font-mono text-gray-900">{{ $message->ip_address ?? 'Not recorded' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">User Agent</p>
                        <p class="text-sm font-mono text-gray-900 truncate" title="{{ $message->user_agent ?? 'Not recorded' }}">
                            {{ $message->user_agent ?? 'Not recorded' }}
                        </p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-600 mb-1">Created</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $message->created_at->format('M d, Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
