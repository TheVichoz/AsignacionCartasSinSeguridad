<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * Application-wide service provider.
 * This provider is used to register and configure global services, bindings,
 * macros, or custom logic used throughout the application.
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register application services.
     *
     * This method is called early in the application lifecycle.
     * It is used to bind classes or services into Laravel’s service container.
     *
     * @return void
     */
    public function register(): void
    {
        // Register custom bindings or third-party services here
    }

    /**
     * Bootstrap any application services.
     *
     * This method is executed after all other service providers have been registered.
     * It is typically used for configuration, view composers, or macros.
     *
     * @return void
     */
    public function boot(): void
    {
        // Configure or initialize services here
    }
}
