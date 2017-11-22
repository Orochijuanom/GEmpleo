<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/registerEmpresa', 'Auth\RegisterController@registerEmpresa');

Route::get('/email/{email}/confirmation_token/{confirmation_token}', function ($email, $confirmation_token) {
    $user = App\User::where('email', $email)->where('confirmation_token', $confirmation_token)->first();
    if($user != null){
        $user->activo = 1;
        $user->confirmation_token = null;
        $user->save();
        return redirect('/login')->with('message', 'El usuario ha sido activado exitosamente.');
    }else{
        return redirect('/login')->withErrors(['error' => 'El proceso de activación ha fallado, por favor póngase en contacto con un administrador.']);
    }
});

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'administrador' , 'middleware' => 'administrador'], function() {
    Route::get('/', function() {
        return view('administrador.dashboard');
    });

    Route::get('/empresas', function () {
        $empresas = App\User::where('tipouser_id', '3')->with('empresa')->orderBy('name', 'asc')->paginate(10);
        return view('administrador.empresas')->with('empresas', $empresas);
    });

    Route::post('/user/activar/{id}', 'AdministradorController@activar');

    Route::get('/personas', function () {
        $personas = App\User::where('tipouser_id', '2')->with('curriculo')->orderBy('name', 'asc')->paginate(10);
        return view('administrador.personas')->with('personas', $personas);
    });

    Route::get('/empresas/{id}', function ($id) {
        $empresa = App\Empresa::find($id);
        
        return view('administrador.vistas')->with('empresa', $empresa);

    });

    Route::post('/empresas/vistas', 'AdministradorController@limite');


});

Route::group(['prefix' => 'empresas' , 'middleware' => 'empresas'], function() {
    Route::get('/', function() {
        return view('empresas.dashboard');
    });

    Route::group(['prefix' => 'informacion'], function() {
        Route::get('/', function() {
            $sectores = App\Sectore::all();
            $departamentos = App\Departamento::all();
            $municipios = App\Municipio::orderBy('municipio', 'asc')->get();
            $informacion = App\Empresa::where('user_id', Auth::user()->id)->first();
            return view('empresas.informacion')->with([
                'sectores' => $sectores,
                'departamentos' => $departamentos,
                'municipios' => $municipios,
                'informacion' => $informacion
            ]);
        });

        Route::post('/', 'EmpresasController@informacion');
    });

    Route::group(['prefix' => 'personas'], function() {
        Route::get('/{letra}/buscador/{buscador}/{busqueda?}', 'EmpresasController@personas');

        Route::get('/{curriculo_id}', function($curriculo_id) {
            $curriculo = App\Curriculo::where('id', $curriculo_id)->first();
            $ofertas = App\Oferta::where('empresa_id', Auth::user()->empresa->id)->get();
            $formaciones = App\Formacione::where('curriculo_id', $curriculo->id)->get();
            $experiencias = App\Experiencia::where('curriculo_id', $curriculo->id)->get();
            
            return view('empresas.curriculo')->with(['curriculo' => $curriculo, 'formaciones' => $formaciones, 'experiencias' => $experiencias, 'ofertas' => $ofertas]);
            
            
        })->middleware('vistas');

        Route::post('/oferta', 'EmpresasController@ofertaInscripcion');
    });

    Route::group(['prefix' => 'ofertas'], function () {
        Route::get('/', function () {
            $empresa = App\Empresa::where('user_id', Auth::user()->id)->first();
            if(!$empresa){
                return redirect('/empresas/informacion');
            }

            $ofertas = $empresa->ofertas()->get();
            return view('empresas.ofertas')->with('ofertas', $ofertas);
        });

        Route::post('/', 'EmpresasController@ofertas');

        Route::get('/crear', function () {
            $municipios = App\Municipio::orderBy('municipio', 'asc')->get();
            $profesiones = App\Profesione::orderBy('profesione')->get();
            return view('empresas.ofertas_crear')->with(['municipios' => $municipios, 'profesiones' => $profesiones]);
        });

        Route::get('/{oferta_id}/inscritos', function ($id) {
            $oferta = App\Oferta::find($id);
            $inscritos = $oferta->inscritos()->with('curriculo')->get();
            return view('empresas.inscritos')->with(['oferta' => $oferta, 'inscritos' => $inscritos]);
        });

        Route::get('/inscritos/{inscrito_id}', function ($id) {
            $inscrito = App\Inscrito::find($id);
            $preguntas = $inscrito->oferta->preguntas()->get();
            $respuestas = $inscrito->respuestas()->get();

            return view('empresas.prueba')->with(['preguntas' => $preguntas, 'respuestas' => $respuestas]);
        });

        Route::post('/{oferta_id}/curriculo/{curriculo_id}/seleccionar', 'EmpresasController@seleccionar');

        Route::get('/{oferta_id}/preguntas', function ($id) {
            $oferta = App\Oferta::find($id);
            $preguntas = App\Pregunta::where('oferta_id', $id)->get();
            return view('empresas.preguntas')->with(['oferta' => $oferta, 'preguntas' => $preguntas]);
        });
        
        Route::post('/preguntas', 'EmpresasController@storePregunta');

        Route::get('/preguntas/{pregunta_id}/opciones', function ($id) {
            $pregunta = App\Pregunta::find($id);
            $opciones = App\Opcione::where('pregunta_id', $id)->get();
            return view('empresas.opciones')->with(['pregunta' => $pregunta, 'opciones' => $opciones]);
        });

        Route::post('/preguntas/opciones', 'EmpresasController@storeOpcion');

        Route::get('/preguntas/{pregunta_id}/editar', function ($id) {
            $pregunta = App\Pregunta::find($id);

            return view('empresas.preguntas_editar')->with('pregunta', $pregunta);
        });

        Route::put('/preguntas/editar', 'EmpresasController@editPregunta');

        Route::get('/preguntas/opciones/{opcion_id}/editar', function ($id) {
            $opcion = App\Opcione::find($id);
            return view('empresas.opciones_editar')->with('opcion', $opcion);
        });

        Route::put('/preguntas/opciones/editar', 'EmpresasController@editOpcion');

    });
});

