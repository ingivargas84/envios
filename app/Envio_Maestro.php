<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio_Maestro extends Model
{
    protected $table = 'envios_maestro';

    protected $fillable = [
        'oficina_envia_id',
        'oficina_recibe_id',
        'vehiculo_id',
        'piloto_id',
        'total_cobrado',
        'total_por_cobrar',
        'total_enviado',
        'user_id',
        'estado_guia_id'
    ];
}