@extends('layouts.empresas')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Oferta {{$oferta->nombre}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        
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

        <div class="x_content">
            @if(count($inscritos) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Nombres</th>
                            <th>Profesión</th>
                            @if($oferta->seleccionados < $oferta->vacantes)
                                <th>Télefono</th>
                            @endif
                            <th>Salario</th>
                            <th>Municipio</th>
                            <th>Prueba Psicotecnica</th>
                            <th>Seleccionado</th>
                            <th>Opciones</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach($inscritos as $inscrito)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$inscrito->curriculo->nombre}} {{$inscrito->curriculo->apellido}}</td>
                                    <td>{{$inscrito->curriculo->profesione->profesione}}</td>
                                    @if($oferta->seleccionados < $oferta->vacantes)
                                        <td>{{$inscrito->curriculo->telefono}}</td>
                                    @endif
                                    
                                    <td>${{$inscrito->curriculo->salario}}</td>
                                    <td>{{$inscrito->curriculo->municipio->municipio}}</td>
                                    <td>
                                        @if(count($inscrito->respuestas) <= 0)
                                            No ha sido respondida
                                        @elseif(count($inscrito->oferta->preguntas) > 0)
                                            <a class="btn btn-warning" href="/empresas/ofertas/inscritos/{{$inscrito->id}}">Ver Respuestas</a>
                                        @else
                                            No se han configurado preguntas
                                        @endif
                                    </td>
                                    <td>
                                        @if($inscrito->seleccionado == 1)
                                            Seleccionado
                                        @else
                                            Postulado
                                        @endif 
                                    </td>
                                    <td>
                                        <form action="/empresas/ofertas/{{$inscrito->oferta->id}}/curriculo/{{$inscrito->curriculo->id}}/seleccionar" method="post" class="form-horizontal form-label-left">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-warning">Seleccionar/De-Seleccionar</button>    
                                        </form>
                                    </td>  
                                </tr>
                            @endforeach
                    </tbody>
            
                
                </table>
            @else
                <div class="alert alert-info alert-dismissible fade in" role="alert">                        
                    <strong>Información!</strong> No se encontraton Ofertas registradas                  
                </div>     
            @endif
                
                
        </div>
    </div>



@endsection