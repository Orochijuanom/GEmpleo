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
        <h2>Editar experiencia laboral</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="/personas/curriculo/experiencia-laboral/{{$experiencia->id}}/edit">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
                <label for="empresa" class="control-label col-md-3 col-sm-3 col-xs-12">Empresa</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="empresa" type="text" class="form-control col-md-7 col-xs-12" name="empresa" value="{{$experiencia->empresa}}" required>

                    @if ($errors->has('empresa'))
                        <span class="help-block">
                            <strong>{{ $errors->first('empresa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('departamento_id') ? ' has-error' : '' }}">
                <label for="departamento_id" class="control-label col-md-3 col-sm-3 col-xs-12">Departamento</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="departamento_id" class="form-control col-md-7 col-xs-12" name="departamento_id" required>
                        @foreach($departamentos as $departamento)
                            <option value="{{$departamento->id}}" @if($departamento->id == $experiencia->departamento_id) selected @endif>{{$departamento->departamento}}</option>
                        @endforeach
                    </select>
                    

                    @if ($errors->has('departamento_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('departamento_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('sectore_id') ? ' has-error' : '' }}">
                <label for="sectore_id" class="control-label col-md-3 col-sm-3 col-xs-12">Sector de la empresa</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="sectore_id" class="form-control col-md-7 col-xs-12" name="sectore_id" required>
                        @foreach($sectores as $sector)
                            <option value="{{$sector->id}}" @if($sector->id == $experiencia->sectore_id) selected @endif>{{$sector->sector}}</option>
                        @endforeach
                    </select>
                    

                    @if ($errors->has('sectore_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sectore_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                <label for="cargo" class="control-label col-md-3 col-sm-3 col-xs-12">Cargo</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="cargo" type="text" class="form-control col-md-7 col-xs-12" name="cargo" value="{{$experiencia->cargo}}" required>

                    @if ($errors->has('cargo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('area_id') ? ' has-error' : '' }}">
                <label for="area_id" class="control-label col-md-3 col-sm-3 col-xs-12">Area de la empresa</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="area_id" class="form-control col-md-7 col-xs-12" name="area_id" required>
                        @foreach($areas as $area)
                            <option value="{{$area->id}}" @if($area->id == $experiencia->area_id) selected @endif>{{$area->area}}</option>
                        @endforeach
                    </select>
                    

                    @if ($errors->has('area_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('area_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('inicio') ? ' has-error' : '' }}">
                <label for="inicio" class="control-label col-md-3 col-sm-3 col-xs-12">Inicio</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="inicio" type="date" class="form-control col-md-7 col-xs-12" name="inicio" value="{{$experiencia->inicio}}" required>

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
                    <input id="fin" type="date" class="form-control col-md-7 col-xs-12" name="fin" value="{{$experiencia->fin}}">

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
                    <input id="continua" type="checkbox" class="checkbox" value="1" name="continua"  @if($experiencia->continua == 1) checked @endif>

                    @if ($errors->has('continua'))
                        <span class="help-block">
                            <strong>{{ $errors->first('continua') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="descripcion" class="form-control col-md-7 col-xs-12" name="descripcion" required>{{$experiencia->descripcion}}</textarea>
                    @if ($errors->has('descripcion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('descripcion') }}</strong>
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
