@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">New Activity</h1>
                <p class="text-sm text-gray-600 mt-1">Create a new activity for the Home page.</p>
            </div>
            <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Back</a>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6">
        <form method="POST" action="{{ route('admin.activities.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                <input name="title" value="{{ old('title') }}" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/10" required />
                @error('title')
                    <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Slug (optional)</label>
                    <input name="slug" value="{{ old('slug') }}" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/10" placeholder="auto-from-title" />
                    @error('slug')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                    <input name="category" value="{{ old('category') }}" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/10" placeholder="Workshop / Inkubasi Bisnis" />
                    @error('category')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm" />
                    <div class="mt-1 text-xs text-gray-500">PNG/JPG/WebP up to 2MB.</div>
                    @error('image')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900/10" />
                        @error('sort_order')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex items-end">
                        <label class="inline-flex items-center gap-2 text-sm font-semibold text-gray-700">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="rounded border-gray-300" />
                            Published
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-2 flex items-center justify-end gap-3">
                <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">Save</button>
            </div>
        </form>
    </div>
@endsection
