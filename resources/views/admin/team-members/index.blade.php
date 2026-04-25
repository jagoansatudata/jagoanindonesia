@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Team Members</h1>
            <p class="text-sm text-gray-600 mt-1">Manage team members shown on the Home page.</p>
        </div>

        <a href="{{ route('team-members.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
            <span class="text-base leading-none">+</span>
            <span>New Team Member</span>
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
                        <th class="text-left font-semibold px-6 py-3">Photo</th>
                        <th class="text-left font-semibold px-6 py-3">Name</th>
                        <th class="text-left font-semibold px-6 py-3">Position</th>
                        <th class="text-left font-semibold px-6 py-3">Order</th>
                        <th class="text-left font-semibold px-6 py-3">Status</th>
                        <th class="text-left font-semibold px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($teamMembers as $teamMember)
                        <tr>
                            <td class="px-6 py-4">
                                @if ($teamMember->photo)
                                    <img src="{{ asset('storage/team/' . $teamMember->photo) }}" alt="{{ $teamMember->name }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500 text-xs">{{ substr($teamMember->name, 0, 2) }}</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $teamMember->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $teamMember->position }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $teamMember->order }}</td>
                            <td class="px-6 py-4">
                                @if ($teamMember->is_active)
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-2 py-1 text-xs font-medium text-emerald-800">Active</span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-1 text-xs font-medium text-gray-800">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('team-members.edit', $teamMember) }}" class="text-gray-600 hover:text-gray-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('team-members.destroy', $teamMember) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team member?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                No team members found. <a href="{{ route('team-members.create') }}" class="text-gray-900 underline">Create your first team member</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
