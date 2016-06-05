<?php

namespace somosAula;

use Illuminate\Database\Eloquent\Model;

class excursion extends Model
{
    protected $table = 'excursion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','titulo','descripcion','importe','fecha_excursion'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id','titulo','descripcion','importe','fecha_excursion'];
}
