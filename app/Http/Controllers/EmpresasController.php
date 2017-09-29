<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Storage;
use Redirect;

use App\Empresa;
use App\Municipio;
use App\Curriculo;
use App\Profesione;
use App\Oferta;
use App\Inscrito;
use App\Pregunta;
use App\Opcione;

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
            'vacantes' => 'required|numeric',
            'descripcion' => 'required'
        ]);

        try{
            $oferta = Oferta::create([
                'empresa_id' => Auth::user()->empresa->id,
                'nombre' => $request->oferta, 
                'profesione_id' => $request->profesion,
                'salario' => $request->salario,
                'municipio_id' => $request->municipio,
                'vacantes' => $request->vacantes,
                'descripcion' => $request->descripcion
            ]);

            return redirect('/empresas/ofertas')->with('message', 'La oferta laboral ha sido creada con exito');
        }catch(\PDOException $e){
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }


    }

    public function ofertaInscripcion(Request $request){
        $inscrito = Inscrito::where('oferta_id', $request->oferta)->where('curriculo_id', $request->curriculo)->first();
        
        if($inscrito){
            return redirect()->back()->withErrors(['message' => 'Ya se encuentra inscrito para la oferta']);
        }else{
            Inscrito::create([
                'curriculo_id' => $request->curriculo,
                'oferta_id' => $request->oferta
            ]);

            return redirect()->back()->with('message', 'Se ha inscrito para  la oferta');
        }
    }

    public function seleccionar($oferta_id, $curriculo_id){

        $inscrito = Inscrito::where('oferta_id', $oferta_id)->where('curriculo_id', $curriculo_id)->first();
        
        if($inscrito->seleccionado == 1){
            $inscrito->seleccionado = 0;
        }else{
            if($inscrito->oferta->seleccionados < $inscrito->oferta->vacantes){
                $inscrito->seleccionado = 1;
            }else{
                return redirect()->back()->withErrors(['message' => 'Ya ha alcanzado el numero maximo de personas para esta oferta']);
            }
            
        }

        $inscrito->save();

        return redirect()->back()->with('message', 'El estado de seleccion de la persona '.$inscrito->curriculo->nombre.' '.$inscrito->curriculo->apellido.' ha sido cambiado');
    }

    public function storePregunta(Request $request){
        $this->validate($request,  [
            'pregunta' => 'required',
            'oferta' => 'required',
        ]);

        try{
            Pregunta::create([
                'descripcion' => $request->pregunta,
                'oferta_id' => $request->oferta
            ]);

            return redirect()->back()->with('message', 'La pregunta ha sido creada');

        }catch(\PDOException $e){
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }


    }

    public function storeOpcion(Request $request){
        $this->validate($request,  [
            'opcion' => 'required',
            'pregunta' => 'required',
        ]);

        try{
            Opcione::create([
                'descripcion' => $request->opcion,
                'pregunta_id' => $request->pregunta
            ]);

            return redirect()->back()->with('message', 'La opcion ha sido creada');

        }catch(\PDOException $e){
            return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }


    }

    public function editPregunta(Request $request){
        $this->validate($request,  [
            'pregunta' => 'required',
            'pregunta_id' => 'required',
        ]);

        try{
            $pregunta = Pregunta::find($request->pregunta_id);
            $pregunta->descripcion = $request->pregunta;
            $pregunta->save();

            return redirect()->back()->with('message', 'La pregunta ha sido editada');

        }catch(\PDOException $e){
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }


    }

    public function editOpcion(Request $request){
        $this->validate($request,  [
            'opcion' => 'required',
            'opcion_id' => 'required',
        ]);

        try{
            $opcion = Opcione::find($request->opcion_id);
            $opcion->descripcion = $request->opcion;
            $opcion->save();

            return redirect()->back()->with('message', 'La opcion ha sido editada');

        }catch(\PDOException $e){
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }


    }
}
