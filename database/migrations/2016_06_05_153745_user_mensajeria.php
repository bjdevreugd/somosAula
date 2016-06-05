<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserMensajeria extends Migration
{
    public function up()
    {
        Schema::create('user_mensajeria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mensajeria_id')->unsigned();
            $table->foreign('mensajeria_id')
                ->references('id')->on('mensajeria')
                ->onDelete('cascade');
            $table->integer('receptor_id')->unsigned();
            $table->foreign('receptor_id')
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
        Schema::drop('user_mensajeria');
    }
}
