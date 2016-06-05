<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class tutorlegal_hijo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tutorlegal_hijo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tutor_id', 'hijo_id', 'id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['tutor_id', 'hijo_id', 'id'];


}
