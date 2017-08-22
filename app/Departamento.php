<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public function paise(){
        return $this->belongsTo('App\Paise');
    }
}
