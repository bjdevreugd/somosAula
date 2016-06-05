<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTutoria extends Migration
{
    public function up()
    {
        Schema::create('user_tutoria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tutoria_id')->unsigned();
            $table->foreign('tutoria_id')
                ->references('id')->on('tutoria')
                ->onDelete('cascade');
            $table->integer('receptor_id')->unsigned();
            $table->foreign('receptor_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->boolean('asiste')->default(0);
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
        Schema::drop('user_tutoria');
    }
}
