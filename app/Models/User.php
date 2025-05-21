<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

/**
 * Class User
 *
 * Represents an authenticated user within the application.
 * This model extends Laravel's built-in Authenticatable class and includes traits
 * for notifications, role/permission handling, and factory support.
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be populated using mass assignment methods like create() or update().
     *
     * @var array
     */
    protected $fillable = [
        'name',        // User's full name
        'email',       // User's email address
        'password',    // User's hashed password
        'google_id'    // OAuth ID provided by Google
    ];

    /**
     * The attributes that should be hidden when the model is serialized to JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password',        // Hide the password hash
        'remember_token'   // Hide the remember token used for sessions
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Cast email verification timestamp to a Carbon instance
    ];
}
