<?php

/**
 * Spatie Laravel Permission package configuration.
 *
 * This file contains the main settings for managing roles and permissions
 * in the application. It uses the Spatie library to simplify authorization management.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Permission and Role Models
    |--------------------------------------------------------------------------
    |
    | Defines the models that the package will use to manage permissions and roles.
    | These models must implement the appropriate Spatie interfaces.
    |
    */

    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Table Names
    |--------------------------------------------------------------------------
    |
    | Defines the names of the tables used to store roles, permissions,
    | and their relationships with users or other models.
    |
    */

    'table_names' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'model_has_permissions' => 'model_has_permissions',
        'model_has_roles' => 'model_has_roles',
        'role_has_permissions' => 'role_has_permissions',
    ],

    /*
    |--------------------------------------------------------------------------
    | Column Names
    |--------------------------------------------------------------------------
    |
    | Configuration of the column names used in relationship tables.
    | These can be customized based on project requirements.
    |
    */

    'column_names' => [
        'role_pivot_key' => null, // Default: 'role_id'
        'permission_pivot_key' => null, // Default: 'permission_id'
        'model_morph_key' => 'model_id',
        'team_foreign_key' => 'team_id',
    ],

    /*
    |--------------------------------------------------------------------------
    | Permission Check Method Registration
    |--------------------------------------------------------------------------
    |
    | If set to `true`, a method will be registered in Laravel's Gate
    | to automatically check permissions.
    |
    */

    'register_permission_check_method' => true,

    /*
    |--------------------------------------------------------------------------
    | Laravel Octane Event Listener
    |--------------------------------------------------------------------------
    |
    | If enabled, Laravel will listen for termination events in Octane
    | to reset permissions on each request or completed task.
    |
    */

    'register_octane_reset_listener' => false,

    /*
    |--------------------------------------------------------------------------
    | Teams Implementation
    |--------------------------------------------------------------------------
    |
    | If enabled, the `team_id` foreign key will be used in permission
    | and role tables, allowing segmentation by teams.
    |
    */

    'teams' => false,

    /*
    |--------------------------------------------------------------------------
    | Passport Integration
    |--------------------------------------------------------------------------
    |
    | If enabled, permissions will be validated using Laravel Passport
    | client credentials.
    |
    */

    'use_passport_client_credentials' => false,

    /*
    |--------------------------------------------------------------------------
    | Exception Message Configuration
    |--------------------------------------------------------------------------
    |
    | If enabled, exception messages will include the required permission
    | or role, which may pose a security risk in some cases.
    |
    */

    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,

    /*
    |--------------------------------------------------------------------------
    | Wildcard Permissions
    |--------------------------------------------------------------------------
    |
    | If enabled, wildcard (`*`) permissions will be allowed.
    | Useful for defining more flexible permissions.
    |
    */

    'enable_wildcard_permission' => false,

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | To improve performance, permissions and roles are cached
    | for a defined period. A custom cache driver can be specified if needed.
    |
    */

    'cache' => [
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),
        'key' => 'spatie.permission.cache',
        'store' => 'default',
    ],
];
