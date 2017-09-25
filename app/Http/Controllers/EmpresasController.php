<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Storage;

use App\Empresa;
use App\Municipio;
use App\Curriculo;
use App\Profesione;
use App\OFerta;
use App\Inscrito;

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

    public function personas($letra, $buscador, $busqueda = null){
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        if($empresa == null){
            return redirect('/empresas/informacion');
        }else{
            if(isset($_GET['buscador'])){
                return Redirect::to('/empresas/personas/'.$letra.'/buscador/'.$_GET['buscador'].'/'.$_GET['busqueda']);
            }
            if($letra == 'all'){
                
                if($buscador == 'municipio'){
                    
                    $municipios = Municipio::where('municipio', 'like', '%'.$busqueda.'%')->pluck('id');
                    $curriculos = Curriculo::whereIn('municipio_id', $municipios)->orderBy('nombre', 'asc')->paginate('6');

                }elseif($buscador == 'profesion'){
                    $profesiones = Profesione::where('profesione', 'like', '%'.$busqueda.'%')->pluck('id');
                    $curriculos = Curriculo::whereIn('profesione_id', $profesiones)->orderBy('nombre', 'asc')->paginate('6');
                }elseif($buscador == 'salario'){
                    $curriculos = Curriculo::where('salario', '<', $busqueda)->orderBy('nombre', 'asc')->paginate('6');
                }else{
                    $curriculos = Curriculo::orderBy('nombre', 'asc')->paginate('6');
                }
            }else{
                if($buscador == 'municipio'){
                    
                    $municipios = Municipio::where('municipio', 'like', '%'.$busqueda.'%')->pluck('id');
                    $curriculos = Curriculo::where('nombre', 'like', $letra.'%')->whereIn('municipio_id', $municipios)->orderBy('nombre', 'asc')->paginate('6');

                }elseif($buscador == 'profesion'){
                    $profesiones = Profesione::where('profesione', 'like', '%'.$busqueda.'%')->pluck('id');
                    $curriculos = Curriculo::where('nombre', 'like', $letra.'%')->whereIn('profesione_id', $profesiones)->orderBy('nombre', 'asc')->paginate('6');
                }elseif($buscador == 'salario'){
                    $curriculos = Curriculo::where('nombre', 'like', $letra.'%')->where('salario', '<', $busqueda)->orderBy('nombre', 'asc')->paginate('6');
                }else{
                    $curriculos = Curriculo::where('nombre', 'like', $letra.'%')->orderBy('nombre', 'asc')->paginate('6');
                }
                

            }
            
            
            return view('empresas.personas')->with(['curriculos' => $curriculos, 'letra' => $letra, 'buscador' => $buscador, 'busqueda' => $busqueda]);
        }
    }

    public function ofertas(Request $request){
        $this->validate($request, [
            'oferta' =>'required',
            'salario' => 'required|numeric',
            'vacantes' => 'required|numeric'
        ]);

        try{
            $oferta = Oferta::create([
                'empresa_id' => Auth::user()->empresa->id,
                'descripcion' => $request->oferta, 
                'profesione_id' => $request->profesion,
                'salario' => $request->salario,
                'municipio_id' => $request->municipio,
                'vacantes' => $request->vacantes
            ]);

            return redirect('/empresas/ofertas')->with('message', 'La oferta laboral ha sido creada con exito');
        }catch(\PDOException $e){
            
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
            }


    }

    public function ofertaInscripcion(Request $request){
        $inscrito = Inscrito::where('oferta_id', $request->oferta)->where('curriculo_id', $request->curriculo)->first();
        
        if($inscrito){
            return redirect()->back()->withErrors(['message' => 'Esta persona ya esta registrada para la oferta']);
        }else{
            Inscrito::create([
                'curriculo_id' => $request->curriculo,
                'oferta_id' => $request->oferta
            ]);

            return redirect()->back()->with('message', 'Curriculo inscrito para  la oferta');
        }
    }
}
