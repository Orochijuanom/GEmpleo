@extends('layouts.admin')

@section('content')

    <div class="x_panel">
        <div class="x_title">
            <h2>Empresas</h2>
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
                        <th>Empresa</th>
                        <th>Vistas mensuales contratadas</th>
                        <th>Vistas este mes</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                        <tr>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$empresa->name}}</td>
                            <td>{{$empresa->email}}</td>
                            <td>
                                @if($empresa->empresa)
                                    {{$empresa->empresa->nombre}}
                                @else
                                    Empresa sin Configurar
                                @endif 
                            </td>
                            <td>
                                @if($empresa->empresa)
                                    {{$empresa->empresa->limite}}
                                @else
                                    Empresa sin Configurar
                                @endif 
                            </td>
                            <td>
                                @if($empresa->empresa)
                                    {{$empresa->empresa->vistas}}
                                @else
                                    Empresa sin Configurar
                                @endif 
                            </td>
                            <td>
                                @if($empresa->activo == 1)
                                    Activo
                                @else
                                    Inactivo
                                @endif 
                            </td>
                            <td>
                                <form action="/administrador/user/activar/{{$empresa->id}}" method="post" class="form-horizontal form-label-left">
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