<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use App\Models\Client;
use App\Models\PageView;
use App\Models\Comment;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller
{
    public function dashboard()
    {
        try {
            $stats = [
                'total_users' => User::count(),
                'admin_users' => User::where('is_admin', true)->count(),
                'total_activities' => Activity::count(),
                'total_clients' => Client::count(),
                'active_clients' => Client::where('is_active', true)->count(),
                'new_users_today' => User::whereDate('created_at', now()->today())->count(),
            ];

            if (Schema::hasTable('page_views')) {
                $stats['web_visits_total'] = PageView::count();
                $stats['web_visits_today'] = PageView::whereDate('created_at', now()->today())->count();
                $stats['news_views_total'] = PageView::whereIn('type', ['news_index', 'news_detail'])->count();
                $stats['news_views_today'] = PageView::whereIn('type', ['news_index', 'news_detail'])
                    ->whereDate('created_at', now()->today())
                    ->count();
                $stats['blog_views_total'] = PageView::where('type', 'blog')->count();
            } else {
                $stats['web_visits_total'] = 0;
                $stats['web_visits_today'] = 0;
                $stats['news_views_total'] = 0;
                $stats['news_views_today'] = 0;
                $stats['blog_views_total'] = 0;
            }

            if (Schema::hasTable('comments')) {
                $stats['comments_total'] = Comment::count();
                $stats['comments_pending'] = Comment::where('is_approved', false)->count();
                $stats['comments_approved'] = Comment::where('is_approved', true)->count();
            } else {
                $stats['comments_total'] = 0;
                $stats['comments_pending'] = 0;
                $stats['comments_approved'] = 0;
            }
            
            $recent_activities = Activity::orderBy('sort_order')->orderByDesc('created_at')->take(8)->get();
            $recent_users = User::latest()->take(8)->get();
            $clients = Client::active()->ordered()->take(8)->get();
            
            return view('admin.dashboard', compact('stats', 'recent_activities', 'recent_users', 'clients'));
        } catch (\Exception $e) {
            // Log the error and return empty data
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            return view('admin.dashboard', [
                'stats' => [
                    'total_users' => 0,
                    'admin_users' => 0,
                    'total_activities' => 0,
                    'total_clients' => 0,
                    'active_clients' => 0,
                    'new_users_today' => 0,
                    'web_visits_total' => 0,
                    'web_visits_today' => 0,
                    'news_views_total' => 0,
                    'news_views_today' => 0,
                    'blog_views_total' => 0,
                    'comments_total' => 0,
                    'comments_pending' => 0,
                    'comments_approved' => 0,
                ],
                'recent_activities' => collect(),
                'recent_users' => collect(),
                'clients' => collect(),
            ]);
        }
    }
}
