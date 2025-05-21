<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

/**
 * This file initializes the Laravel application instance and sets up
 * routing, middleware, exception handling, and service bindings.
 */

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',         // Register web routes
        commands: __DIR__.'/../routes/console.php', // Register Artisan console commands
        health: '/up',                              // Health check route
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Define global middleware here if needed
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Do not manually set a custom exception handler here
        // Exception handling is already bound below using withBindings()
    })
    ->withBindings([
        ExceptionHandler::class => Handler::class, // Bind the custom exception handler
    ])
    ->create();
