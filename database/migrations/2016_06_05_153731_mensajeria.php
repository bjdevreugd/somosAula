<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mensajeria extends Migration
{
    public function up()
    {
        Schema::create('mensajeria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emisor_id')->unsigned();
            $table->foreign('emisor_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('asunto',250);
            $table->string('mensaje',250);
            $table->dateTime('fecha_enviado');
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
        Schema::drop('mensajeria');
    }
}
