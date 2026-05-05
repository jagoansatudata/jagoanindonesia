<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        $csp = "default-src 'self'; "
            . "base-uri 'self'; "
            . "frame-ancestors 'self'; "
            . "form-action 'self'; "
            . "object-src 'none'; "
            . "img-src 'self' data:; "
            . "font-src 'self' data: https://fonts.gstatic.com https://fonts.bunny.net; "
            . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.bunny.net; "
            . "style-src-elem 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.bunny.net; "
            . "script-src 'self' 'unsafe-inline' https://static.cloudflareinsights.com; "
            . "script-src-elem 'self' 'unsafe-inline' https://static.cloudflareinsights.com;";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
