<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Technician
 *
 * Represents a technician in the system.
 * This model is mapped to the 'tecnicos' table in the database and currently includes
 * only the technician's email address as a mass assignable attribute.
 *
 * @package App\Models
 */
class Technician extends Model
{
    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'tecnicos';

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be set via mass assignment (e.g., create(), update()).
     *
     * @var array
     */
    protected $fillable = [
        'correo' // Technician's email
    ];
}
