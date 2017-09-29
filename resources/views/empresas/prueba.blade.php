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
    
    <form data-parsley-validate class="form-horizontal form-label-left" role="form"  >               
        <div class="x_panel">
            <div class="x_title">
                <h2>Respuestas</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                
                @if(count($preguntas) > 0)

                    @foreach($preguntas as $pregunta)
                        <div class="form-group{{ $errors->has('pregunta') ? ' has-error' : '' }}">
                            <label for="{{$pregunta->id}}" >{{$pregunta->descripcion}}</label><span class="required">*</span>

                            @if(count($pregunta->opciones) > 0)
                                @foreach($pregunta->opciones as $opcion)
                                    <div>
                                        {{$opcion->descripcion}} 
                                        <input 
                                            @foreach($respuestas as $respuesta)
                                                @if($respuesta->pregunta_id == $pregunta->id && $respuesta->opcione_id == $opcion->id)
                                                    checked
                                                @endif
                                            @endforeach
                                         id="{{$pregunta->id}}" type="radio"  name="{{$pregunta->id}}" value="{{$opcion->id}}" required disabled autofocus> 
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
    </div>
    
    </form>                    
@endsection
