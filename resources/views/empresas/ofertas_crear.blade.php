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
    
    <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="/empresas/ofertas">
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

                <div class="form-group{{ $errors->has('oferta') ? ' has-error' : '' }}">
                    <label for="oferta" class="control-label col-md-3 col-sm-3 col-xs-12">Oferta</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="oferta" type="text" class="form-control col-md-7 col-xs-12" name="oferta" value="{{old('oferta')}}" required autofocus>

                        @if ($errors->has('oferta'))
                            <span class="help-block">
                                <strong>{{ $errors->first('oferta') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('profesion') ? ' has-error' : '' }}">
                    <label for="profesion" class="control-label col-md-3 col-sm-3 col-xs-12">Profesion</label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="profesion" class="form-control col-md-7 col-xs-12" name="profesion" required>
                            @foreach($profesiones as $profesion)
                                <option value="{{$profesion->id}}" @if($profesion->id == old('profesion')) selected @endif>{{$profesion->profesione}}</option>
                            @endforeach
                        </select>
                        

                        @if ($errors->has('profesion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('profesion') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('salario') ? ' has-error' : '' }}">
                    <label for="salario" class="control-label col-md-3 col-sm-3 col-xs-12">Salario</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="salario" type="text" class="form-control col-md-7 col-xs-12" name="salario" value="{{old('salario')}}" required autofocus>

                        @if ($errors->has('salario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('salario') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('municipio') ? ' has-error' : '' }}">
                    <label for="Municipio" class="control-label col-md-3 col-sm-3 col-xs-12">Municipio</label>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="municipio" class="form-control col-md-7 col-xs-12" name="municipio" required>
                            @foreach($municipios as $municipio)
                                <option value="{{$municipio->id}}" @if($municipio->id == old('municipio')) selected @endif>{{$municipio->municipio}}</option>
                            @endforeach
                        </select>
                        

                        @if ($errors->has('municipio'))
                            <span class="help-block">
                                <strong>{{ $errors->first('municipio') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('vacantes') ? ' has-error' : '' }}">
                    <label for="vacantes" class="control-label col-md-3 col-sm-3 col-xs-12">Vacantes</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="vacantes" type="text" class="form-control col-md-7 col-xs-12" name="vacantes" value="{{old('vacantes')}}" required autofocus>

                        @if ($errors->has('vacantes'))
                            <span class="help-block">
                                <strong>{{ $errors->first('vacantes') }}</strong>
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
