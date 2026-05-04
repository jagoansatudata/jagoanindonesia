<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('users')->orderBy('name')->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $routeNames = collect(Route::getRoutes())
            ->map(fn($route) => $route->getName())
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('admin.pages.create', compact('users', 'routeNames'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'route_name' => ['required', 'string', 'max:255', 'unique:pages,route_name'],
            'is_active' => ['boolean'],
            'users' => ['array'],
            'users.*' => ['exists:users,id'],
        ]);

        $page = Page::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'route_name' => $request->route_name,
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($request->has('users')) {
            $page->users()->attach($request->users);
        }

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        $page->load('users');
        $users = User::orderBy('name')->get();
        $routeNames = collect(Route::getRoutes())
            ->map(fn($route) => $route->getName())
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('admin.pages.edit', compact('page', 'users', 'routeNames'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'route_name' => ['required', 'string', 'max:255', 'unique:pages,route_name,'.$page->id],
            'is_active' => ['boolean'],
            'users' => ['array'],
            'users.*' => ['exists:users,id'],
        ]);

        $page->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'route_name' => $request->route_name,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $page->users()->sync($request->users ?? []);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->users()->detach();
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    public function toggleStatus(Page $page)
    {
        $page->update(['is_active' => !$page->is_active]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page status updated successfully.');
    }

    public function toggleUserAccess(Request $request, Page $page, User $user)
    {
        $hasAccess = $page->users()->where('user_id', $user->id)->exists();
        
        if ($hasAccess) {
            $page->users()->detach($user->id);
            $message = 'User access removed successfully.';
        } else {
            $page->users()->attach($user->id);
            $message = 'User access granted successfully.';
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'hasAccess' => !$hasAccess
            ]);
        }

        return redirect()->route('admin.pages.index')
            ->with('success', $message);
    }

    public function bulkToggleUserAccess(Request $request, Page $page)
    {
        $request->validate([
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['exists:users,id'],
            'action' => ['required', 'in:grant,revoke']
        ]);

        $userIds = $request->user_ids;
        $action = $request->action;

        // Filter out admin users
        $nonAdminUserIds = User::whereIn('id', $userIds)->where('is_admin', false)->pluck('id');

        if ($action === 'grant') {
            $page->users()->syncWithoutDetaching($nonAdminUserIds);
            $message = 'Access granted to selected users.';
        } else {
            $page->users()->detach($nonAdminUserIds);
            $message = 'Access revoked from selected users.';
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'affected_count' => $nonAdminUserIds->count()
            ]);
        }

        return redirect()->route('admin.pages.index')
            ->with('success', $message);
    }
}
