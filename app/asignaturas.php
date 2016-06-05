<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class asignaturas extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asignaturas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_asignatura','id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['nombre_asignatura','id'];
}
