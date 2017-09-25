<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    protected $fillable = ['curriculo_id', 'oferta_id', 'seleccionado'];

    public function curriculo(){
        return $this->belongsTo('App\Curriculo');
    }

    public function oferta(){
        return $this->belongsTo('App\Oferta');
    }
}
