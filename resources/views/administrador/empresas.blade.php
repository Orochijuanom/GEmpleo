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

        <div class="x_content">
            <table class="table table-striped">
                <thead>
                    <tr>

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
                            <td></td>
                        </tr>
                    @endforeach

                </tbody>
        
            
            </table>
        </div>
    </div>



@endsection