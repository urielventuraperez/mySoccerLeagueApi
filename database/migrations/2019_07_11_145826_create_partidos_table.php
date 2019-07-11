<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipo_visitante_id');
            $table->unsignedBigInteger('equipo_local_id');
            $table->unsignedBigInteger('jornada_id');
            $table->unsignedBigInteger('tipo_partido_id');
            $table->foreign('equipo_visitante_id')->references('id')->on('equipos');
            $table->foreign('equipo_local_id')->references('id')->on('equipos');
            $table->foreign('jornada_id')->references('id')->on('jornadas');
            $table->foreign('tipo_partido_id')->references('id')->on('tipo_partidos');
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
        Schema::dropIfExists('partidos');
    }
}
