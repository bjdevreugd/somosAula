<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTarea extends Migration
{
    public function up()
    {
        Schema::create('user_tarea', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_rol_id')->unsigned();
            $table->foreign('user_rol_id')
                ->references('id')->on('user_rol')
                ->onDelete('cascade');
            $table->integer('tarea_id')->unsigned();
            $table->foreign('tarea_id')
                ->references('id')->on('tarea')
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
        Schema::drop('user_tarea');
    }
}