Route::group(['prefix' => 'personas' , 'middleware' => 'personas'], function() {
    Route::get('/', function() {
        $curriculo = App\Curriculo::where('user_id', Auth::user()->id)->first();
        if($curriculo == null){
            return redirect('/personas/curriculo/datos-personales');
        }else{
            $formaciones = App\Formacione::where('curriculo_id', $curriculo->id)->get();
            $experiencias = App\Experiencia::where('curriculo_id', $curriculo->id)->get();
            return view('personas.perfil')->with(['curriculo' => $curriculo, 'formaciones' => $formaciones, 'experiencias' => $experiencias]);
        }
        
    });

    Route::group(['prefix' => 'curriculo'], function() {

        Route::get('/datos-personales', function() {
            $curriculo = App\Curriculo::where('user_id', Auth::user()->id)->first(); 
            $identificaciones = App\Identificacione::all();
            $estados = App\Estado::all();
            //$licencias = App\Licencia::all();
            $paises = App\Paise::all();
            $departamentos = App\Departamento::all();
            $municipios = App\Municipio::orderBy('municipio', 'asc')->get();
            $profesiones = App\Profesione::orderBy('profesione')->get();
            $situaciones = App\Situacione::all();
            $experiencias = null;
            $formaciones = null;
            if($curriculo){
                $experiencias = App\Experiencia::where('curriculo_id', $curriculo->id)->get();
                $formaciones = App\Formacione::where('curriculo_id', $curriculo->id)->get();
            }
            return view('personas.datos-personales')->with([
                'curriculo' => $curriculo,
                'identificaciones' => $identificaciones,
                'estados' => $estados,
                'paises' => $paises,
                'departamentos' => $departamentos,
                'municipios' => $municipios,
                'profesiones' => $profesiones,
                'situaciones' => $situaciones,
                'experiencias' => $experiencias,
                'formaciones' => $formaciones
            ]);

        });

        Route::post('/datos-personales', 'CurriculoController@datosPersonales');

        Route::get('/video', function() {
            $curriculo = App\Curriculo::where('user_id', Auth::user()->id)->first();
            if($curriculo == null){
                return redirect('/personas/curriculo/datos-personales')->withErrors(['error' => 'Debe Crear su curriculo primero']);

            }
            return view('personas.video')->with('curriculo', $curriculo);
        });

        Route::post('/video', 'CurriculoController@video');

        Route::get('/experiencia-laboral', function(){
            $curriculo = App\Curriculo::where('user_id', Auth::user()->id)->first();
            if($curriculo == null){
                return redirect('/personas/curriculo/datos-personales')->withErrors(['error' => 'Debe Crear su curriculo primero']);

            }
            $experiencias = App\Experiencia::where('curriculo_id', $curriculo->id)->get();
            $departamentos = App\Departamento::orderBy('departamento')->get();
            $sectores = App\Sectore::all();
            $areas = App\Area::all();
            return view('personas.experiencia-laboral')->with([
                'experiencias' => $experiencias, 
                'departamentos' => $departamentos, 
                'sectores' => $sectores, 'areas' => $areas
            ]);

        });

        Route::get('/experiencia-laboral/{id}', function ($id) {
            $experiencia = App\Experiencia::where('id', $id)->first();
            $departamentos = App\Departamento::orderBy('departamento')->get();
            $sectores = App\Sectore::all();
            $areas = App\Area::all();
            return view('personas.experiencia-laboral-edit')->with([
                'experiencia' => $experiencia, 
                'departamentos' => $departamentos, 
                'sectores' => $sectores, 'areas' => $areas
            ]);
        });

        Route::post('/experiencia-laboral', 'CurriculoController@experienciaLaboral');

        Route::put('/experiencia-laboral/{id}/edit', 'CurriculoController@experienciaLaboralEdit');
        
        Route::get('/formacion', function(){
        $curriculo = App\Curriculo::where('user_id', Auth::user()->id)->first();
        if($curriculo == null){
            return redirect('/personas/curriculo/datos-personales')->withErrors(['error' => 'Debe Crear su curriculo primero']);

        }
        $formaciones = App\Formacione::where('curriculo_id', $curriculo->id)->get();
        $profesiones = App\Profesione::orderBy('profesione')->get();
        $niveles = App\Nivele::all();

        return view('personas.formacion')->with([
            'formaciones' => $formaciones,
            'profesiones' => $profesiones,
            'niveles' => $niveles
        ]); 
        });

        Route::post('/formacion', 'CurriculoController@formacion');


        
    
        
    });

    Route::group(['prefix' => 'ofertas'], function () {
        Route::get('/', function () {
            $curriculo = App\Curriculo::where('user_id', Auth::user()->id)->first();
            if($curriculo == null){
                return redirect('/personas/curriculo/datos-personales')->withErrors(['error' => 'Debe Crear su curriculo primero']);

            }
            $ofertas = App\Inscrito::where('curriculo_id', Auth::user()->curriculo->id)->with('oferta')->get();
            return view('personas.ofertas_inscritas')->with('ofertas', $ofertas);
        });
        Route::get('/{letra}/buscador/{buscador}/{busqueda?}', 'CurriculoController@ofertas');
        Route::post('/inscripcion', 'EmpresasController@ofertaInscripcion');

        Route::get('/{oferta_id}/prueba', function ($id) {
            $curriculo = App\Curriculo::where('user_id', Auth::user()->id)->first();
            if($curriculo == null){
                return redirect('/personas/curriculo/datos-personales')->withErrors(['error' => 'Debe Crear su curriculo primero']);

            }
            $oferta = App\Oferta::find($id);
    
            return view('personas.prueba')->with('oferta', $oferta);
        });

        Route::post('/{oferta_id}/prueba', 'CurriculoController@storePrueba');
    });

    


});


