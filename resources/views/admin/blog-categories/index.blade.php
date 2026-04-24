@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">News Categories</h1>
            <p class="text-sm text-gray-600 mt-1">Manage news post categories.</p>
        </div>

        <a href="{{ route('admin.blog-categories.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
            <span class="text-base leading-none">+</span>
            <span>New Category</span>
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="text-left font-semibold px-6 py-3">Category</th>
                        <th class="text-left font-semibold px-6 py-3">Description</th>
                        <th class="text-left font-semibold px-6 py-3">Color</th>
                        <th class="text-left font-semibold px-6 py-3">Status</th>
                        <th class="text-left font-semibold px-6 py-3">Blog Posts</th>
                        <th class="text-left font-semibold px-6 py-3">Order</th>
                        <th class="text-right font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50/70 {{ $category->trashed() ? 'bg-red-50/30' : '' }}">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: {{ $category->color }};">
                                        <span class="text-white text-xs font-bold">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-semibold text-gray-900 truncate">{{ $category->name }}</div>
                                        <div class="text-xs text-gray-500 truncate">{{ $category->slug }}</div>
                                        @if($category->trashed())
                                            <div class="text-xs text-red-600 font-semibold">Deleted</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="max-w-xs">
                                    <p class="text-sm text-gray-700 truncate">{{ $category->description ?? 'No description' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded border border-gray-300" style="background-color: {{ $category->color }};"></div>
                                    <span class="text-xs font-mono text-gray-600">{{ $category->color }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3">
                                @if($category->is_active)
                                    <span class="inline-flex items-center rounded-full bg-emerald-50 text-emerald-700 px-2.5 py-1 text-xs font-semibold">Active</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 text-gray-700 px-2.5 py-1 text-xs font-semibold">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                <span class="inline-flex items-center rounded-full bg-blue-50 text-blue-700 px-2.5 py-1 text-xs font-semibold">
                                    {{ $category->blog_count }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $category->sort_order }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.blog-categories.show', $category) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">View</a>
                                    <a href="{{ route('admin.blog-categories.edit', $category) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    
                                    @if($category->trashed())
                                        <form method="POST" action="{{ route('admin.blog-categories.restore', $category->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 hover:bg-emerald-100">Restore</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.blog-categories.force-delete', $category->id) }}" onsubmit="return confirm('Permanently delete this category? This action cannot be undone.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete Forever</button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.blog-categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?');" class="inline">
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
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">No categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
