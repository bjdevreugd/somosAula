<?php

namespace somosAula;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'colegio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','user_rol_id','cod_aula'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['cod_aula','user_rol_id','nombre'];

}

