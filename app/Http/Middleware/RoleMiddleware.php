<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class RoleMiddleware
 *
 * Middleware to restrict access to specific routes based on the authenticated user's role.
 * If the user is not logged in or does not have the required role, access is denied.
 *
 * @package App\Http\Middleware
 */
class RoleMiddleware
{
    /**
     * Handle an incoming request and validate the user's role.
     *
     * If the user is not authenticated, they will be redirected to the login page.
     * If authenticated but lacking the required role, a 403 error is returned.
     *
     * @param  \Illuminate\Http\Request  $request  The current HTTP request.
     * @param  \Closure  $next  The next middleware or controller.
     * @param  string  $role  The required role to access the route.
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login page if not authenticated
        }

        // Check if the authenticated user has the required role
        if (!Auth::user()->hasRole($role)) {
            abort(403, 'No tienes permiso para acceder a esta página.'); // Return 403 if role check fails
        }

        // Allow request to proceed
        return $next($request);
    }
}
