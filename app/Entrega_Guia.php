<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrega_Guia extends Model
{
    protected $table = 'entrega_guia';

    protected $fillable = [
        'id',
        'guia_id',
        'tipo_entrega_id',
        'dpi',
        'nombre_recibe',
        'user_id'
    ];
}
