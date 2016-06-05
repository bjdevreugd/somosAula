<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class asistencia extends Model
{
    protected $table = 'asistencia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','fecha_clase','asignatura_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','fecha_clase','asignatura_id'];
}
