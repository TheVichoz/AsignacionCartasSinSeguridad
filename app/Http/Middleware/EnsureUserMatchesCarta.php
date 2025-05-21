<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EndUserController;
use Illuminate\Http\Request;

/**
 * Class EnsureUserMatchesCarta
 *
 * Middleware that ensures the authenticated user matches the employee
 * associated with the carta (assignment letter) being accessed.
 *
 * This is used to restrict access to carta signing views to only the
 * intended employee, based on email matching.
 *
 * @package App\Http\Middleware
 */
class EnsureUserMatchesCarta
{
    /**
     * Handle an incoming request and verify user identity.
     *
     * If the user is not authenticated, they will be redirected to the
     * Google OAuth login and their intended URL will be saved.
     *
     * If authenticated, the middleware fetches employee data by user ID
     * and ensures the email of the logged-in user matches the one from
     * the employee record. If it doesn't match, a 403 error is thrown.
     *
     * @param Request $request The current HTTP request
     * @param Closure $next The next request handler
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Redirect to login if the user is not authenticated
        if (!Auth::check()) {
            session(['url.intended' => $request->fullUrl()]);
            return redirect('/auth/redirect/google');
        }

        $user = Auth::user();
        $userId = $request->route('user_id');

        // Retrieve employee data using the internal controller
        $endUserController = new EndUserController();
        $response = $endUserController->getUserById(new Request(['user_id' => $userId]));
        $data = $response->getData(true);

        // Return 404 if the employee does not exist
        if (empty($data['employees'])) {
            abort(404, 'Empleado no encontrado.');
        }

        $employee = $data['employees'][0];

        // Deny access if the authenticated user's email does not match
        if ($user->email !== $employee['email']) {
            abort(403, 'No tienes permiso para firmar esta carta.');
        }

        // Proceed to the next middleware/request handler
        return $next($request);
    }
}
