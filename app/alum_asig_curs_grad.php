<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class alum_asig_curs_grad extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alum_asig_curs_grad';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_rol_id', 'asig_curs_grad_id','id','nota','descripcion'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['user_rol_id', 'asig_curs_grad_id','id','nota','descripcion'];

}
