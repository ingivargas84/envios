<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UsersSeeder::class);
        $this->call(NegocioSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(EstadoGuiasSeeder::class);
        $this->call(TipoCobroSeeder::class);
        $this->call(TipoPaqueteSeeder::class);
        $this->call(OficinasSeeder::class);
        $this->call(DestinosSeeder::class);
        
        //$this->call(TiposLocalidadesSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');        
    }
}
