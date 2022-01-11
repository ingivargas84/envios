<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';

    protected $fillable = [
        'no_placa',
        'descripcion',
        'user_id',
        'estado_id'
    ];
}
