<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogView;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class BlogController extends Controller
{
    /**
     * Display all blog posts.
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'View All');

        $query = Blog::published()->blogs();

        if ($category !== 'View All') {
            $query->byCategory($category);
        }

        $blogs = $query->latest('published_at')->paginate(9);

        $news = $blogs->map(function ($blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'author' => $blog->author,
                'comments' => $blog->comments_count,
                'date' => $blog->formatted_date,
                'image' => $blog->image_url ?: asset('images/hero/hero-1.jpg'),
                'category' => $blog->category,
                'slug' => $blog->slug,
                'excerpt' => $blog->excerpt,
            ];
        });

        $dbCategories = BlogCategory::active()->ordered()->get();
        $categories = collect(['View All'])->merge($dbCategories->pluck('name'));

        $pageTitle = 'Blog';
        $showRouteName = 'blog.show';

        return view('pages.news', compact('news', 'categories', 'blogs', 'pageTitle', 'showRouteName'));
    }

    /**
     * Display a single blog post.
     */
    public function show($slug)
    {
        $news = Blog::published()
            ->blogs()
            ->where('slug', $slug)
            ->firstOrFail();

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

        $relatedPosts = Blog::published()
            ->blogs()
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = BlogCategory::withCount(['blogs' => function ($query) {
            $query->published();
        }])->active()->ordered()->get();

        $topPosts = Blog::published()
            ->blogs()
            ->featured()
            ->latest('published_at')
            ->take(5)
            ->get();

        $pageTitle = 'Blog';
        $breadcrumb = 'Beranda / Blog';
        $indexRouteName = 'blog';
        $showRouteName = 'blog.show';
        $commentStoreRouteName = 'blog.comments.store';

        return view('pages.news-detail', compact(
            'news',
            'relatedPosts',
            'categories',
            'topPosts',
            'comments',
            'pageTitle',
            'breadcrumb',
            'indexRouteName',
            'showRouteName',
            'commentStoreRouteName'
        ));
    }

    public function storeComment(Request $request, $slug)
    {
        if (!Schema::hasTable('comments')) {
            return redirect()->route('blog.show', $slug)->with('success', 'Comments feature is not available yet. Please run migrations.');
        }

        $news = Blog::published()->blogs()->where('slug', $slug)->firstOrFail();

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

        return redirect()->route('blog.show', $news->slug)->with('success', 'Comment submitted and awaiting approval.');
    }
}
