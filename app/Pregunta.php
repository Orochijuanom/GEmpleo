<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = ['descripcion', 'oferta_id'];

    public function opciones(){
        return $this->hasMany('App\Opcione');
    }
}
