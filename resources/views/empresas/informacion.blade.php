@extends('layouts.empresas')

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
    
    <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" enctype="multipart/form-data" action="/empresas/informacion">
        {{ csrf_field() }}                
        <div class="x_panel">
            <div class="x_title">
                <h2>Información empresarial</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                    <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Logo</label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="logo" type="file" class="form-control col-md-7 col-xs-12" name="logo">
                            @if(isset($informacion->logo))
                                <img src="{{$informacion->logo}}"  width="150px"/>
                            @endif

                            @if ($errors->has('logo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nombre" type="text" class="form-control col-md-7 col-xs-12" name="nombre" value="@if(isset($informacion->nombre)){{$informacion->nombre}}@else{{old('nombre')}}@endif" required autofocus>

                        @if ($errors->has('nombre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('nit') ? ' has-error' : '' }}">
                    <label for="nit" class="control-label col-md-3 col-sm-3 col-xs-12">Nit</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nit" type="text" class="form-control col-md-7 col-xs-12" name="nit" value="@if(isset($informacion->nit)){{$informacion->nit}}@else{{old('nit')}}@endif" required>

                        @if ($errors->has('nit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nit') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('sectore_id') ? ' has-error' : '' }}">
                    <label for="sectore_id" class="control-label col-md-3 col-sm-3 col-xs-12">Sector de la empresa</label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="sectore_id" class="form-control col-md-7 col-xs-12" name="sectore_id" required>
                            @foreach($sectores as $sector)
                                <option value="{{$sector->id}}" @if(isset($informacion)) @if($informacion->sectore_id == $sector->id) selected @endif @else @if($sector->id == old('sectore_id')) @endif @endif>{{$sector->sector}}</option>
                            @endforeach
                        </select>
                        

                        @if ($errors->has('sectore_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('sectore_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                    <label for="telefono" class="control-label col-md-3 col-sm-3 col-xs-12">Télefono</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="telefono" type="text" class="form-control col-md-7 col-xs-12" name="telefono" value="@if(isset($informacion->telefono)){{$informacion->telefono}}@else{{old('telefono')}}@endif" required>

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
                                <option value="{{$municipio->id}}" @if(isset($informacion)) @if($informacion->municipio_id == $municipio->id) selected @endif @else @if($municipio->id == old('municipio_id')) selected @endif @endif>{{$municipio->municipio}}</option>
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
                        <input id="direccion" type="text" class="form-control col-md-7 col-xs-12" name="direccion" value="@if(isset($informacion->direccion)){{$informacion->direccion}}@else{{old('direccion')}}@endif" required>

                        @if ($errors->has('direccion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('direccion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                    <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción de la Empresa</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="descripcion" class="form-control col-md-7 col-xs-12" name="descripcion" required>@if(isset($informacion->descripcion)){{$informacion->descripcion}}@else{{old('descripcion')}}@endif</textarea>
                        @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
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
