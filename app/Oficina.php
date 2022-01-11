<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $table = 'oficinas';

    protected $fillable = [
        'nombre',
        'cod_oficina',
        'direccion',
        'telefonos',
        'user_id',
        'estado_id'
    ];
}
