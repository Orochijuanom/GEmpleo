@extends('layouts.personas')

@section('content')

<div class="x_panel">
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
    <div class="x_title">
        <h2>Formación</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form class="form-horizontal" role="form" method="POST" action="/personas/curriculo/formacion/{{$formacione->id}}/edit">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group{{ $errors->has('centro_educativo') ? ' has-error' : '' }}">
                <label for="centro_educativo" class="control-label col-md-3 col-sm-3 col-xs-12">Centro educativo</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="centro_educativo" type="text" class="form-control col-md-7 col-xs-12" name="centro_educativo" value="{{$formacione->centro_educativo}}" required>

                    @if ($errors->has('centro_educativo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('centro_educativo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('profesione_id') ? ' has-error' : '' }}">
                <label for="profesione_id" class="control-label col-md-3 col-sm-3 col-xs-12">Profesión</label><span class="required">*</span>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="profesione_id" class="form-control col-md-7 col-xs-12" name="profesione_id" required>
                        @foreach($profesiones as $profesion)
                            <option value="{{$profesion->id}}" @if(isset($formacione)) @if($formacione->profesione_id == $profesion->id) selected @endif @endif>{{$profesion->profesione}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('profesione_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('profesione_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('nivele_id') ? ' has-error' : '' }}">
                <label for="nivele_id" class="control-label col-md-3 col-sm-3 col-xs-12">Nivel educaativo</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="nivele_id" class="form-control col-md-7 col-xs-12" name="nivele_id" required>
                        @foreach($niveles as $nivel)
                            <option value="{{$nivel->id}}" @if($nivel->id == $formacione->nivele_id) selected @endif>{{$nivel->nivel}}</option>
                        @endforeach
                    </select>
                    

                    @if ($errors->has('nivele_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nivele_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('inicio') ? ' has-error' : '' }}">
                <label for="inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Inicio</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="inicio" type="date" class="form-control col-md-7 col-xs-12" name="inicio" value="{{$formacione->inicio}}" required>

                    @if ($errors->has('inicio'))
                        <span class="help-block">
                            <strong>{{ $errors->first('inicio') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('fin') ? ' has-error' : '' }}">
                <label for="fin" class="control-label col-md-3 col-sm-3 col-xs-12">Fin</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="fin" type="date" class="form-control col-md-7 col-xs-12" name="fin" value="{{$formacione->fin}}">

                    @if ($errors->has('fin'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fin') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('continua') ? ' has-error' : '' }}">
                <label for="continua" class="control-label col-md-3 col-sm-3 col-xs-12">Continua</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="continua" type="checkbox" class="checkbox" value="1" name="continua"  @if($formacione->continua == 1) checked @endif>

                    @if ($errors->has('continua'))
                        <span class="help-block">
                            <strong>{{ $errors->first('continua') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                     

            <div class="form-group">
                <div class="col-md-8 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">
                        Editar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection