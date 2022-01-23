<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChollosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chollos', function (Blueprint $table) {
            $table->id();
            $table->string("titulo");
            $table->text("descripcion");
            $table->string("url");
            $table->string("categoria");
            $table->integer("puntuacion");
            $table->float("precio");
            $table->float("precio_descuento");
            $table->boolean("disponible");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chollos');
    }
}
