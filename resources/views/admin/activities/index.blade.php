@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Activities</h1>
            <p class="text-sm text-gray-600 mt-1">Manage activities shown on the Home page.</p>
        </div>

        <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
            <span class="text-base leading-none">+</span>
            <span>New Activity</span>
        </a>
    </div>

    @if (session('status'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left font-semibold px-6 py-3">Title</th>
                        <th class="text-left font-semibold px-6 py-3">Category</th>
                        <th class="text-left font-semibold px-6 py-3">Slug</th>
                        <th class="text-left font-semibold px-6 py-3">Published</th>
                        <th class="text-left font-semibold px-6 py-3">Order</th>
                        <th class="text-right font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($activities as $activity)
                        <tr class="hover:bg-gray-50/70">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                        @if($activity->image_url)
                                            <img src="{{ $activity->image_url }}" alt="" class="w-full h-full object-cover" />
                                        @else
                                            <span class="text-xs font-semibold text-gray-500">IMG</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-semibold text-gray-900 truncate">{{ $activity->title }}</div>
                                        <div class="text-xs text-gray-500 truncate">{{ $activity->created_at?->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $activity->category }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $activity->slug }}</td>
                            <td class="px-6 py-3">
                                @if($activity->is_published)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Yes</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $activity->sort_order }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.activities.edit', $activity) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    <form method="POST" action="{{ route('admin.activities.destroy', $activity) }}" onsubmit="return confirm('Delete this activity?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">No activities yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $activities->links() }}
        </div>
    </div>
@endsection
