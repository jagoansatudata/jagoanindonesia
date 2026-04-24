@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">FAQs</h1>
            <p class="text-sm text-gray-600 mt-1">Manage Frequently Asked Questions for Career page.</p>
        </div>

        <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
            <span class="text-base leading-none">+</span>
            <span>New FAQ</span>
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left font-semibold px-6 py-3">Question</th>
                        <th class="text-left font-semibold px-6 py-3">Answer</th>
                        <th class="text-left font-semibold px-6 py-3">Published</th>
                        <th class="text-left font-semibold px-6 py-3">Order</th>
                        <th class="text-right font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="faqs-tbody">
                    @forelse($faqs as $faq)
                        <tr class="hover:bg-gray-50/70" data-id="{{ $faq->id }}">
                            <td class="px-6 py-3">
                                <div class="max-w-xs">
                                    <div class="font-semibold text-gray-900 line-clamp-2">{{ Str::limit($faq->question, 80) }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $faq->created_at?->format('M d, Y') }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="max-w-xs">
                                    <div class="text-gray-700 line-clamp-2">{{ Str::limit($faq->answer, 100) }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                @if($faq->is_published)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Yes</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                <input type="number" value="{{ $faq->sort_order }}" class="w-16 px-2 py-1 text-sm border border-gray-200 rounded" data-faq-id="{{ $faq->id }}" data-field="sort_order">
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <form method="POST" action="{{ route('admin.faqs.toggle-published', $faq) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center rounded-lg border {{ $faq->is_published ? 'border-yellow-200 bg-yellow-50 text-yellow-700 hover:bg-yellow-100' : 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }} px-3 py-1.5 text-xs font-semibold">
                                            {{ $faq->is_published ? 'Unpublish' : 'Publish' }}
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('Delete this FAQ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">No FAQs yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
            <button type="button" onclick="updateOrder()" class="inline-flex items-center rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-100">
                Update Order
            </button>
            {{ $faqs->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
function updateOrder() {
    const faqs = [];
    document.querySelectorAll('#faqs-tbody tr[data-id]').forEach(row => {
        const id = row.dataset.id;
        const sortOrder = row.querySelector('input[data-field="sort_order"]').value;
        faqs.push({
            id: parseInt(id),
            sort_order: parseInt(sortOrder)
        });
    });

    fetch('{{ route("admin.faqs.reorder") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ faqs: faqs })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert('Error updating order');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating order');
    });
}
</script>
@endpush
