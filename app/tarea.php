<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class tarea extends Model
{
    /**
     * The database table used by the model.
     *master
     * @var string
     */
    protected $table = 'tarea';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','asignatura_id','titulo','descripcion','fecha_inicio','fecha_limite'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','asignatura_id','titulo','descripcion','fecha_inicio','fecha_limite'];

}
