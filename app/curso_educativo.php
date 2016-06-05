<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class curso_educativo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'curso_educativo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'curso_id', 'grado_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id', 'curso_id', 'grado_id'];
    

}
