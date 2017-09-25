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

//Route::get('/home', 'HomeController@index');

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
            $ofertas = App\Empresa::where('user_id', Auth::user()->id)->first()->ofertas()->get();
            return view('empresas.ofertas')->with('ofertas', $ofertas);
        });

        Route::post('/', 'EmpresasController@ofertas');

        Route::get('/crear', function () {
            $municipios = App\Municipio::orderBy('municipio', 'asc')->get();
            $profesiones = App\Profesione::orderBy('profesione')->get();
            return view('empresas.ofertas_crear')->with(['municipios' => $municipios, 'profesiones' => $profesiones]);
        });
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

        Route::post('/experiencia-laboral', 'CurriculoController@experienciaLaboral');

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
});


