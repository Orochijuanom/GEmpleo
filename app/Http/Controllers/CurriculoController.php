<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Storage;
use Redirect;

use App\Curriculo;
use App\Experiencia;
use App\Formacione;
use App\Oferta;
use App\Profesione;
use App\Municipio;

class CurriculoController extends Controller
{
    public function datosPersonales(Request $request){
        
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'identificacione_id' => 'required|numeric',
            'numero_identificacion' => 'required|numeric',
            'fecha_nacimiento' => 'required|date',
            'estado_id' => 'required|numeric',
            'telefono' => 'required',
            'municipio_id' => 'required|numeric',
            'direccion' => 'required',
            'paise_id' => 'required',
            'discapacidad' => 'nullable|boolean',
            'foto' => 'nullable|file|image|dimensions:max_width:150',
            'profesione_id' => 'required',
            'descripcion' => 'required',
            'situacione_id' => 'required|numeric',
            'salario' => 'required|numeric',
            'disponibilidad_viajar' => 'required|boolean',
            'disponibilidad_cambio_residencia' => 'required|boolean'    
        ]);

        try{
            if($request->file('foto') != null){
                $filename = $request->file('foto')->getClientOriginalName();
            
                $image_path = '/generandoempleo/user'.Auth::user()->id.'/foto/foto.jpg';
                
                Storage::put($image_path, file_get_contents($request->file('foto'), 'public'));
                
                //$image_path = $request->file('foto')->storeAs('user'.Auth::user()->id.'_imagen', 'foto_'.Auth::user()->id.'.'.$extension);
            }

            $image_path = '/generandoempleo/user'.Auth::user()->id.'/foto/foto.jpg';
        }catch(Exeption $e){
            return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y no se ha podido cargar la imagen']);
        }

        $image_path = 'https://s3-sa-east-1.amazonaws.com/generandoempleo'.$image_path;

        
        try{
            Curriculo::updateOrCreate(
                [
                    'user_id' => Auth::user()->id,
                ],
                [
                    'nombre' => $request['nombre'],
                    'apellido' => $request['apellido'],
                    'identificacione_id' => $request['identificacione_id'],
                    'numero_identificacion' => $request['numero_identificacion'],
                    'fecha_nacimiento' => $request['fecha_nacimiento'],
                    'estado_id' => $request['estado_id'],
                    'telefono' => $request['telefono'],
                    'municipio_id' => $request['municipio_id'],
                    'direccion' => $request['direccion'],
                    'paise_id' => $request['paise_id'],
                    'discapacidad' => $request['discapacidad'],
                    'foto' => $image_path,
                    'profesione_id' => $request['profesione_id'],
                    'descripcion' => $request['descripcion'],
                    'situacione_id' => $request['situacione_id'],
                    'salario' => $request['salario'],
                    'disponibilidad_viajar' => $request['disponibilidad_viajar'],
                    'disponibilidad_cambio_residencia' => $request['disponibilidad_cambio_residencia']
                ]
            );
            
            return redirect()->back()->with('message', 'Sus datos personales han sido almacenados con exito');

        }catch(\PDOException $e){
            return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }

                
        

        
    }

    public function video(Request $request){
        $curriculo = Curriculo::where('user_id', Auth::user()->id)->first();

        
        $this->validate($request, [
            'video' => 'required|file|mimetypes:video/webm',
            ]);

        try{
            $filename = $request->file('video')->getClientOriginalName();
           
            
            $video_path = '/generandoempleo/user'.Auth::user()->id.'/video/'.$filename;

            Storage::put($video_path, file_get_contents($request->file('video'), 'public'));
            
        }catch(Exeption $e){
            return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y no se ha podido cargar la imagen']);
        }

        $video_path = 'https://s3-sa-east-1.amazonaws.com/generandoempleo'.$video_path;

        try{
              
                $curriculo->video = $video_path;
                
                $curriculo->save();
                
                return redirect()->back()->with('message', 'Sus video  han sido almacenado con exito');

            }catch(\PDOException $e){
                
                return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
            }
            
    }

    public function experienciaLaboral(Request $request){
        $this->validate($request, [
            'empresa' => 'required',
            'departamento_id' => 'required|numeric',
            'sectore_id' => 'required|numeric',
            'cargo' => 'required',
            'area_id' => 'required|numeric',
            'inicio' => 'required|date',
            'fin' => 'nullable|date',
            'descripcion' => 'required'
        ]);

        $curriculo = Curriculo::where('user_id', Auth::user()->id)->first();

        try{
            Experiencia::create([
                'curriculo_id' => $curriculo->id,
                'empresa' => $request['empresa'],
                'departamento_id' => $request['departamento_id'],
                'sectore_id' => $request['sectore_id'],
                'cargo' => $request['cargo'],
                'area_id' => $request['area_id'],
                'inicio' => $request['inicio'],
                'fin' => $request['fin'],
                'continua' => $request['continua'],
                'descripcion' => $request['descripcion']
            ]);

        }catch(\PDOException $e){
            return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }

        return redirect()->back()->with('message', 'Sus datos personales han sido almacenados con exito')->withInput();
    }

    public function formacion(Request $request){
        $this->validate($request, [
            'centro_educativo' => 'required',
            'profesione_id' => 'required',
            'nivele_id' => 'required|numeric',
            'inicio' => 'required|date',
            'fin' => 'nullable|date'
        ]);

        $curriculo = Curriculo::where('user_id', Auth::user()->id)->first();

        try{
            Formacione::create([
                'curriculo_id' => $curriculo->id,
                'centro_educativo' => $request['centro_educativo'],
                'profesione_id' => $request['profesione_id'],
                'nivele_id' => $request['nivele_id'],
                'inicio' => $request['inicio'],
                'fin' => $request['fin'],
                'continua' => $request['continua'],
            ]);

        }catch(\PDOException $e){
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Ha ocurrido un error y sus datos no se han podido guardar']);
        }

        return redirect()->back()->with('message', 'Sus datos personales han sido almacenados con exito');
    
    }

    public function ofertas($letra, $buscador, $busqueda = null){
        $curriculo = Curriculo::where('user_id', Auth::user()->id)->first();
        if($curriculo == null){
            return redirect('/personas/curriculo/datos-personales');
        }else{
            if(isset($_GET['buscador'])){
                return Redirect::to('/personas/ofertas/'.$letra.'/buscador/'.$_GET['buscador'].'/'.$_GET['busqueda']);
            }
            if($letra == 'all'){
                
                if($buscador == 'municipio'){
                    
                    $municipios = Municipio::where('municipio', 'like', '%'.$busqueda.'%')->pluck('id');
                    $ofertas = Oferta::whereIn('municipio_id', $municipios)->orderBy('descripcion', 'asc')->paginate('6');

                }elseif($buscador == 'profesion'){
                    $profesiones = Profesione::where('profesione', 'like', '%'.$busqueda.'%')->pluck('id');
                    $ofertas = Oferta::whereIn('profesione_id', $profesiones)->orderBy('descripcion', 'asc')->paginate('6');
                }elseif($buscador == 'salario'){
                    $ofertas = Oferta::where('salario', '<', $busqueda)->orderBy('descripcion', 'asc')->paginate('6');
                }else{
                    $ofertas = Oferta::orderBy('descripcion', 'asc')->paginate('6');
                }
            }else{
                if($buscador == 'municipio'){
                    
                    $municipios = Municipio::where('municipio', 'like', '%'.$busqueda.'%')->pluck('id');
                    $ofertas = Oferta::where('descripcion', 'like', $letra.'%')->whereIn('municipio_id', $municipios)->orderBy('descripcion', 'asc')->paginate('6');

                }elseif($buscador == 'profesion'){
                    $profesiones = Profesione::where('profesione', 'like', '%'.$busqueda.'%')->pluck('id');
                    $ofertas = Oferta::where('descripcion', 'like', $letra.'%')->whereIn('profesione_id', $profesiones)->orderBy('descripcion', 'asc')->paginate('6');
                }elseif($buscador == 'salario'){
                    $ofertas = Oferta::where('descripcion', 'like', $letra.'%')->where('salario', '<', $busqueda)->orderBy('descripcion', 'asc')->paginate('6');
                }else{
                    $ofertas = Oferta::where('descripcion', 'like', $letra.'%')->orderBy('descripcion', 'asc')->paginate('6');
                }
                

            }
            
            
            return view('personas.ofertas')->with(['ofertas' => $ofertas, 'letra' => $letra, 'buscador' => $buscador, 'busqueda' => $busqueda]);
        }

    }
}
