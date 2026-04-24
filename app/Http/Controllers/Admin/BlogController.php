<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    /**
     * Process CKEditor content and extract base64 images
     */
    private function processContentImages($content)
    {
        // Find all base64 encoded images in the content
        preg_match_all('/<img[^>]+src="data:image\/[^;]+;base64,([^"]+)"/', $content, $matches);
        
        if (empty($matches[1])) {
            return $content;
        }
        
        $processedContent = $content;
        
        foreach ($matches[1] as $index => $base64Data) {
            // Decode base64 data
            $imageData = base64_decode($base64Data);
            
            // Get image info
            $finfo = finfo_open();
            finfo_buffer($finfo, $imageData, FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo);
            finfo_close($finfo);
            
            // Generate unique filename
            $extension = str_replace('image/', '', $mimeType);
            $filename = 'blog_' . time() . '_' . $index . '.' . $extension;
            
            // Save image to storage
            $path = 'images/blog/' . $filename;
            file_put_contents(public_path($path), $imageData);
            
            // Replace base64 image with file path in content
            $oldImageTag = $matches[0][$index];
            $newImageTag = str_replace('src="data:image/' . $mimeType . ';base64,' . $base64Data, 'src="' . asset($path) . '"', $oldImageTag);
            $processedContent = str_replace($oldImageTag, $newImageTag, $processedContent);
        }
        
        return $processedContent;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
        
        $query = Blog::withTrashed()->latest();
        
        if ($type !== 'all') {
            $query->byType($type);
        }
        
        $blogs = $query->paginate(10);
        
        return view('admin.blogs.index', compact('blogs', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);
        
        if (Blog::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }
        
        // Process CKEditor content to extract and save base64 images
        $validated['content'] = $this->processContentImages($validated['content']);

        // Set category field for backward compatibility
        if (isset($validated['category_id'])) {
            $category = \App\Models\BlogCategory::find($validated['category_id']);
            $validated['category'] = $category ? $category->name : null;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images/blog', $imageName, 'public');
            $validated['image'] = 'storage/images/blog/' . $imageName;
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = $validated['published_at'] ?? now();
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($validated['slug'] !== $blog->slug && Blog::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }
        
        // Process CKEditor content to extract and save base64 images
        $validated['content'] = $this->processContentImages($validated['content']);

        // Set category field for backward compatibility
        if (isset($validated['category_id'])) {
            $category = \App\Models\BlogCategory::find($validated['category_id']);
            $validated['category'] = $category ? $category->name : null;
        }

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images/blog', $imageName, 'public');
            $validated['image'] = 'storage/images/blog/' . $imageName;
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = $validated['published_at'] ?? now();
        } elseif ($validated['status'] === 'draft') {
            $validated['published_at'] = null;
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post restored successfully.');
    }

    public function forceDelete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        
        $blog->forceDelete();
        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post permanently deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = explode(',', $request->ids);
        $blogs = Blog::whereIn('id', $ids)->get();
        
        $deletedCount = 0;
        foreach ($blogs as $blog) {
            $blog->delete();
            $deletedCount++;
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', "{$deletedCount} blog posts deleted successfully.");
    }

    public function bulkRestore(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = explode(',', $request->ids);
        $blogs = Blog::withTrashed()->whereIn('id', $ids)->get();
        
        $restoredCount = 0;
        foreach ($blogs as $blog) {
            $blog->restore();
            $restoredCount++;
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', "{$restoredCount} blog posts restored successfully.");
    }

    public function bulkForceDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = explode(',', $request->ids);
        $blogs = Blog::withTrashed()->whereIn('id', $ids)->get();
        
        $deletedCount = 0;
        foreach ($blogs as $blog) {
            // Delete associated image file if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            
            $blog->forceDelete();
            $deletedCount++;
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', "{$deletedCount} blog posts permanently deleted.");
    }
}
