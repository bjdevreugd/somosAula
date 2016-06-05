<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatosPersonales extends Migration
{
    public function up()
    {
        Schema::create('datos_personales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('secondname');
            $table->string('secondname2');
            $table->string('DNI');
            $table->string('email')->unique();
            $table->integer('telefono');
            $table->date('fechanacimiento');
            $table->string('imgperfil');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::drop('datos_personales');
    }
}