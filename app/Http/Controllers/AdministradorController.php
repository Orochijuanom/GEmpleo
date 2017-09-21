<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Empresa;

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

    public function limite(Request $request){
        $this->validate($request, [
            'vistas' => 'required',
            'empresa_id' => 'required'
        ]);

        $empresa = Empresa::find($request->empresa_id);
        $empresa->limite = $request->vistas;
        $empresa->save();

        return redirect('/administrador/empresas')->with('message', 'Número de vistas mensuales configuradas'); 
    }
}
