<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiasDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias_detalle', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('guia_id')->nullable();
            $table->foreign('guia_id')->references('id')->on('guias')->onDelete('cascade');

            $table->integer('cantidad');

            $table->unsignedInteger('tipo_paquete_id')->nullable();
            $table->foreign('tipo_paquete_id')->references('id')->on('tipo_paquete')->onDelete('cascade');

            $table->string('descripcion', 100);

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
        Schema::dropIfExists('guias_detalle');
    }
}
