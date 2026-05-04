@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
            <a href="{{ route('admin.pages.index') }}" class="hover:text-gray-900">Page Access</a>
            <span>/</span>
            <span class="text-gray-900">Add Page</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900">Add New Page</h1>
        <p class="text-sm text-gray-600 mt-1">Configure page access control</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
            <ul class="text-sm text-red-800 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm">
        <form method="POST" action="{{ route('admin.pages.store') }}" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Page Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                        placeholder="Dashboard"
                        required
                    >
                </div>

                <div>
                    <label for="route_name" class="block text-sm font-semibold text-gray-900 mb-2">Route Name</label>
                    <select 
                        id="route_name" 
                        name="route_name" 
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                        required
                    >
                        <option value="" disabled {{ old('route_name') ? '' : 'selected' }}>Select a route name</option>
                        @foreach ($routeNames as $routeName)
                            <option value="{{ $routeName }}" {{ old('route_name') === $routeName ? 'selected' : '' }}>
                                {{ $routeName }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-900 mb-2">Description</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="2"
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                    placeholder="Brief description..."
                >{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-3">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1" 
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900/10"
                    >
                    <span class="text-sm font-medium text-gray-900">Active</span>
                </label>
                <span class="text-xs text-gray-500">(Page is available for access control)</span>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <a href="{{ route('admin.pages.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                    Create Page
                </button>
            </div>
        </form>
    </div>

    <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
        <div class="text-sm text-blue-800">
            <strong>Next Step:</strong> After creating the page, you can manage user access using the toggle switches on the main page.
        </div>
    </div>
@endsection
