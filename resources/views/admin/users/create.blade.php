@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
            <a href="{{ route('admin.users.index') }}" class="hover:text-gray-900">Users</a>
            <span>/</span>
            <span class="text-gray-900">Create User</span>
        </div>
        <h1 class="text-2xl font-semibold text-gray-900">Create New User</h1>
        <p class="text-sm text-gray-600 mt-1">Add a new user to the application.</p>
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
        <form method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                        placeholder="Enter user name"
                        required
                    >
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                        placeholder="user@example.com"
                        required
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                        placeholder="Enter password"
                        required
                    >
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">Confirm Password</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300" 
                        placeholder="Confirm password"
                        required
                    >
                </div>
            </div>

            <div>
                <label for="role" class="block text-sm font-semibold text-gray-900 mb-2">Role</label>
                <select 
                    id="role" 
                    name="role" 
                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900/10 focus:border-gray-300"
                    required
                >
                    @foreach(\App\Enums\UserRole::getSelectOptions() as $value => $label)
                        <option value="{{ $value }}" {{ old('role', \App\Enums\UserRole::USER->value) === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">
                    @php
                        $currentUser = auth()->user();
                        $assignableRoles = $currentUser ? $currentUser->getAssignableRoles() : [];
                    @endphp
                    @if(empty($assignableRoles))
                        You cannot assign roles to other users.
                    @else
                        You can assign: {{ implode(', ', $assignableRoles) }}
                    @endif
                </p>
            </div>

            
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                    Create User
                </button>
            </div>
        </form>
    </div>
@endsection
