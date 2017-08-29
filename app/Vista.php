<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vista extends Model
{
    protected $fillable = ['empresa_id'];

    public function empresa(){
        return $this->belongsTo('App\Empresa');
    }
}
