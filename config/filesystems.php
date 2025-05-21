<?php

/**
 * Laravel filesystem configuration.
 *
 * This file defines the file storage configuration, allowing work with local
 * disks, FTP servers, cloud storage (S3), and more.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | This option defines the default storage disk for the application.
    | It can be configured to use local or cloud storage as needed.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Storage Disks
    |--------------------------------------------------------------------------
    |
    | Laravel allows configuring multiple storage "disks," which can use different
    | drivers such as local, FTP, SFTP, or Amazon S3.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        // Local disk storage within the "storage/app/private" directory
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        // Public storage accessible from the web (storage/app/public)
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        // Amazon S3 storage
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Laravel allows creating symbolic links that point to storage directories
    | so that files are publicly accessible using the command:
    |
    | php artisan storage:link
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
