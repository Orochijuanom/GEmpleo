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

        <div class="x_content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>profesion</th>
                        <th>Estado</th>
                    
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
                        </tr>
                    @endforeach

                </tbody>
        
            
            </table>
        </div>
    </div>



@endsection