<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogAnalyticsController extends Controller
{
    /**
     * Display the analytics dashboard.
     */
    public function index(Request $request)
    {
        $period = $request->get('period', '30'); // Default to 30 days
        $type = $request->get('type', 'all'); // all, blog, news
        
        $startDate = Carbon::now()->subDays($period);
        $endDate = Carbon::now();

        // Basic statistics
        $totalPosts = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->count();
        
        $publishedPosts = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->where('status', 'published')->count();
        
        $draftPosts = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->where('status', 'draft')->count();
        
        $featuredPosts = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->where('featured', true)->count();

        // Posts created in the period
        $postsInPeriod = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->whereBetween('created_at', [$startDate, $endDate])->count();

        // Posts published in the period
        $publishedInPeriod = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->where('status', 'published')
        ->whereBetween('published_at', [$startDate, $endDate])->count();

        // View statistics
        $totalViews = BlogView::when($type !== 'all', function ($query) use ($type) {
            return $query->whereHas('blog', function ($q) use ($type) {
                $q->where('type', $type);
            });
        })->count();

        $viewsInPeriod = BlogView::when($type !== 'all', function ($query) use ($type) {
            return $query->whereHas('blog', function ($q) use ($type) {
                $q->where('type', $type);
            });
        })->whereBetween('viewed_at', [$startDate, $endDate])->count();

        $uniqueViewsInPeriod = BlogView::when($type !== 'all', function ($query) use ($type) {
            return $query->whereHas('blog', function ($q) use ($type) {
                $q->where('type', $type);
            });
        })->distinct('ip_address')
        ->whereBetween('viewed_at', [$startDate, $endDate])
        ->count();

        // Category analytics
        $categoryAnalytics = BlogCategory::withCount(['blogs' => function ($query) use ($type) {
            $query->when($type !== 'all', function ($q) use ($type) {
                return $q->where('type', $type);
            });
        }])->withCount(['blogs as published_blogs' => function ($query) use ($type) {
            $query->when($type !== 'all', function ($q) use ($type) {
                return $q->where('type', $type);
            })->where('status', 'published');
        }])->orderBy('published_blogs', 'desc')->get();

        // Monthly posting trends (last 12 months)
        $monthlyTrends = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = "published" THEN 1 ELSE 0 END) as published'),
            DB::raw('SUM(CASE WHEN featured = 1 THEN 1 ELSE 0 END) as featured')
        )
        ->where('created_at', '>=', Carbon::now()->subYear())
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        // Most popular categories (by post count)
        $popularCategories = BlogCategory::withCount(['blogs' => function ($query) use ($type) {
            $query->when($type !== 'all', function ($q) use ($type) {
                return $q->where('type', $type);
            })->where('status', 'published');
        }])->having('blogs_count', '>', 0)
        ->orderBy('blogs_count', 'desc')
        ->limit(10)
        ->get();

        // Recent activity
        $recentPosts = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->with('category')
        ->latest()
        ->limit(5)
        ->get();

        // Author statistics
        $authorStats = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->select('author', DB::raw('COUNT(*) as total_posts'))
        ->whereNotNull('author')
        ->groupBy('author')
        ->orderBy('total_posts', 'desc')
        ->limit(10)
        ->get();

        // Most viewed posts
        $mostViewedPosts = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->withCount(['blogViews' => function ($query) use ($startDate, $endDate) {
            $query->whereBetween('viewed_at', [$startDate, $endDate]);
        }])
        ->where('status', 'published')
        ->orderBy('blog_views_count', 'desc')
        ->limit(10)
        ->get();

        // Daily view trends
        $dailyViewTrends = BlogView::when($type !== 'all', function ($query) use ($type) {
            return $query->whereHas('blog', function ($q) use ($type) {
                $q->where('type', $type);
            });
        })->select(
            DB::raw('DATE(viewed_at) as date'),
            DB::raw('COUNT(*) as total_views'),
            DB::raw('COUNT(DISTINCT ip_address) as unique_views')
        )
        ->where('viewed_at', '>=', $startDate)
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        return view('admin.analytics.blogs', compact(
            'period',
            'type',
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'featuredPosts',
            'postsInPeriod',
            'publishedInPeriod',
            'totalViews',
            'viewsInPeriod',
            'uniqueViewsInPeriod',
            'categoryAnalytics',
            'monthlyTrends',
            'popularCategories',
            'recentPosts',
            'authorStats',
            'mostViewedPosts',
            'dailyViewTrends',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Get detailed analytics data for charts.
     */
    public function getChartData(Request $request)
    {
        $period = $request->get('period', '30');
        $type = $request->get('type', 'all');
        $chartType = $request->get('chart_type', 'daily');
        
        $startDate = Carbon::now()->subDays($period);
        
        if ($chartType === 'daily') {
            $data = Blog::when($type !== 'all', function ($query) use ($type) {
                return $query->where('type', $type);
            })->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "published" THEN 1 ELSE 0 END) as published'),
                DB::raw('SUM(CASE WHEN status = "draft" THEN 1 ELSE 0 END) as draft')
            )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        } elseif ($chartType === 'monthly') {
            $data = Blog::when($type !== 'all', function ($query) use ($type) {
                return $query->where('type', $type);
            })->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTHNAME(created_at) as month'),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(CASE WHEN status = "published" THEN 1 ELSE 0 END) as published'),
                DB::raw('SUM(CASE WHEN status = "draft" THEN 1 ELSE 0 END) as draft')
            )
            ->where('created_at', '>=', $startDate)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        }

        return response()->json($data);
    }

    /**
     * Export analytics data to CSV.
     */
    public function export(Request $request)
    {
        $type = $request->get('type', 'all');
        
        $data = Blog::when($type !== 'all', function ($query) use ($type) {
            return $query->where('type', $type);
        })->with('category')
        ->get(['id', 'title', 'author', 'type', 'status', 'featured', 'created_at', 'published_at']);

        $filename = 'blog_analytics_' . $type . '_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // CSV Header
            fputcsv($file, [
                'ID', 'Title', 'Author', 'Type', 'Status', 'Featured', 
                'Category', 'Created At', 'Published At'
            ]);
            
            // CSV Data
            foreach ($data as $post) {
                fputcsv($file, [
                    $post->id,
                    $post->title,
                    $post->author,
                    $post->type,
                    $post->status,
                    $post->featured ? 'Yes' : 'No',
                    $post->category ? $post->category->name : 'N/A',
                    $post->created_at->format('Y-m-d H:i:s'),
                    $post->published_at ? $post->published_at->format('Y-m-d H:i:s') : 'N/A'
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
