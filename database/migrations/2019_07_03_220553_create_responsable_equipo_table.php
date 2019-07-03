<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsableEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable_equipo', function (Blueprint $table) {
            $table->unsignedBigInteger('responsable_id');
            $table->foreign('responsable_id')->references('id')
                  ->on('responsables');
      
            $table->unsignedBigInteger('equipo_id');
            $table->foreign('equipo_id')->references('id')
                  ->on('equipos');

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
        Schema::dropIfExists('responsable_equipo');
    }
}
