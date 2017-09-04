<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdministradorController extends Controller
{
    public function activar($id){
        $user = User::find($id);
        
        if($user->activo == 1){
            $user->activo = 0;
        }else{
            $user->activo = 1;
        }

        $user->save();

        return redirect()->back()->with('message', 'El estado de activacion del usuario '.$user->name.' ha sido cambiado');
    }
}
