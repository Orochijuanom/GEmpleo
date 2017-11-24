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
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Ver</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Cargar</a>
                </li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    @if(count($formaciones) > 0)
                        <ul class="list-unstyled timeline">
                            @foreach($formaciones as $formacion)
                                 <li>
                                    <div class="block">
                                        
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>{{$formacion->profesione->profesione}} en {{$formacion->centro_educativo}}</a>
                                            </h2>
                                            <div class="byline">
                                                <span>{{$formacion->inicio}} a @if($formacion->continua == 1) actualmente @else {{$formacion->fin}} @endif</span>
                                            </div>
                                            <p class="excerpt">
                                                <strong>Nivel Educativo:</strong> {{$formacion->nivele->nivel}}
                                            </p>
                                            <p>
                                                <a class="btn btn-primary" href="/personas/curriculo/formacion/{{$formacion->id}}">Editar</a>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="alert alert-danger">
                            No se encuentra su experiencia laboral, por favor haga click en la pestaña cargar y realice el proceso
                        </div>
                    @endif
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <form class="form-horizontal" role="form" method="POST" action="/personas/curriculo/formacion">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('centro_educativo') ? ' has-error' : '' }}">
                            <label for="centro_educativo" class="control-label col-md-3 col-sm-3 col-xs-12">Centro educativo</label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="centro_educativo" type="text" class="form-control col-md-7 col-xs-12" name="centro_educativo" value="{{old('centro_educativo')}}" required>

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

                        <div class="form-group{{ $errors->has('nivele_id') ? ' has-error' : '' }}">
                            <label for="nivele_id" class="control-label col-md-3 col-sm-3 col-xs-12">Nivel educaativo</label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="nivele_id" class="form-control col-md-7 col-xs-12" name="nivele_id" required>
                                    @foreach($niveles as $nivel)
                                        <option value="{{$nivel->id}}" @if($nivel->id == old('nivele_id')) @endif>{{$nivel->nivel}}</option>
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
                                <input id="inicio" type="date" class="form-control col-md-7 col-xs-12" name="inicio" value="{{old('inicio')}}" required>

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
                                <input id="fin" type="date" class="form-control col-md-7 col-xs-12" name="fin" value="{{old('fin')}}">

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
                                <input id="continua" type="checkbox" class="checkbox" value="1" name="continua"  @if(old('continua') == 1) checked @endif>

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
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
                
    </div>
</div>                       

@endsection
