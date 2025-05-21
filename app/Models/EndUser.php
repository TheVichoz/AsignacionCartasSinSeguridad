<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EndUser
 *
 * Represents an end user within the system.
 * This model is mapped to the `usuarios` table in the database and includes
 * fields such as name, supervisor, location, and contact information.
 *
 * @package App\Models
 */
class EndUser extends Model
{
    use HasFactory;

    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuarios'; // ✅ Keeps the same database table name

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be set via mass assignment methods like create() and update().
     *
     * @var array
     */
    protected $fillable = [
        'nombre',     // User's full name
        'supervisor', // Supervisor's name
        'centro',     // Cost center or department
        'correo',     // Email address
        'ubicacion'   // Physical location
    ];
}
