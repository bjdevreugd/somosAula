<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserExcursion extends Migration
{
    public function up()
    {
        Schema::create('user_excursion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_rol_id')->unsigned();
            $table->foreign('user_rol_id')
                ->references('id')->on('user_rol')
                ->onDelete('cascade');
            $table->integer('excursion_id')->unsigned();
            $table->foreign('excursion_id')
                ->references('id')->on('excursion')
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
        Schema::drop('user_excursion');
    }
}
