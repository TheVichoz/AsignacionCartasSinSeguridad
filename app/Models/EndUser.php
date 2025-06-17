<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndUser extends Model
{
    use HasFactory;

protected $table = 'usuarios';

protected $fillable = [
    'user_id',
    'display_name',
    'email',
    'location',
    'cost_center_account_number',
    'cost_center_name',
    'supervisor',
    'position',
    'nombre',
    'centro',
    'correo',
];
}

