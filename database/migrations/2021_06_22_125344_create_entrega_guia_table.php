<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntregaGuiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrega_guia', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('guia_id')->nullable();
            $table->foreign('guia_id')->references('id')->on('guias')->onDelete('cascade');

            $table->unsignedInteger('tipo_entrega_id')->nullable();
            $table->foreign('tipo_entrega_id')->references('id')->on('tipo_entrega')->onDelete('cascade');

            $table->string('dpi', 40)->nullable()->default(null);
            $table->string('nombre_recibe', 60)->nullable()->default(null);

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('entrega_guia');
    }
}
