<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
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
        $page = Page::where('route_name', $routeName)->active()->first();

        // If page is not configured, allow access (default allow)
        if (!$page) {
            return $next($request);
        }

        // Check if user has access to this page
        if (!$page->hasAccess($user)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
