<?php

/**
 * Laravel queue system configuration.
 *
 * This file defines the connections and parameters for managing background job queues.
 * Laravel supports multiple queue backends, including database, Redis, Amazon SQS, and more.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection
    |--------------------------------------------------------------------------
    |
    | This option defines the default queue connection that will be used.
    | Laravel provides multiple backend options to efficiently handle
    | background tasks.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Available Queue Connections
    |--------------------------------------------------------------------------
    |
    | Queue connections are configured for each available backend.
    | Laravel allows defining multiple connections and using the
    | most suitable one depending on the environment.
    |
    | Supported backends: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        // Synchronous queue: jobs are executed immediately
        'sync' => [
            'driver' => 'sync',
        ],

        // Database-based queue
        'database' => [
            'driver' => 'database',
            'connection' => env('DB_QUEUE_CONNECTION'),
            'table' => env('DB_QUEUE_TABLE', 'jobs'),
            'queue' => env('DB_QUEUE', 'default'),
            'retry_after' => (int) env('DB_QUEUE_RETRY_AFTER', 90), // Time before retry
            'after_commit' => false,
        ],

        // Beanstalkd-based queue (requires Beanstalkd installation)
        'beanstalkd' => [
            'driver' => 'beanstalkd',
            'host' => env('BEANSTALKD_QUEUE_HOST', 'localhost'),
            'queue' => env('BEANSTALKD_QUEUE', 'default'),
            'retry_after' => (int) env('BEANSTALKD_QUEUE_RETRY_AFTER', 90),
            'block_for' => 0,
            'after_commit' => false,
        ],

        // Amazon SQS-based queue
        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        // Redis-based queue (recommended for high concurrency)
        'redis' => [
            'driver' => 'redis',
            'connection' => env('REDIS_QUEUE_CONNECTION', 'default'),
            'queue' => env('REDIS_QUEUE', 'default'),
            'retry_after' => (int) env('REDIS_QUEUE_RETRY_AFTER', 90),
            'block_for' => null,
            'after_commit' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Job Batching Configuration
    |--------------------------------------------------------------------------
    |
    | This section defines the storage configuration for job batching.
    | Laravel allows grouping jobs into "batches" for execution.
    |
    */

    'batching' => [
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'job_batches',
    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Job Configuration
    |--------------------------------------------------------------------------
    |
    | Storage options are defined for recording failed jobs.
    | This allows debugging errors and retrying jobs without losing information.
    |
    | Supported drivers: "database-uuids", "dynamodb", "file", "null"
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'sqlite'),
        'table' => 'failed_jobs',
    ],

];
