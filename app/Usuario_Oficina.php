<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario_Oficina extends Model
{
    protected $table = 'usuario_oficina';

    protected $fillable = [
        'user_id',
        'oficina_id'
    ];
}
