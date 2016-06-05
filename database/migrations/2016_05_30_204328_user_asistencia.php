<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAsistencia extends Migration
{
    public function up()
    {
        Schema::create('user_asistencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_rol_id')->unsigned();
            $table->foreign('user_rol_id')
                ->references('id')->on('user_rol')
                ->onDelete('cascade');
            $table->integer('asistencia_id')->unsigned();
            $table->foreign('asistencia_id')
                ->references('id')->on('asistencia')
                ->onDelete('cascade');
            $table->timestamps();
            $table->boolean('asiste');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_asistencia');
    }
}
