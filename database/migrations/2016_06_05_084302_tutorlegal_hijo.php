<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TutorlegalHijo extends Migration
{
    public function up()
    {
        Schema::create('tutorlegal_hijo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hijo_id')->unsigned();
            $table->foreign('hijo_id')
                ->references('id')->on('user_rol')
                ->onDelete('cascade');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')
                ->references('id')->on('user_rol')
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
        Schema::drop('tutorlegal_hijo');
    }
}
