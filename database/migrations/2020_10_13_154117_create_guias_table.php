<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('no_guia');
            $table->integer('tipo_guia');
            
            $table->string('nombre_origen', 100);
            $table->string('telefono_origen', 50);

            $table->unsignedInteger('oficina_origen_id')->nullable();
            $table->foreign('oficina_origen_id')->references('id')->on('oficinas')->onDelete('cascade');

            $table->unsignedInteger('oficina_destino_id')->nullable();
            $table->foreign('oficina_destino_id')->references('id')->on('oficinas')->onDelete('cascade');

            $table->string('nombre_destino', 100);
            $table->string('telefono_destino', 50)->nullable();

            $table->unsignedInteger('destino_id')->nullable();
            $table->foreign('destino_id')->references('id')->on('destinos')->onDelete('cascade');
            
            $table->string('descripcion_contenido', 300);
            $table->integer('cantidad_contenido');

            $table->unsignedInteger('tipo_paquete_id')->nullable();
            $table->foreign('tipo_paquete_id')->references('id')->on('tipo_paquete')->onDelete('cascade');

            $table->unsignedInteger('tipo_cobro_id')->nullable();
            $table->foreign('tipo_cobro_id')->references('id')->on('tipo_cobro')->onDelete('cascade');

            $table->double('total_flete');
            $table->integer('fragil');

            $table->integer('empresa_id')->nullable();;
            $table->integer('no_envio')->nullable();;

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
        Schema::dropIfExists('guias');
    }
}
