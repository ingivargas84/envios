<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_guias', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('guia_id')->nullable();
            $table->foreign('guia_id')->references('id')->on('guias')->onDelete('cascade');

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
        Schema::dropIfExists('movimiento_guias');
    }
}
