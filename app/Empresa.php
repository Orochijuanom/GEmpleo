<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['user_id', 'logo', 'nombre', 'nit', 'sectore_id', 'telefono', 'municipio_id', 'direccion', 'descripcion', 'representante'];

    protected $appends = ['vistas'];

    public function vistas(){
        return $this->hasMany('App\Vista');
    }

    public function ofertas(){
        return $this->hasMany('App\Oferta');
    }

    public function getVistasAttribute(){
        return $this->vistas()->whereRaw('month(created_at) = '.date('n'))->count('id');
    }
}
