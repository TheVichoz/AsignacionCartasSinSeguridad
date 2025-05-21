<?php

/**
 * Laravel service provider configuration file.
 *
 * This file defines the service providers that will be automatically loaded
 * when the application starts. Service providers are responsible for
 * bootstrapping core services, binding classes into the container,
 * and registering external packages or custom logic.
 */

return [

    /**
     * Main application service provider.
     *
     * The AppServiceProvider is responsible for registering essential configurations,
     * application-wide bindings, macros, and service bootstrapping logic.
     */
    App\Providers\AppServiceProvider::class,
];
