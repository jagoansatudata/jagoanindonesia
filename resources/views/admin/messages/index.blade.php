@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Messages</h1>
            <p class="text-sm text-gray-600 mt-1">Pesan dari form kontak.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Name, email, phone, message..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" />
            </div>
            <div class="flex-1 min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300">
                    <option value="">All</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-800">Filter</button>
            <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50">Reset</a>
        </form>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-3 border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-600">With selected:</span>
                <form method="POST" action="{{ route('admin.messages.batch') }}" class="inline-flex gap-2">
                    @csrf
                    <input type="hidden" name="action" id="batchAction">
                    <input type="hidden" name="ids" id="batchIds">
                    <button type="button" onclick="submitBatch('read')" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-medium hover:bg-emerald-100">Mark Read</button>
                    <button type="button" onclick="submitBatch('unread')" class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg text-xs font-medium hover:bg-gray-100">Mark Unread</button>
                    <button type="button" onclick="submitBatch('delete')" class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-medium hover:bg-red-100">Delete</button>
                </form>
            </div>
            <div class="text-sm text-gray-600">
                {{ $messages->total() }} message{{ $messages->total() != 1 ? 's' : '' }}
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                        </th>
                        <th class="text-left font-semibold px-6 py-3">Name</th>
                        <th class="text-left font-semibold px-6 py-3">Email</th>
                        <th class="text-left font-semibold px-6 py-3">Phone</th>
                        <th class="text-left font-semibold px-6 py-3">Message</th>
                        <th class="text-left font-semibold px-6 py-3">Status</th>
                        <th class="text-left font-semibold px-6 py-3">Created</th>
                        <th class="text-right font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-50/70">
                            <td class="px-6 py-3">
                                <input type="checkbox" name="selected[]" value="{{ $message->id }}" class="row-checkbox rounded border-gray-300 text-gray-900 focus:ring-gray-900">
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $message->name }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $message->email }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $message->phone ?? '-' }}</td>
                            <td class="px-6 py-3 text-gray-700">
                                <div class="max-w-xl truncate">{{ $message->message }}</div>
                            </td>
                            <td class="px-6 py-3">
                                @if($message->is_read)
                                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">Read</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Unread</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $message->created_at?->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.messages.show', $message) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">View</a>
                                    <form method="POST" action="{{ route('admin.messages.toggle', $message) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                            {{ $message->is_read ? 'Mark Unread' : 'Mark Read' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-500">No messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $messages->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.row-checkbox');

            selectAll?.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });

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
                alert('Please select at least one message.');
                return;
            }

            if (action === 'delete' && !confirm('Delete selected messages? This action cannot be undone.')) {
                return;
            }

            const ids = Array.from(checkboxes).map(cb => cb.value);
            document.getElementById('batchAction').value = action;
            document.getElementById('batchIds').value = ids.join(',');
            document.forms[1].submit();
        }
    </script>
@endsection
