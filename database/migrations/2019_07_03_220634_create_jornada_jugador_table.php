<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJornadaJugadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jornada_jugador', function (Blueprint $table) {
            $table->unsignedBigInteger('jornada_id');
            $table->foreign('jornada_id')->references('id')
                  ->on('jornadas');

            $table->unsignedBigInteger('jugador_id');
            $table->foreign('jugador_id')->references('id')
                  ->on('jugadores');

            $table->boolean('es_amonestado')->nullable();
            $table->boolean('es_expulsado')->nullable();
            $table->smallInteger('cantidad_faltas')->nullable();
            $table->smallInteger('cantidad_goles')->nullable();
            $table->smallInteger('cantidad_autogoles')->nullable();

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
        Schema::dropIfExists('jornada_jugador');
    }
}
