<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\RoleMiddleware;

/**
 * Class Kernel
 *
 * The application Kernel manages Laravel's middleware stack,
 * including both global and route-specific middleware.
 *
 * This class is responsible for registering custom middleware
 * used throughout the application.
 *
 * @package App\Http
 */
class Kernel extends HttpKernel
{
    /**
     * List of custom route middleware available for use in routes or controllers.
     *
     * Keys represent middleware aliases used in routes (e.g., 'auth', 'role'),
     * and the values are the corresponding class implementations.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class, // ✅ Ensure this is properly registered
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'match.employee.carta' => \App\Http\Middleware\EnsureUserMatchesCarta::class, // Custom middleware for identity validation
    ];
}
