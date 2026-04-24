<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogView;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class NewsController extends Controller
{
    /**
     * Display all blog posts.
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'View All');
        
        $query = Blog::published();
        
        if ($category === 'news') {
            $query->news();
        } elseif ($category === 'blog') {
            $query->blogs();
        } elseif ($category !== 'View All') {
            $query->byCategory($category);
        }
        
        $blogs = $query->latest('published_at')->paginate(9);
        
        // Transform blog data to match the expected format for the view
        $news = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'author' => $blog->author,
                'comments' => $blog->comments_count, // Uses accessor that returns approved comments count
                'date' => $blog->formatted_date,
                'image' => $blog->image ?: '/images/hero/hero-1.jpg',
                'category' => $blog->category,
                'slug' => $blog->slug,
                'excerpt' => $blog->excerpt,
            ];
        });

        // Get all active categories for filtering
        $dbCategories = BlogCategory::active()->ordered()->get();
        $categories = collect(['View All'])->merge($dbCategories->pluck('name'));

        return view('pages.news', compact('news', 'categories', 'blogs'));
    }
    
    /**
     * Display a single blog post.
     */
    public function show($slug)
    {
        $news = Blog::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Track the view
        BlogView::trackView($news->id, request());

        $comments = collect();

        if (Schema::hasTable('comments')) {
            $comments = Comment::query()
                ->where('blog_id', $news->id)
                ->whereNull('parent_id')
                ->where('is_approved', true)
                ->with(['approvedReplies' => function ($query) {
                    $query->latest();
                }])
                ->latest()
                ->get();
        }
        
        // Get related posts from the same category
        $relatedPosts = Blog::published()
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(3)
            ->get();
            
        // Get categories with post counts for sidebar
        $categories = BlogCategory::withCount(['blogs' => function($query) {
            $query->published();
        }])->active()->ordered()->get();
            
        // Get top posts for sidebar
        $topPosts = Blog::published()
            ->featured()
            ->latest('published_at')
            ->take(5)
            ->get();
            
        return view('pages.news-detail', compact('news', 'relatedPosts', 'categories', 'topPosts', 'comments'));
    }

    public function storeComment(Request $request, $slug)
    {
        if (!Schema::hasTable('comments')) {
            return redirect()->route('news.show', $slug)->with('success', 'Comments feature is not available yet. Please run migrations.');
        }

        $news = Blog::published()->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'body' => 'required|string|min:3|max:2000',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'parent_id' => 'nullable|integer|exists:comments,id',
        ]);

        if (!empty($validated['parent_id'])) {
            $parent = Comment::query()
                ->where('blog_id', $news->id)
                ->where('id', $validated['parent_id'])
                ->firstOrFail();
            $validated['parent_id'] = $parent->id;
        }

        Comment::create([
            'blog_id' => $news->id,
            'parent_id' => $validated['parent_id'] ?? null,
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'body' => $validated['body'],
            'is_approved' => false,
        ]);

        return redirect()->route('news.show', $news->slug)->with('success', 'Comment submitted and awaiting approval.');
    }
}
