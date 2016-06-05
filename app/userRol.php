<?php

namespace somosAula;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class userRol extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_rol';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['rol_id', 'user_id','id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['rol_id', 'user_id','id'];


}

