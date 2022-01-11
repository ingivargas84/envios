<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    protected $table = 'guias';

    protected $fillable = [
        'no_guia',
        'tipo_guia',
        'nombre_origen',
        'telefono_origen',
        'oficina_origen_id',
        'oficina_destino_id',
        'nombre_destino',
        'telefono_destino',
        'destino_id',
        'descripcion_contenido',
        'cantidad_contenido',
        'tipo_paquete_id',
        'tipo_cobro_id',
        'total_flete',
        'fragil',
        'empresa_id',
        'no_envio',
        'user_id',
        'estado_guia_id'
    ];
}

            