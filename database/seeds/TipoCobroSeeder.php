<?php

use Illuminate\Database\Seeder;
use App\Tipo_Cobro;

class TipoCobroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tc = new Tipo_Cobro();
        $tc->tipo_cobro = 'Cobrado';
        $tc->save();

        $tc = new Tipo_Cobro();
        $tc->tipo_cobro = 'Por Cobrar';
        $tc->save();
    }
}
