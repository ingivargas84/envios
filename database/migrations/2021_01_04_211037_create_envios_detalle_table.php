<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnviosDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envios_detalle', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('envio_maestro_id')->nullable();
            $table->foreign('envio_maestro_id')->references('id')->on('envios_maestro')->onDelete('cascade');

            $table->unsignedInteger('guia_id')->nullable();
            $table->foreign('guia_id')->references('id')->on('guias')->onDelete('cascade');

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
        Schema::dropIfExists('envios_detalle');
    }
}
