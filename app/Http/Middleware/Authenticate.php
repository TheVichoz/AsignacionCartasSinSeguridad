<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

/**
 * Class Authenticate
 *
 * Middleware responsible for handling unauthenticated requests.
 * If the incoming request is not authenticated and does not expect a JSON response,
 * the user will be redirected to the Google authentication route.
 *
 * @package App\Http\Middleware
 */
class Authenticate extends Middleware
{
    /**
     * Determine where to redirect users when they are not authenticated.
     *
     * If the request does not expect a JSON response (e.g., it's a browser request),
     * the user will be redirected to the Google OAuth login route.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null URL to redirect to, or null for JSON requests.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            return route('google.redirect');
        }

        return null;
    }
}
