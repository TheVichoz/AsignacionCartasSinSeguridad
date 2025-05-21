<?php

/**
 * Laravel mail configuration.
 *
 * This file defines the settings used for sending emails.
 * Laravel supports multiple mail services such as SMTP, Sendmail, Mailgun, SES,
 * Postmark, among others.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the mail service that will be used to send emails
    | from the application unless another one is specified at the time of sending.
    | It can be configured within the "mailers" array.
    |
    | Supported values: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    |                   "postmark", "resend", "log", "array",
    |                   "failover", "roundrobin"
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Mailers Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure the different mailers the application will use.
    | Laravel allows defining multiple configurations to use different
    | sending methods as needed.
    |
    */

    'mailers' => [

        // Configuration for SMTP (standard email protocol)
        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        // Configuration for Amazon SES
        'ses' => [
            'transport' => 'ses',
        ],

        // Configuration for Postmark
        'postmark' => [
            'transport' => 'postmark',
            // Optionally, a message stream can be defined
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        // Configuration for Resend (email forwarding service)
        'resend' => [
            'transport' => 'resend',
        ],

        // Configuration for Sendmail (email on Unix servers)
        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        // Log emails (for testing purposes)
        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        // Store emails in an array (without sending them)
        'array' => [
            'transport' => 'array',
        ],

        // Failover strategy: tries SMTP first, then Log if it fails
        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],

        // Round-robin load balancing strategy (SES and Postmark)
        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | A global sender can be defined for all emails sent from the application.
    | Here, you specify the name and email address that will be used as "From:" in emails.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

];
