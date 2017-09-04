@extends('layouts.admin')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Personas</h2>
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>profesion</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($personas as $persona)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$persona->name}}</td>
                            <td>{{$persona->email}}</td>
                            <td>
                                @if($persona->curriculo)
                                    {{$persona->curriculo->profesion->profesione}}
                                @else
                                    Curriculo sin Configurar
                                @endif 
                            </td>
                            <td>
                                @if($persona->activo == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif 
                            </td>
                            <td>
                                <form action="/administrador/user/activar/{{$persona->id}}" method="post" class="form-horizontal form-label-left">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-warning">Activar/Desactivar</button>    
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach

                </tbody>
        
            
            </table>
        </div>
    </div>



@endsection