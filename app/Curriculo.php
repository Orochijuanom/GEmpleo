<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Curriculo extends Model
{
    protected $fillable = ['user_id', 'nombre', 'apellido', 'identificacione_id', 'numero_identificacion', 'fecha_nacimiento', 'estado_id', 'telefono', 'municipio_id', 'direccion', 'paise_id', 'discapacidad', 'foto', 'video', 'profesione_id', 'descripcion', 'situacione_id', 'salario', 'disponibilidad_viajar', 'disponibilidad_cambio_residencia'];
    protected $appends = ['profesion'];
    protected $dates = [
        'fecha_nacimiento'
    ];

    public function identificacione(){
        return $this->belongsTo('App\Identificacione');
    }

    public function municipio(){
        return $this->belongsTo('App\Municipio');
    }

    public function profesione(){
        return $this->belongsTo('App\Profesione');
    }

    public function situacione(){
        return $this->belongsTo('App\Situacione');
    }

    public function getProfesionAttribute(){
        return $this->profesione;
    }
    
}
