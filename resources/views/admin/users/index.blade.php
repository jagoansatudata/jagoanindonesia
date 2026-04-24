@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Users</h1>
            <p class="text-sm text-gray-600 mt-1">Manage application users and their permissions.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
            <span class="text-base leading-none">+</span>
            <span>New User</span>
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
                        <th class="text-left font-semibold px-6 py-3">Name</th>
                        <th class="text-left font-semibold px-6 py-3">Email</th>
                        <th class="text-left font-semibold px-6 py-3">Role</th>
                        <th class="text-left font-semibold px-6 py-3">Created</th>
                        <th class="text-right font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/70">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-gray-900 text-white flex items-center justify-center text-sm font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-semibold text-gray-900 truncate">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 truncate">{{ $user->created_at?->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $user->email }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-flex items-center rounded-full bg-{{ $user->getRoleColor() }}-50 text-{{ $user->getRoleColor() }}-700 px-2.5 py-1 text-xs font-semibold">
                                    {{ $user->getRoleDisplayName() }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ optional($user->created_at)->format('M d, Y') }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                                    @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user? This action cannot be undone.');">
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
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">No users yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>
@endsection
