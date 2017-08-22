<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = ['user_id', 'logo', 'nombre', 'nit', 'sectore_id', 'telefono', 'municipio_id', 'direccion', 'descripcion'];
}
