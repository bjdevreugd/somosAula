<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tutoria extends Migration
{
    public function up()
    {
        Schema::create('tutoria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emisor_id')->unsigned();
            $table->foreign('emisor_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('titulo',250);
            $table->string('descripcion',250);
            $table->dateTime('fecha_tutoria');
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
        Schema::drop('tutoria');
    }
}
