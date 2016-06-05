<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Asistencia extends Migration
{
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha_clase');
            $table->integer('asignatura_id')->unsigned();
            $table->foreign('asignatura_id')
                ->references('id')->on('asignaturas')
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
        Schema::drop('asistencia');
    }
}
