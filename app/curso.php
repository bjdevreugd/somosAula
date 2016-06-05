<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class curso extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'curso';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'nombre_curso'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id', 'nombre_curso'];

}
