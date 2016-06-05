<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Asignaturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('nombre_asignatura',
                [
                    'Ciencias naturales','Ciencias sociales','Castellano','Primera lengua extranjera','Matemáticas','Educación física',
                    'Religión','Valores sociales y civicas','educación artistica','Segunda lengua extranjera','Refuerzo','Lengua cooficial',
                    'Geografía e historia','Biología y geología','Física y química','Especficia 1','Especifica 2','Tutoría',
                    'Opcional 1','Opcional 2'
                ]);
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
        Schema::drop('asignaturas');
    }
}
