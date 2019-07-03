<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            /* Añadidos */
            $table->string('apellido', 45);
            $table->string('alias', 35)->nullable();
            $table->char('celular', 14);
            $table->smallInteger('edad')->nullable();
            $table->boolean('es_torneo')->nullable();
            $table->boolean('es_equipo')->nullable();
            /* Fin Añadidos */
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
