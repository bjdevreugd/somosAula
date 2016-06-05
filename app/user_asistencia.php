<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class user_asistencia extends Model
{
    protected $table = 'user_asistencia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_rol_id','asistencia_id','asiste'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','user_rol_id','asistencia_id', 'asiste'];
}
