@extends('layouts.empresas')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Ofertas</h2>
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
                            <th>Vacantes</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach($ofertas as $oferta)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$oferta->descripcion}}</td>
                                    <td>{{$oferta->profesione->profesione}}</td>
                                    <td>${{$oferta->salario}}</td>
                                    <td>{{$oferta->municipio->municipio}}</td>
                                    <td>{{$oferta->vacantes}}</td>
                                    
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