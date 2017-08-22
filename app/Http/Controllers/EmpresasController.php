<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Storage;

use App\Empresa;

class EmpresasController extends Controller
{
    public function informacion(Request $request){

        $this->validate($request, [
            'foto' => 'nullable|file|image|dimensions:max_width:150',
            'nombre' => 'required',
            'nit' => 'required',
            'sectore_id' => 'required|numeric',
            'telefono' => 'required',
            'municipio_id' => 'required|numeric',
            'direccion' => 'required',
            'descripcion' => 'required',
        ]);

        $informacion = Empresa::where('user_id', Auth::user()->id)->first();

        try{
            if($request->file('logo') != null){
                $filename = $request->file('logo')->getClientOriginalName();
        
                $image_path = '/generandoempleo/user'.Auth::user()->id.'/foto/foto.jpg';
                
                Storage::put($image_path, file_get_contents($request->file('logo'), 'public'));
            }
            
            $image_path = '/generandoempleo/user'.Auth::user()->id.'/foto/foto.jpg';
            
        }catch(Exeption $e){
            return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y no se ha podido cargar la imagen']);
        }

        $image_path = 'https://s3-sa-east-1.amazonaws.com/generandoempleo'.$image_path;

        if(!$informacion){
            try{
                Empresa::create([
                    'user_id' => Auth::user()->id,
                    'logo' => $image_path,
                    'nombre' => $request['nombre'],
                    'nit' => $request['nit'],
                    'sectore_id' => $request['sectore_id'],
                    'telefono' => $request['telefono'],
                    'municipio_id' => $request['municipio_id'],
                    'direccion' => $request['direccion'],
                    'descripcion' => $request['descripcion']
                ]);

                return redirect()->back()->with('message', 'Sus datos personales han sido almacenados con exito');

            }catch(\PDOException $e){
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
            }
        }else{
            try{
                    $informacion->user_id = Auth::user()->id;
                    $informacion->logo = $image_path;
                    $informacion->nombre = $request['nombre'];
                    $informacion->nit = $request['nit'];
                    $informacion->sectore_id = $request['sectore_id'];
                    $informacion->telefono = $request['telefono'];
                    $informacion->municipio_id = $request['municipio_id'];
                    $informacion->direccion = $request['direccion'];
                    $informacion->descripcion = $request['descripcion'];
                    $informacion->save();

                    return redirect()->back()->with('message', 'Sus datos personales han sido almacenados con exito');

            }catch(\PDOException $e){
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
            }

        }
    }
}
