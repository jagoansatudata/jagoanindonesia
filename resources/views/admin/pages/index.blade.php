@extends('layouts.admin')

@section('content')
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Page Access Management</h1>
            <p class="text-sm text-gray-600 mt-1">Toggle user access to specific pages.</p>
        </div>

        <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
            <span class="text-base leading-none">+</span>
            <span>Add Page</span>
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    @forelse($pages as $page)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm mb-4 overflow-hidden">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $page->name }}</h3>
                            <form method="POST" action="{{ route('admin.pages.toggle', $page) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors {{ $page->is_active ? 'bg-emerald-600' : 'bg-gray-200' }}">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $page->is_active ? 'translate-x-6' : 'translate-x-1' }}" />
                                </button>
                            </form>
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <code class="bg-gray-100 px-2 py-1 rounded text-xs">{{ $page->route_name }}</code>
                            @if($page->description)
                                <span>{{ $page->description }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Edit</a>
                        <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Delete this page?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-sm font-medium text-gray-700">User Access</div>
                        <div class="flex items-center gap-2">
                            <button onclick="selectAllUsers({{ $page->id }}, true)" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Select All</button>
                            <span class="text-gray-300">|</span>
                            <button onclick="selectAllUsers({{ $page->id }}, false)" class="text-xs text-gray-600 hover:text-gray-700 font-medium">Clear All</button>
                            <span class="text-gray-300">|</span>
                            <button onclick="bulkGrantAccess({{ $page->id }})" class="text-xs text-emerald-600 hover:text-emerald-700 font-medium">Grant Selected</button>
                            <button onclick="bulkRevokeAccess({{ $page->id }})" class="text-xs text-red-600 hover:text-red-700 font-medium">Revoke Selected</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @php
                            $allUsers = \App\Models\User::orderBy('name')->get();
                        @endphp
                        @foreach($allUsers as $user)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" class="user-checkbox w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                           data-page-id="{{ $page->id }}" data-user-id="{{ $user->id }}"
                                           {{ $user->hasFullAccess() ? 'disabled' : '' }}>
                                    <div class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center text-xs font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                    </div>
                                    <span class="inline-flex items-center rounded-full bg-{{ $user->getRoleColor() }}-50 text-{{ $user->getRoleColor() }}-700 px-1.5 py-0.5 text-xs font-semibold">
                                        {{ $user->getRoleDisplayName() }}
                                    </span>
                                </div>
                                <form method="POST" action="{{ route('admin.pages.toggle-user', [$page, $user]) }}" class="toggle-access-form" data-user-id="{{ $user->id }}" data-page-id="{{ $page->id }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="relative inline-flex h-5 w-9 items-center rounded-full transition-colors {{ $page->users()->where('user_id', $user->id)->exists() ? 'bg-blue-600' : 'bg-gray-200' }}" 
                                            {{ $user->hasFullAccess() ? 'disabled title="' . $user->getRoleDisplayName() . ' users have access to all pages"' : '' }}>
                                        <span class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform {{ $page->users()->where('user_id', $user->id)->exists() ? 'translate-x-5' : 'translate-x-1' }}" />
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-12 text-center">
            <div class="text-gray-500 mb-4">No pages configured yet.</div>
            <a href="{{ route('admin.pages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-gray-900 text-white px-4 py-2 text-sm font-semibold hover:bg-gray-800">
                <span class="text-base leading-none">+</span>
                <span>Add Your First Page</span>
            </a>
        </div>
    @endforelse

    <div class="mt-6">
        {{ $pages->links() }}
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle toggle forms with AJAX
        const toggleForms = document.querySelectorAll('.toggle-access-form');
        
        toggleForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                const originalHtml = submitButton.innerHTML;
                
                // Show loading state
                submitButton.disabled = true;
                submitButton.classList.add('opacity-50');
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': formData.get('_token')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update toggle state
                        const isActive = data.hasAccess;
                        submitButton.classList.toggle('bg-blue-600', isActive);
                        submitButton.classList.toggle('bg-gray-200', !isActive);
                        
                        const span = submitButton.querySelector('span');
                        span.classList.toggle('translate-x-5', isActive);
                        span.classList.toggle('translate-x-1', !isActive);
                        
                        // Show success message
                        showToast(data.message, 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Error updating access', 'error');
                })
                .finally(() => {
                    // Restore button state
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50');
                });
            });
        });
        
        // Simple toast notification
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed bottom-4 right-4 px-4 py-3 rounded-lg text-sm font-medium z-50 transition-all transform translate-y-full opacity-0 ${
                type === 'success' ? 'bg-emerald-600 text-white' : 'bg-red-600 text-white'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-y-full', 'opacity-0');
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-y-full', 'opacity-0');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }
    });
    
    // Bulk action functions
    function selectAllUsers(pageId, select) {
        const checkboxes = document.querySelectorAll(`.user-checkbox[data-page-id="${pageId}"]:not(:disabled)`);
        checkboxes.forEach(checkbox => {
            checkbox.checked = select;
        });
    }
    
    function getSelectedUserIds(pageId) {
        const checkboxes = document.querySelectorAll(`.user-checkbox[data-page-id="${pageId}"]:checked:not(:disabled)`);
        return Array.from(checkboxes).map(cb => cb.dataset.userId);
    }
    
    function bulkGrantAccess(pageId) {
        const userIds = getSelectedUserIds(pageId);
        if (userIds.length === 0) {
            showToast('Please select users to grant access', 'error');
            return;
        }
        
        performBulkAction(pageId, userIds, 'grant');
    }
    
    function bulkRevokeAccess(pageId) {
        const userIds = getSelectedUserIds(pageId);
        if (userIds.length === 0) {
            showToast('Please select users to revoke access', 'error');
            return;
        }
        
        performBulkAction(pageId, userIds, 'revoke');
    }
    
    function performBulkAction(pageId, userIds, action) {
        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        formData.append('_method', 'PATCH');
        formData.append('action', action);
        userIds.forEach(id => formData.append('user_ids[]', id));
        
        fetch(`/admin/pages/${pageId}/bulk-toggle`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                // Refresh the page to update toggle states
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Error performing bulk action', 'error');
        });
    }
    </script>
@endsection
