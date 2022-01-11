<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = [
        'nombre_empleado',
        'telefono_empleado',
        'cui_empleado',
        'direccion_empleado',
        'user_id',
        'estado_id'
    ];
}
