<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $requiredRole = UserRole::tryFrom($role);
        
        if (!$requiredRole) {
            abort(403, 'Invalid role specified.');
        }

        // Check if user has the required role or higher
        if (!$this->hasRequiredRole($user, $requiredRole)) {
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }

    /**
     * Check if user has the required role or higher
     */
    private function hasRequiredRole($user, UserRole $requiredRole): bool
    {
        $userRole = $user->getRole();

        return match($requiredRole) {
            UserRole::USER => true, // All authenticated users have at least user role
            UserRole::ADMIN => $userRole === UserRole::ADMIN || $userRole === UserRole::SUPERADMIN,
            UserRole::SUPERADMIN => $userRole === UserRole::SUPERADMIN,
        };
    }
}
