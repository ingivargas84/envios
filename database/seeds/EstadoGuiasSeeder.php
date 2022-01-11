<?php

use Illuminate\Database\Seeder;
use App\Estado_Guia;

class EstadoGuiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edog = new Estado_Guia();
        $edog->estado_guia = 'Recibido';
        $edog->save();

        $edog = new Estado_Guia();
        $edog->estado_guia = 'En Ruta';
        $edog->save();

        $edog = new Estado_Guia();
        $edog->estado_guia = 'En Oficina Listo para Entrega';
        $edog->save();

        $edog = new Estado_Guia();
        $edog->estado_guia = 'En Bodega';
        $edog->save();

        $edog = new Estado_Guia();
        $edog->estado_guia = 'Entregado';
        $edog->save();

        $edog = new Estado_Guia();
        $edog->estado_guia = 'Rechazado';
        $edog->save();

        $edog = new Estado_Guia();
        $edog->estado_guia = 'Devuelto';
        $edog->save();

        $edog = new Estado_Guia();
        $edog->estado_guia = 'Retornado de Ruta';
        $edog->save();
    }
}
