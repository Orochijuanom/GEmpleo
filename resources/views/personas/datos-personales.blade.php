@extends('layouts.personas')

@section('content')

    @if (Session::get('message'))
        <div class="alert alert-success">
            {{Session::get('message')}}
            <br><br>			
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hubo Algunos problemas con tu entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" enctype="multipart/form-data" action="/personas/curriculo/datos-personales">
        {{ csrf_field() }}                
        <div class="x_panel">
            <div class="x_title">
                <h2>Datos Personales</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                    <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="foto" type="file" class="form-control col-md-7 col-xs-12" name="foto">
                            @if(isset($curriculo->foto))
                                <img src="{{$curriculo->foto}}"  width="150px"/>
                            @endif

                            @if ($errors->has('foto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('foto') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nombre" type="text" class="form-control col-md-7 col-xs-12" name="nombre" value="@if(isset($curriculo->nombre)){{$curriculo->nombre}}@else{{old('nombre')}}@endif" required autofocus>

                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                    <label for="apellido" class="control-label col-md-3 col-sm-3 col-xs-12">Apellido</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="apellido" type="text" class="form-control col-md-7 col-xs-12" name="apellido" value="@if(isset($curriculo->apellido)){{$curriculo->apellido}}@else{{old('apellido')}}@endif" required>

                        @if ($errors->has('apellido'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellido') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('identificacione_id') ? ' has-error' : '' }}">
                    <label for="identificacione_id" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de identificacion</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="identificacione_id" class="form-control col-md-7 col-xs-12" name="identificacione_id" required>
                            @foreach($identificaciones as $identificacion)
                                <option value="{{$identificacion->id}}" @if(isset($curriculo)) @if($curriculo->identificacione_id == $identificacion->id) selected @endif @else @if($identificacion->id == old('identificacione_id')) selected @endif @endif>{{$identificacion->identificacion}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('identificacione_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('identificacione_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('numero_identificacion') ? ' has-error' : '' }}">
                    <label for="numero_identificacion" class="control-label col-md-3 col-sm-3 col-xs-12">Número de identificación</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="numero_identificacion" type="text" class="form-control col-md-7 col-xs-12" name="numero_identificacion" value="@if(isset($curriculo->numero_identificacion)){{$curriculo->numero_identificacion}}@else{{old('numero_identificacion')}}@endif" required>

                        @if ($errors->has('numero_identificacion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('numero_identificacion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            
                <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                    <label for="fecha_nacimiento" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de nacimiento</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="fecha_nacimiento" type="date" class="form-control col-md-7 col-xs-12" name="fecha_nacimiento" value="@if(isset($curriculo->fecha_nacimiento)){{$curriculo->fecha_nacimiento->format('Y-m-d')}}@else{{old('fecha_nacimiento')}}@endif" required>

                        @if ($errors->has('fecha_nacimiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('estado_id') ? ' has-error' : '' }}">
                    <label for="estado_id" class="control-label col-md-3 col-sm-3 col-xs-12">Estado civil</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="estado_id" class="form-control col-md-7 col-xs-12" name="estado_id" required>
                            @foreach($estados as $estado)
                                <option value="{{$estado->id}}" @if(isset($curriculo)) @if($curriculo->estado_id == $estado->id) selected @endif @else @if($estado->id == old('estado_id')) @endif @endif>{{$estado->estado}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('estado_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estado_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                    <label for="telefono" class="control-label col-md-3 col-sm-3 col-xs-12">Télefono</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="telefono" type="text" class="form-control col-md-7 col-xs-12" name="telefono" value="@if(isset($curriculo->telefono)){{$curriculo->telefono}}@else{{old('telefono')}}@endif" required>

                        @if ($errors->has('telefono'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telefono') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('municipio_id') ? ' has-error' : '' }}">
                    <label for="municipio_id" class="control-label col-md-3 col-sm-3 col-xs-12">Municipio</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="municipio_id" class="form-control col-md-7 col-xs-12" name="municipio_id" required>
                            @foreach($municipios as $municipio)
                                <option value="{{$municipio->id}}" @if(isset($curriculo)) @if($curriculo->municipio_id == $municipio->id) selected @endif @else @if($municipio->id == old('municipio_id')) selected @endif @endif>{{$municipio->municipio}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('municipio_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('municipio_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                    <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="direccion" type="text" class="form-control col-md-7 col-xs-12" name="direccion" value="@if(isset($curriculo->direccion)){{$curriculo->direccion}}@else{{old('direccion')}}@endif" required>

                        @if ($errors->has('direccion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('direccion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('paise_id') ? ' has-error' : '' }}">
                    <label for="paise_id" class="control-label col-md-3 col-sm-3 col-xs-12">Nacionalidad</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="paise_id" class="form-control col-md-7 col-xs-12" name="paise_id" required>
                            @foreach($paises as $pais)
                                <option value="{{$pais->id}}" @if(isset($curriculo)) @if($curriculo->paise_id == $pais->id) selected @endif @else @if($pais->id == old('paise_id')) selected @endif @endif>{{$pais->pais}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('municipio_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('municipio_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('discapacidad') ? ' has-error' : '' }}">
                    <label for="discapacidad" class="control-label col-md-3 col-sm-3 col-xs-12">Discapacidad</label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="discapacidad" type="checkbox" class="checkbox" value="1" name="discapacidad" @if(isset($curriculo->discapacidad)) @if($curriculo->discapacidad == 1) checked @endif @else @if(old('discapacidad') == 1) checked @endif @endif>

                        @if ($errors->has('discapacidad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('discapacidad') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            
            </div>
        </div>

       <div class="x_panel">
            <div class="x_title">
                <h2>Perfil Profesional</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <div class="form-group{{ $errors->has('profesione_id') ? ' has-error' : '' }}">
                    <label for="profesione_id" class="control-label col-md-3 col-sm-3 col-xs-12">Profesión</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="profesione_id" class="form-control col-md-7 col-xs-12" name="profesione_id" required>
                            @foreach($profesiones as $profesion)
                                <option value="{{$profesion->id}}" @if(isset($curriculo)) @if($curriculo->profesione_id == $profesion->id) selected @endif @else @if($profesion->id == old('profesione_id')) selected @endif @endif>{{$profesion->profesione}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('profesione_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('profesione_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción Perfil Profesional</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="descripcion" class="form-control col-md-7 col-xs-12" name="descripcion" required>@if(isset($curriculo->descripcion)){{$curriculo->descripcion}}@else{{old('descripcion')}}@endif</textarea>
                        @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('situacione_id') ? ' has-error' : '' }}">
                    <label for="paise_id" class="control-label col-md-3 col-sm-3 col-xs-12">Situación laboral</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="situacione_id" class="form-control col-md-7 col-xs-12" name="situacione_id" required>
                            @foreach($situaciones as $situacion)
                                <option value="{{$situacion->id}}" @if(isset($curriculo)) @if($curriculo->situacione_id == $situacion->id) selected @endif @else @if(old('situacione_id') == $situacion->id) selected @endif @endif>{{$situacion->situacion}}</option>
                            @endforeach
                        </select>
                        

                        @if ($errors->has('situacione_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('situacione_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('ingles') ? ' has-error' : '' }}">
                    <label for="paise_id" class="control-label col-md-3 col-sm-3 col-xs-12">Nivel de ingles</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="ingles" class="form-control col-md-7 col-xs-12" name="ingles" required>    
                            <option value="bajo" @if(isset($curriculo)) @if($curriculo->ingles == 'bajo') selected @endif @else @if('bajo' == old('ingles')) selected @endif @endif>Bajo</option>
                            <option value="medio" @if(isset($curriculo)) @if($curriculo->ingles == 'medio') selected @endif @else @if('medio' == old('ingles')) selected @endif @endif>Medio</option>
                            <option value="alto" @if(isset($curriculo)) @if($curriculo->ingles == 'alto') selected @endif @else @if('alto' == old('ingles')) selected @endif @endif>Alto</option>


                        </select>

                        @if ($errors->has('ingles'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ingles') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('salario') ? ' has-error' : '' }}">
                    <label for="salario" class="control-label col-md-3 col-sm-3 col-xs-12">Salario</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="salario" type="text" class="form-control col-md-7 col-xs-12" name="salario" value="@if(isset($curriculo->salario)){{$curriculo->salario}}@else{{old('salario')}}@endif" required>

                        @if ($errors->has('salario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('salario') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('disponibilidad_viajar') ? ' has-error' : '' }}">
                    <label for="disponibilidad_viajar" class="control-label col-md-3 col-sm-3 col-xs-12">Disponibilidad para viajar</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="disponibilidad_viajar" type="radio"  name="disponibilidad_viajar" value="1" @if(isset($curriculo->disponibilidad_viajar)) @if($curriculo->disponibilidad_viajar == 1) checked @endif @else @if(old('disponibilidad_viajar') == 1) checked @endif @endif required> Si
                        <input id="disponibilidad_viajar" type="radio"  name="disponibilidad_viajar" value="0" @if(isset($curriculo->disponibilidad_viajar)) @if($curriculo->disponibilidad_viajar == 0) checked @endif @else @if(old('disponibilidad_viajar') == 0) checked @endif @endif required> No

                        @if ($errors->has('disponibilidad_viajar'))
                            <span class="help-block">
                                <strong>{{ $errors->first('disponibilidad_viajar') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('disponibilidad_cambio_residencia') ? ' has-error' : '' }}">
                    <label for="disponibilidad_cambio_residencia" class="control-label col-md-3 col-sm-3 col-xs-12">Disponibilidad cambio de residencia</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="disponibilidad_cambio_residencia" type="radio"  name="disponibilidad_cambio_residencia" value="1" @if(isset($curriculo->disponibilidad_cambio_residencia)) @if($curriculo->disponibilidad_cambio_residencia == 1) checked @endif @else @if(old('disponibilidad_cambio_residencia') == 1) checked @endif @endif required> Si
                        <input id="disponibilidad_cambio_residencia" type="radio"  name="disponibilidad_cambio_residencia" value="0" @if(isset($curriculo->disponibilidad_cambio_residencia)) @if($curriculo->disponibilidad_cambio_residencia == 0) checked @endif @else @if(old('disponibilidad_cambio_residencia') == 0) checked @endif @endif required> No

                        @if ($errors->has('disponibilidad_cambio_residencia'))
                            <span class="help-block">
                                <strong>{{ $errors->first('disponibilidad_cambio_residencia') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_content">
                <br />
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="reset">Limpiar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    
    </form>                    
@endsection