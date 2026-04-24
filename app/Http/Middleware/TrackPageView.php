<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$request->isMethod('GET')) {
            return $response;
        }

        if ($request->is('admin/*')) {
            return $response;
        }

        $path = '/'.$request->path();

        $type = null;
        $viewableType = null;
        $viewableId = null;

        if ($request->is('news')) {
            $type = 'news_index';
        } elseif ($request->is('news/*')) {
            $type = 'news_detail';

            $slug = $request->route('slug');
            if (is_string($slug) && $slug !== '') {
                $blog = Blog::query()->where('slug', $slug)->first();
                if ($blog) {
                    $viewableType = $blog->getMorphClass();
                    $viewableId = $blog->getKey();
                }
            }
        } elseif ($request->is('blog') || $request->is('blog/*') || $request->is('blogs') || $request->is('blogs/*')) {
            $type = 'blog';
        }

        if ($type === null) {
            return $response;
        }

        try {
            PageView::create([
                'type' => $type,
                'path' => $path,
                'viewable_type' => $viewableType,
                'viewable_id' => $viewableId,
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 500),
                'session_id' => (string) $request->session()->getId(),
            ]);
        } catch (\Throwable $e) {
            \Log::warning('TrackPageView failed: '.$e->getMessage());
        }

        return $response;
    }
}
