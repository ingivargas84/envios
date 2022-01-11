<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_Guia extends Model
{
    protected $table = 'movimiento_guias';

    protected $fillable = [
        'id',
        'user_id',
        'guia_id',
        'estado_guia_id'
    ];
}

