<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Device
 *
 * Represents a device within the system. This model maps to the 'dispositivos' table
 * in the database and contains basic information such as serial number and category.
 *
 * @package App\Models
 */
class Device extends Model
{
    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'dispositivos';

    /**
     * The attributes that are mass assignable.
     *
     * These fields can be filled through methods like create() or update().
     *
     * @var array
     */
    protected $fillable = [
        'numero_serie', // Device serial number
        'categoria'     // Device category
    ];
}
