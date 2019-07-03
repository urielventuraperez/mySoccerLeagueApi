<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArbitrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbitros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('alias', 20)->nullable();
            $table->char('celular', 14);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arbitros');
    }
}
