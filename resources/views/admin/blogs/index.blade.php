@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">News & Blogs</h1>
            <p class="text-sm text-gray-600 mt-1">Manage news posts and blogs for the website.</p>
        </div>

        <div class="flex items-center gap-3">
            <!-- Type Filter -->
            <div class="relative">
                <select id="type-filter" class="appearance-none rounded-lg border border-gray-300 bg-white pl-10 pr-10 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" onchange="window.location.href='{{ route('admin.blogs.index') }}?type='+this.value">
                    <option value="all" {{ $type === 'all' ? 'selected' : '' }}>All Types</option>
                    <option value="news" {{ $type === 'news' ? 'selected' : '' }}>News</option>
                    <option value="blog" {{ $type === 'blog' ? 'selected' : '' }}>Blogs</option>
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                </div>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                <span class="text-base leading-none">+</span>
                <span>New Post</span>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bulk Actions Bar -->
    <div id="bulk-actions" class="hidden mb-4 bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-blue-900">
                    <span id="selected-count">0</span> items selected
                </span>
                <button onclick="clearSelection()" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Clear selection</button>
            </div>
            <div class="flex items-center gap-2">
                <form id="bulk-delete-form" method="POST" action="{{ route('admin.blogs.bulk-delete') }}" class="hidden" onsubmit="return confirm('Delete selected blog posts? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="ids" id="bulk-delete-ids">
                    <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete Selected</button>
                </form>
                <form id="bulk-force-delete-form" method="POST" action="{{ route('admin.blogs.bulk-force-delete') }}" class="hidden" onsubmit="return confirm('Permanently delete selected blog posts? This action cannot be undone and will remove all associated images.');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="ids" id="bulk-force-delete-ids">
                    <button type="submit" class="inline-flex items-center rounded-lg border border-red-300 bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-800 hover:bg-red-200">Delete Forever</button>
                </form>
                <form id="bulk-restore-form" method="POST" action="{{ route('admin.blogs.bulk-restore') }}" class="hidden">
                    @csrf
                    <input type="hidden" name="ids" id="bulk-restore-ids">
                    <button type="submit" class="inline-flex items-center rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-100">Restore Selected</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="w-12 px-6 py-3">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="text-left font-semibold px-6 py-3">Title</th>
                        <th class="text-left font-semibold px-6 py-3">Author</th>
                        <th class="text-left font-semibold px-6 py-3">Type</th>
                        <th class="text-left font-semibold px-6 py-3">Category</th>
                        <th class="text-left font-semibold px-6 py-3">Status</th>
                        <th class="text-left font-semibold px-6 py-3">Featured</th>
                        <th class="text-left font-semibold px-6 py-3">Published</th>
                        <th class="text-right font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($blogs as $blog)
                        <tr class="hover:bg-gray-50/70 {{ $blog->trashed() ? 'bg-red-50/30' : '' }}">
                            <td class="px-6 py-3">
                                <input type="checkbox" class="blog-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="{{ $blog->id }}" data-status="{{ $blog->trashed() ? 'deleted' : 'active' }}">
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                        @if($blog->image)
                                            <img src="{{ asset($blog->image) }}" alt="" class="w-full h-full object-cover" />
                                        @else
                                            <span class="text-xs font-semibold text-gray-500">IMG</span>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-semibold text-gray-900 truncate">{{ $blog->title }}</div>
                                        <div class="text-xs text-gray-500 truncate">{{ $blog->created_at?->format('M d, Y') }}</div>
                                        @if($blog->trashed())
                                            <div class="text-xs text-red-600 font-semibold">Deleted</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $blog->author }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-flex items-center rounded-full {{ $blog->type === 'news' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700' }} px-2.5 py-1 text-xs font-semibold">
                                    {{ ucfirst($blog->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 px-2.5 py-1 text-xs font-semibold">
                                    {{ $blog->category }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                @if($blog->status === 'published')
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Published</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                @if($blog->featured)
                                    <span class="inline-flex items-center rounded-full bg-yellow-50 text-yellow-700 px-2.5 py-1 text-xs font-semibold">Yes</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $blog->published_at?->format('M d, Y') ?? 'Not published' }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.blogs.show', $blog) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">View</a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    
                                    @if($blog->trashed())
                                        <form method="POST" action="{{ route('admin.blogs.restore', $blog->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-100">Restore</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.blogs.force-delete', $blog->id) }}" onsubmit="return confirm('Permanently delete this blog post? This action cannot be undone.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete Forever</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" onsubmit="return confirm('Delete this blog post?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-10 text-center text-gray-500">No posts yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $blogs->links() }}
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const blogCheckboxes = document.querySelectorAll('.blog-checkbox');
    const bulkActions = document.getElementById('bulk-actions');
    const selectedCount = document.getElementById('selected-count');
    const bulkDeleteIds = document.getElementById('bulk-delete-ids');
    const bulkForceDeleteIds = document.getElementById('bulk-force-delete-ids');
    const bulkRestoreIds = document.getElementById('bulk-restore-ids');
    const bulkDeleteForm = document.getElementById('bulk-delete-form');
    const bulkForceDeleteForm = document.getElementById('bulk-force-delete-form');
    const bulkRestoreForm = document.getElementById('bulk-restore-form');

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        blogCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });

    // Individual checkbox functionality
    blogCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectAllCheckbox();
            updateBulkActions();
        });
    });

    function updateSelectAllCheckbox() {
        const checkedBoxes = document.querySelectorAll('.blog-checkbox:checked');
        const totalBoxes = document.querySelectorAll('.blog-checkbox');
        selectAllCheckbox.checked = checkedBoxes.length === totalBoxes.length && totalBoxes.length > 0;
        selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < totalBoxes.length;
    }

    function updateBulkActions() {
        const checkedBoxes = document.querySelectorAll('.blog-checkbox:checked');
        const count = checkedBoxes.length;
        
        // Show/hide bulk actions bar
        if (count > 0) {
            bulkActions.classList.remove('hidden');
            selectedCount.textContent = count;
            
            // Get selected IDs
            const selectedIds = Array.from(checkedBoxes).map(cb => cb.value);
            bulkDeleteIds.value = selectedIds.join(',');
            bulkForceDeleteIds.value = selectedIds.join(',');
            bulkRestoreIds.value = selectedIds.join(',');
            
            // Check if any selected items are deleted
            const hasDeleted = Array.from(checkedBoxes).some(cb => cb.dataset.status === 'deleted');
            const hasActive = Array.from(checkedBoxes).some(cb => cb.dataset.status === 'active');
            
            // Show/hide appropriate bulk actions
            if (hasActive) {
                bulkDeleteForm.classList.remove('hidden');
                bulkDeleteForm.classList.add('inline');
            } else {
                bulkDeleteForm.classList.add('hidden');
                bulkDeleteForm.classList.remove('inline');
            }
            
            // Always show bulk force delete (works for both active and deleted items)
            bulkForceDeleteForm.classList.remove('hidden');
            bulkForceDeleteForm.classList.add('inline');
            
            if (hasDeleted) {
                bulkRestoreForm.classList.remove('hidden');
                bulkRestoreForm.classList.add('inline');
            } else {
                bulkRestoreForm.classList.add('hidden');
                bulkRestoreForm.classList.remove('inline');
            }
        } else {
            bulkActions.classList.add('hidden');
        }
    }

    window.clearSelection = function() {
        selectAllCheckbox.checked = false;
        blogCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        updateBulkActions();
    };
});
</script>
@endsection
