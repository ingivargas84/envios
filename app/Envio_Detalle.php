<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio_Detalle extends Model
{
    protected $table = 'envios_detalle';

    protected $fillable = [
        'envio_maestro_id',
        'guia_id'
    ];
}
