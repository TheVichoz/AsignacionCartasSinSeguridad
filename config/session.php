<?php

use Illuminate\Support\Str;

/**
 * Laravel session configuration.
 *
 * This file defines the session configuration within the application.
 * Laravel offers multiple session drivers such as database, files, cookies,
 * cache, and more, allowing session storage to be adapted as needed.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | Defines the session storage method to be used in the application.
    | Laravel supports multiple session storage types:
    |
    | Available options: "file", "cookie", "database", "apc",
    |                    "memcached", "redis", "dynamodb", "array"
    |
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | The number of minutes a session can remain active before expiring.
    | If it should expire when the user closes the browser, the
    | `expire_on_close` option should be enabled.
    |
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),
    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    |
    | Determines whether session data should be encrypted before being stored
    | in the selected storage method. This provides greater security for session data.
    |
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | File-Based Session Storage Location
    |--------------------------------------------------------------------------
    |
    | Only applicable when the session `driver` is "file".
    | Specifies the directory where session files will be stored.
    |
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Database Storage Configuration
    |--------------------------------------------------------------------------
    |
    | If using the "database" or "redis" session `driver`, the connection
    | and table where sessions will be stored must be specified.
    |
    */

    'connection' => env('SESSION_CONNECTION'),
    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Cache Store for Sessions
    |--------------------------------------------------------------------------
    |
    | If using a cache-based `driver` such as "apc", "memcached", or "redis",
    | this parameter defines which cache should be used for storing sessions.
    |
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Probability of Cleaning Expired Sessions
    |--------------------------------------------------------------------------
    |
    | Some session storage methods require manual cleanup of expired data.
    | This option defines the probability of cleanup running on a request.
    | The value [2, 100] means there is a 2% chance of execution.
    |
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    |
    | Defines the name of the session cookie that Laravel will generate
    | and send to the client.
    |
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel'), '_').'_session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Cookie Configuration
    |--------------------------------------------------------------------------
    |
    | Defines rules and restrictions for session cookies, including
    | domain, HTTPS security, and the SameSite policy.
    |
    */

    'path' => env('SESSION_PATH', '/'),
    'domain' => env('SESSION_DOMAIN'),
    'secure' => env('SESSION_SECURE_COOKIE'),
    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Same-Site Policy for Session Cookies
    |--------------------------------------------------------------------------
    |
    | Controls how session cookies are handled in cross-site requests.
    | It is recommended to keep it as "lax" to avoid issues
    | with authentication and CSRF security.
    |
    | Options: "lax", "strict", "none", null
    |
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Partitioned Session Cookies
    |--------------------------------------------------------------------------
    |
    | If enabled, cookies will be restricted to the main site
    | in a multi-site context. This only works if the cookie is
    | "secure" and Same-Site is set to "none."
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
