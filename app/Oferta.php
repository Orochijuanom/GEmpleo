<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = ['descripcion', 'empresa_id', 'profesione_id', 'salario', 'municipio_id', 'vacantes'];

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }

    public function profesione(){
        return $this->belongsTo('App\Profesione');
    }

    public function municipio(){
        return $this->belongsTo('App\Municipio');
    }
    
    public function inscritos(){
        return $this->hasMany('App\Inscrito');
    }
}
