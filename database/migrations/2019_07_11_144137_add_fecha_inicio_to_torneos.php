<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaInicioToTorneos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('torneos', function (Blueprint $table) {
            $table->dropColumn('valor_inscripcion');
            $table->dropColumn('valor_arbitraje');
            $table->date('inicio')->nullable();
            $table->date('fin')->nullable();
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
            $table->double('valor_inscripcion');
            $table->double('valor_arbitraje');
        });
    }
}
