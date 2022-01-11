<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edo = new Estado();
        $edo->estado = 'Activo';
        $edo->save();

        $edo = new Estado();
        $edo->estado = 'Inactivo';
        $edo->save();
    }
}
