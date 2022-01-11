<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guia_Detalle extends Model
{
    protected $table = 'guias_detalle';

    protected $fillable = [
        'id',
        'guia_id',
        'cantidad',
        'tipo_paquete_id',
        'envio_maestro_id',
        'descripcion'
    ];
}
