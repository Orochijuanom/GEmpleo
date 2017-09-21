@extends('layouts.admin')

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
    <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" enctype="multipart/form-data" action="/administrador/empresas/vistas">
        {{ csrf_field() }}                
        <div class="x_panel">
            <div class="x_title">
                <h2>Vistas mensuales {{$empresa->nombre}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                    <label for="nombre" class="control-label col-md-3 col-sm-3 col-xs-12">Nº de vistas</label><span class="required">*</span>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="vistas" type="text" class="form-control col-md-7 col-xs-12" name="vistas" value="@if(isset($empresa->limite)){{$empresa->limite}}@else{{old('vistas')}}@endif" required autofocus>
                        <input type="hidden" name="empresa_id" value="{{$empresa->id}}">
                        @if ($errors->has('vistas'))
                            <span class="help-block">
                                <strong>{{ $errors->first('vistas') }}</strong>
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
