<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColegioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colegio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('cod_aula', 250)->unique();
            $table->integer('user_rol_id')->unsigned();
            $table->foreign('user_rol_id')
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
        Schema::drop('colegio');
    }
}
