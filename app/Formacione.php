<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formacione extends Model
{
    protected $fillable = ['curriculo_id', 'centro_educativo', 'profesione_id', 'nivele_id', 'inicio', 'fin', 'continua'];

    public function profesione(){
        return $this->belongsTo('App\Profesione');
    }
    
    public function nivele(){
        return $this->belongsTo('App\Nivele');
    }
}
