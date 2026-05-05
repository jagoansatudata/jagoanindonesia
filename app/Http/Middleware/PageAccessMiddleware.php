<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PageAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $routeName = null): Response
    {
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        if ($request->routeIs('admin.pages.*')) {
            return $next($request);
        }

        $routeName = $routeName ?: $request->route()?->getName();

        if (!$routeName) {
            return $next($request);
        }

        // Users with full access (superadmin) have access to all pages
        if ($user->hasFullAccess()) {
            return $next($request);
        }

        // Check if the page exists and is active
        $page = Cache::remember(
            'page_access.page_by_route.' . $routeName,
            now()->addMinutes(5),
            fn () => Page::where('route_name', $routeName)->active()->first()
        );

        // If page is not configured, allow access (default allow)
        if (!$page) {
            return $next($request);
        }

        // Check if user has access to this page
        $hasAccess = Cache::remember(
            'page_access.has_access.page_' . $page->id . '.user_' . $user->id,
            now()->addMinutes(2),
            fn () => $page->hasAccess($user)
        );

        if (!$hasAccess) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
