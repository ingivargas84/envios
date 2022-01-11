<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnviosMaestroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios_maestro', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('oficina_envia_id')->nullable();
            $table->foreign('oficina_envia_id')->references('id')->on('oficinas')->onDelete('cascade');

            $table->unsignedInteger('oficina_recibe_id')->nullable();
            $table->foreign('oficina_recibe_id')->references('id')->on('oficinas')->onDelete('cascade');

            $table->unsignedInteger('vehiculo_id')->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');

            $table->unsignedInteger('piloto_id')->nullable();
            $table->foreign('piloto_id')->references('id')->on('empleados')->onDelete('cascade');
            
            $table->double('total_cobrado');
            $table->double('total_por_cobrar');
            $table->double('total_enviado');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('estado_guia_id')->nullable();
            $table->foreign('estado_guia_id')->references('id')->on('estado_guia')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('envios_maestro');
    }
}
