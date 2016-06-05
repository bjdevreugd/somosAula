<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class user_tarea extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_tarea';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_rol_id','tarea_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','user_rol_id','tarea_id'];
}
