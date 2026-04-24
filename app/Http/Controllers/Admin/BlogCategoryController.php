<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::withTrashed()->ordered()->paginate(10);
        return view('admin.blog-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        if (BlogCategory::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }

        BlogCategory::create($validated);

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        return view('admin.blog-categories.show', compact('blogCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog-categories.edit', compact('blogCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'color' => 'required|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        
        if ($validated['slug'] !== $blogCategory->slug && BlogCategory::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }

        $blogCategory->update($validated);

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $blogCategory)
    {
        // Check if category has blogs
        if ($blogCategory->blogs()->count() > 0) {
            return redirect()->route('admin.blog-categories.index')
                ->with('error', 'Cannot delete category with associated blog posts.');
        }
        
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category deleted successfully.');
    }

    public function restore($id)
    {
        $blogCategory = BlogCategory::withTrashed()->findOrFail($id);
        $blogCategory->restore();
        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category restored successfully.');
    }

    public function forceDelete($id)
    {
        $blogCategory = BlogCategory::withTrashed()->findOrFail($id);
        
        if ($blogCategory->blogs()->count() > 0) {
            return redirect()->route('admin.blog-categories.index')
                ->with('error', 'Cannot permanently delete category with associated blog posts.');
        }
        
        $blogCategory->forceDelete();
        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Blog category permanently deleted.');
    }
}
