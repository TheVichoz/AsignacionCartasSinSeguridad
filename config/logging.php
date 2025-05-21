<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

/**
 * Laravel logging system configuration.
 *
 * This file defines the log configuration for the application, using
 * the Monolog library to handle multiple logging channels and severity levels.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that will be used
    | to write the application's logs. The value must match one of
    | the configured channels in the "channels" list below.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Deprecation Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the channel where warnings related to deprecated
    | PHP and library features will be logged. This helps prepare the
    | application for future updates.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => env('LOG_DEPRECATIONS_TRACE', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging Channel Configuration
    |--------------------------------------------------------------------------
    |
    | Here, you can define multiple logging channels for your application.
    | Laravel uses Monolog, allowing different handlers and log formats
    | to be configured according to system requirements.
    |
    | Available drivers: "single", "daily", "slack", "syslog",
    |                     "errorlog", "monolog", "custom", "stack"
    |
    */

    'channels' => [

        // Stacked log channel that groups multiple channels
        'stack' => [
            'driver' => 'stack',
            'channels' => explode(',', env('LOG_STACK', 'single')),
            'ignore_exceptions' => false,
        ],

        // Channel that stores logs in a single file
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        // Daily log channel (generates a new file per day)
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => env('LOG_DAILY_DAYS', 14),
            'replace_placeholders' => true,
        ],

        // Channel for sending logs to Slack via Webhook
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => env('LOG_SLACK_USERNAME', 'Laravel Log'),
            'emoji' => env('LOG_SLACK_EMOJI', ':boom:'),
            'level' => env('LOG_LEVEL', 'critical'),
            'replace_placeholders' => true,
        ],

        // Channel for sending logs to Papertrail
        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => env('LOG_PAPERTRAIL_HANDLER', SyslogUdpHandler::class),
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
                'connectionString' => 'tls://'.env('PAPERTRAIL_URL').':'.env('PAPERTRAIL_PORT'),
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        // Channel that writes logs to the standard error output (stderr)
        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
            'processors' => [PsrLogMessageProcessor::class],
        ],

        // Channel that sends logs to the syslog logging system
        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
            'facility' => env('LOG_SYSLOG_FACILITY', LOG_USER),
            'replace_placeholders' => true,
        ],

        // Channel that uses PHP's built-in error logging system
        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
            'replace_placeholders' => true,
        ],

        // Log channel that discards any log messages (silences logs)
        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        // Emergency log channel used if no other channel is available
        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

    ],

];
