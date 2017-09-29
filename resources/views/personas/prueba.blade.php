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
    
    <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="POST" action="/personas/ofertas/{{$oferta->id}}/prueba">
        {{ csrf_field() }}                
        <div class="x_panel">
            <div class="x_title">
                <h2>Preguntas prueba psicotecnica para la oferta {{$oferta->nombre}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                @if(count($oferta->preguntas) > 0)

                    @foreach($oferta->preguntas as $pregunta)
                        <div class="form-group{{ $errors->has('pregunta') ? ' has-error' : '' }}">
                            <label for="{{$pregunta->id}}" >{{$pregunta->descripcion}}</label><span class="required">*</span>

                            @if(count($pregunta->opciones) > 0)
                                @foreach($pregunta->opciones as $opcion)
                                    <div>
                                        {{$opcion->descripcion}} <input id="{{$pregunta->id}}" type="radio"  name="{{$pregunta->id}}" value="{{$opcion->id}}" required autofocus> 
                                    </div>
                                @endforeach
                                
                            @else
                                <div class="alert alert-info alert-dismissible fade in" role="alert">                        
                                    <strong>Información!</strong> No se encontraton opciones registradas                  
                                </div> 
                            @endif
                            
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info alert-dismissible fade in" role="alert">                        
                        <strong>Información!</strong> No se encontraton preguntas registradas                  
                    </div> 
                @endif

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
