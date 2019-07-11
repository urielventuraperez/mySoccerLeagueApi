<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostoInscripcionToTorneos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('torneos', function (Blueprint $table) {
            $table->double('costo_inscripcion')->default(0)->nullable();
            $table->double('costo_arbitraje')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('torneos', function (Blueprint $table) {
            //
        });
    }
}
