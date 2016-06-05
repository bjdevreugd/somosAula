<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class user_excursion extends Model
{
    protected $table = 'user_excursion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','user_rol_id','excursion_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','user_rol_id','excursion_id'];
}
