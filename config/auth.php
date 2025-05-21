<?php

/**
 * Laravel application authentication configuration.
 *
 * This file manages authentication controllers and user providers,
 * allowing the configuration of different security strategies.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Configuration
    |--------------------------------------------------------------------------
    |
    | Here, the default authentication system for the application is defined.
    | These values can be changed according to project requirements.
    |
    */

    'defaults' => [
        'guard' => 'web', // Specifies the default guard (session for web users)
        'passwords' => 'users', // Specifies the password reset configuration
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards Configuration
    |--------------------------------------------------------------------------
    |
    | Laravel allows multiple authentication "guards," which define how users
    | authenticate within the application (via session, token, etc.).
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session', // Uses sessions to authenticate users
            'provider' => 'users', // Indicates which user provider will be used
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers Configuration
    |--------------------------------------------------------------------------
    |
    | User providers define how user data is retrieved from the database
    | or any external service.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent', // Uses Eloquent to retrieve users
            'model' => App\Models\User::class, // Defines the user model to be used
        ],
    ],

];
