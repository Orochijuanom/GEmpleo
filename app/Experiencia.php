<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
   protected $fillable = ['curriculo_id', 'empresa', 'departamento_id', 'sectore_id', 'cargo', 'area_id', 'inicio', 'fin', 'continua', 'descripcion'];

   public function departamento(){
       return $this->belongsTo('App\Departamento');
   }

   public function sectore(){
       return $this->belongsTo('App\Sectore');
   }

   public function area(){
       return $this->belongsTo('App\Area');
   }
}
