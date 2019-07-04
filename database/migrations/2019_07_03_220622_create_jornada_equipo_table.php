<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJornadaEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jornada_equipo', function (Blueprint $table) {
            $table->unsignedBigInteger('jornada_id');
            $table->foreign('jornada_id')->references('id')
                  ->on('jornadas');
      
            $table->unsignedBigInteger('equipo_id');
            $table->foreign('equipo_id')->references('id')
                  ->on('equipos');

            $table->boolean('empate')->nullable();
            $table->boolean('derrota')->nullable();
            $table->boolean('victoria')->nullable();
            $table->smallInteger('falta')->nullable();
            $table->smallInteger('penalizacion')->nullable();
            $table->boolean('arbitraje_completo')->nullable();
            $table->float('arbitraje_pagado')->default(0);
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
        Schema::dropIfExists('jornada_equipo');
    }
}
