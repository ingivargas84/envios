<?php

use Illuminate\Database\Seeder;
use App\Oficina;

class OficinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $of = new Oficina();
        $of->nombre = 'Guastatoya';
        $of->cod_oficina = 'GTA';
        $of->direccion = 'Turicentro Paola, Bo El Porvenir, Guastatoya';
        $of->telefonos = '79450505';
        $of->user_id = 1;
        $of->estado_id = 1;
        $of->save();

        $of = new Oficina();
        $of->nombre = '21 Calle';
        $of->cod_oficina = '21C';
        $of->direccion = '21 Calle, Zona 1, Ciudad de Guatemala';
        $of->telefonos = '22222222';
        $of->user_id = 1;
        $of->estado_id = 1;
        $of->save();

        $of = new Oficina();
        $of->nombre = 'Centra Norte';
        $of->cod_oficina = 'CNT';
        $of->direccion = 'Centro Comercial Centra Norte, Zona 17, Ciudad de Guatemala';
        $of->telefonos = '79450505';
        $of->user_id = 1;
        $of->estado_id = 1;
        $of->save();
    }
}
