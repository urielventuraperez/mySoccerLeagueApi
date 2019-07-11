<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalizadoToJornadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jornadas', function (Blueprint $table) {
            $table->boolean('finalizado')->default(0);
            $table->date('fecha_inicio_jornada')->nullable();
            $table->date('fecha_fin_jornada')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jornadas', function (Blueprint $table) {
            //
        });
    }
}
