<?php

/**
 * Configuration for third-party services in Laravel.
 *
 * This file stores credentials for third-party services such as Mailgun,
 * Postmark, AWS, Slack, and others. It centralizes the configuration of these
 * integrations so that packages and the application can easily access them
 * through environment variables.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Postmark Service
    |--------------------------------------------------------------------------
    |
    | Postmark is a transactional email sending service.
    | Here, the authentication token required to use the
    | Postmark API is stored.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Amazon SES Service
    |--------------------------------------------------------------------------
    |
    | Amazon Simple Email Service (SES) allows sending large-scale emails
    | with high reliability. The access key and the configured
    | service region are required.
    |
    */

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Resend Service
    |--------------------------------------------------------------------------
    |
    | Resend is an alternative for sending emails.
    | Here, the API key used for authentication is stored.
    |
    */

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Slack Integration
    |--------------------------------------------------------------------------
    |
    | This configuration allows sending notifications to a Slack channel
    | using an authenticated bot. The bot's OAuth token
    | and the default channel for notifications are required.
    |
    */

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Authentication
    |--------------------------------------------------------------------------
    |
    | Configuration for Google login via OAuth.
    | The client ID, secret key, and redirect URL are required.
    |
    */

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'), // Google client ID
        'client_secret' => env('GOOGLE_CLIENT_SECRET'), // Client secret key
        'redirect' => env('GOOGLE_REDIRECT_URI'), // Redirect URL after authentication
    ],

];
