<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $fillable = ['pregunta_id', 'opcione_id', 'inscrito_id'];
}
