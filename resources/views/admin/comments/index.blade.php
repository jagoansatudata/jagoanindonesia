@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Comments</h1>
            <p class="text-sm text-gray-600 mt-1">Moderate news comments.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">News</label>
                <select name="blog_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300">
                    <option value="">All News</option>
                    @foreach(\App\Models\Blog::pluck('title', 'id') as $id => $title)
                        <option value="{{ $id }}" {{ request('blog_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-800">Filter</button>
            <a href="{{ route('admin.comments.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">Reset</a>
        </form>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <!-- Batch Actions -->
        <div class="px-6 py-3 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600">With selected:</span>
                <form method="POST" action="{{ route('admin.comments.batch') }}" class="inline-flex gap-2">
                    @csrf
                    <input type="hidden" name="action" id="batchAction">
                    <input type="hidden" name="ids" id="batchIds">
                    <button type="button" onclick="submitBatch('approve')" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-medium hover:bg-emerald-100">Approve</button>
                    <button type="button" onclick="submitBatch('unapprove')" class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-100">Unapprove</button>
                    <button type="button" onclick="submitBatch('delete')" class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-medium hover:bg-red-100">Delete</button>
                </form>
            </div>
            <div class="text-sm text-gray-600">
                {{ $comments->total() }} comment{{ $comments->total() != 1 ? 's' : '' }}
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                        </th>
                        <th class="text-left font-semibold px-6 py-3">News</th>
                        <th class="text-left font-semibold px-6 py-3">Name</th>
                        <th class="text-left font-semibold px-6 py-3">Email</th>
                        <th class="text-left font-semibold px-6 py-3">Comment</th>
                        <th class="text-left font-semibold px-6 py-3">Status</th>
                        <th class="text-left font-semibold px-6 py-3">Created</th>
                        <th class="text-right font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($comments as $comment)
                        <tr class="hover:bg-gray-50/70">
                            <td class="px-6 py-3">
                                <input type="checkbox" name="selected[]" value="{{ $comment->id }}" class="row-checkbox rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                            </td>
                            <td class="px-6 py-3">
                                <div class="font-semibold text-gray-900">{{ $comment->blog?->title ?? '-' }}</div>
                                @if($comment->parent_id)
                                    <div class="text-xs text-gray-500">Reply</div>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $comment->name }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $comment->email }}</td>
                            <td class="px-6 py-3 text-gray-700">
                                <div class="max-w-xl truncate">{{ $comment->body }}</div>
                            </td>
                            <td class="px-6 py-3">
                                @if($comment->is_approved)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Approved</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $comment->created_at?->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.comments.show', $comment) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">View</a>
                                    <form method="POST" action="{{ route('admin.comments.toggle', $comment) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                            {{ $comment->is_approved ? 'Unapprove' : 'Approve' }}
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" onsubmit="return confirm('Delete this comment?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">No comments yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $comments->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.row-checkbox');

            selectAll?.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });

            // Update select all when individual checkboxes change
            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const allChecked = Array.from(checkboxes).every(c => c.checked);
                    const anyChecked = Array.from(checkboxes).some(c => c.checked);
                    selectAll.checked = allChecked;
                    selectAll.indeterminate = anyChecked && !allChecked;
                });
            });
        });

        function submitBatch(action) {
            const checkboxes = document.querySelectorAll('.row-checkbox:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one comment.');
                return;
            }

            if (action === 'delete' && !confirm('Delete selected comments? This action cannot be undone.')) {
                return;
            }

            const ids = Array.from(checkboxes).map(cb => cb.value);
            document.getElementById('batchAction').value = action;
            document.getElementById('batchIds').value = ids.join(',');
            document.forms[1].submit();
        }
    </script>
@endsection
