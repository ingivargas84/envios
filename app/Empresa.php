<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'nombre_empresa',
        'telefono_empresa',
        'direccion_empresa',
        'user_id',
        'estado_id'
    ];
}
