<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTorneoArbitroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('torneo_arbitro', function (Blueprint $table) {
            $table->unsignedBigInteger('torneo_id');
            $table->foreign('torneo_id')->references('id')
                  ->on('torneos');
      
            $table->unsignedBigInteger('arbitro_id');
            $table->foreign('arbitro_id')->references('id')
                  ->on('arbitros');

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
        Schema::dropIfExists('torneo_arbitro');
    }
}
