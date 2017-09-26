@extends('layouts.empresas')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Ofertas inscritas</h2>
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
            @if(count($ofertas) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Oferta</th>
                            <th>Profesión</th>
                            <th>Salario</th>
                            <th>Municipio</th>
                            <th>Vacantes Restantes</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach($ofertas as $oferta)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$oferta->oferta->nombre}}</td>
                                    <td>{{$oferta->oferta->profesione->profesione}}</td>
                                    <td>${{$oferta->oferta->salario}}</td>
                                    <td>{{$oferta->oferta->municipio->municipio}}</td>
                                    <td>{{$oferta->oferta->vacantes - $oferta->oferta->seleccionados}}</td>
                                    <td>{{$oferta->oferta->descripcion}}</td>
                                    <td>
                                        @if($oferta->seleccionado == 1)
                                            Seleccionado
                                        @else
                                            @if($oferta->oferta->seleccionados < $oferta->oferta->vacantes)
                                                Postulado
                                            @else
                                                Rechazado
                                            @endif
                                            
                                        @endif 
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
            
                    
                     <a href="/empresas/ofertas/crear" class="btn btn-success">Crear Oferta</a>
                
                
        </div>
    </div>



@endsection