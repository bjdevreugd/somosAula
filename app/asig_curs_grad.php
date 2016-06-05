<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class asig_curs_grad extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'asig_curs_grad';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['asignatura_id', 'curso_grado_id','id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['asignatura_id', 'curso_grado_id','id'];
}
