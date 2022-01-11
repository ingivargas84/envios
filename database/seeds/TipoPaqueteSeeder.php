<?php

use Illuminate\Database\Seeder;
use App\Tipo_Paquete;

class TipoPaqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tp = new Tipo_Paquete();
        $tp->tipo_paquete = 'Sobre';
        $tp->save();

        $tp = new Tipo_Paquete();
        $tp->tipo_paquete = 'Caja';
        $tp->save();

        $tp = new Tipo_Paquete();
        $tp->tipo_paquete = 'Bulto';
        $tp->save();

        $tp = new Tipo_Paquete();
        $tp->tipo_paquete = 'Paquete';
        $tp->save();
    }
}
