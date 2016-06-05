<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlumAsigCursGrad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alum_asig_curs_grad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_rol_id')->unsigned();
            $table->foreign('user_rol_id')
                ->references('id')->on('user_rol')
                ->onDelete('cascade');
            $table->integer('asig_curs_grad_id')->unsigned();
            $table->foreign('asig_curs_grad_id')
                ->references('id')->on('asig_curs_grad')
                ->onDelete('cascade');
            $table->decimal('nota');
            $table->string('descripcion', 250);
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
        Schema::drop('alum_asig_curs_grad');
    }
}
