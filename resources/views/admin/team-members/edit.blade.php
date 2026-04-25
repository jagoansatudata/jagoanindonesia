@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('team-members.index') }}" class="text-gray-500 hover:text-gray-700">Team Members</a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li>
                    <span class="text-gray-900">Edit</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Team Member</h1>
        <p class="text-sm text-gray-600 mt-1">Update team member information.</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">
        <form action="{{ route('team-members.update', $teamMember) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                    <ul class="text-sm text-red-800 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $teamMember->name) }}" required
                           class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                    <input type="text" id="position" name="position" value="{{ old('position', $teamMember->position) }}" required
                           class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $teamMember->order) }}" min="0"
                           class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
                    <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*"
                           class="w-full rounded-xl border border-gray-300 px-3 py-2 text-sm focus:border-gray-500 focus:outline-none focus:ring-1 focus:ring-gray-500">
                    <p class="mt-1 text-xs text-gray-500">JPEG, PNG, JPG, GIF (Max 2MB). Leave empty to keep current photo.</p>
                    
                    @if ($teamMember->photo)
                        <div class="mt-3">
                            <p class="text-xs text-gray-600 mb-2">Current photo:</p>
                            <img src="{{ asset('storage/team/' . $teamMember->photo) }}" alt="{{ $teamMember->name }}" class="w-20 h-20 rounded-full object-cover border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $teamMember->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-gray-900 focus:ring-gray-500">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
                <p class="mt-1 text-xs text-gray-500">Only active team members will be displayed on the website</p>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                <a href="{{ route('team-members.index') }}" class="text-gray-600 hover:text-gray-900 text-sm">Cancel</a>
                <div class="flex items-center gap-3">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                        <span>Update Team Member</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
