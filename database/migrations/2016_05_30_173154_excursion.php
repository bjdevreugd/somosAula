<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Excursion extends Migration
{
    public function up()
    {
        Schema::create('excursion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo',250);
            $table->string('descripcion',250);
            $table->decimal('importe');
            $table->dateTime('fecha_excursion');
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
        Schema::drop('excursion');
    }
}
