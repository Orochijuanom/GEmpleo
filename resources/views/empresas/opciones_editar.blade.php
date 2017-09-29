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
    
    <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="/empresas/ofertas/preguntas/opciones/editar">
        {{ csrf_field() }}
        {{ method_field('PUT') }}                
        <div class="x_panel">
            <div class="x_title">
                <h2>Opcion {{$opcion->descripcion}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <div class="form-group{{ $errors->has('opcion') ? ' has-error' : '' }}">
                    <label for="opcion" class="control-label col-md-3 col-sm-3 col-xs-12">Opcion</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="opcion" type="text" class="form-control col-md-7 col-xs-12" name="opcion" value="{{$opcion->descripcion}}" required autofocus>
                        <input type="hidden" name="opcion_id" value="{{$opcion->id}}">
                        @if ($errors->has('opcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('opcion') }}</strong>
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
        
    </div>
    
    </form>                    
@endsection
