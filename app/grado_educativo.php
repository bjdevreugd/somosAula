<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class grado_educativo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'grado_educativo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','grado'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','grado'];
}
