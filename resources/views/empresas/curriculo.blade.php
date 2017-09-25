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

    <div class="x_panel">
        <div class="x_title">
            <h2>Perfil del usuario</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                <div class="profile_img">
                    <div id="crop-avatar">
                        <!-- Current avatar -->
                        <img class="img-responsive avatar-view" src="{{$curriculo->foto}}" alt="Avatar" title="Change the avatar">
                    </div>
                </div>
                <h3>{{$curriculo->nombre}} {{$curriculo->apellido}}</h3>

                <ul class="list-unstyled user_data">
                    <li>
                        <i class="fa fa-id-card user-profile-icon"></i> {{$curriculo->identificacione->identificacion}} {{$curriculo->numero_identificacion}}
                    </li>

                    <li>
                        <i class="fa fa-gift user-profile-icon"></i> {{$curriculo->fecha_nacimiento->age}} Años
                    </li>

                    <li>
                        <i class="fa fa-map-marker user-profile-icon"></i> {{$curriculo->municipio->municipio}}, {{$curriculo->municipio->departamento->departamento}}, {{$curriculo->municipio->departamento->paise->pais}}
                    </li>

                    <li>
                        <i class="fa fa-home user-profile-icon"></i> {{$curriculo->direccion}}
                    </li>

                    <li>
                        <i class="fa fa-phone user-profile-icon"></i> {{$curriculo->telefono}}
                    </li>

                    <li>
                        <i class="fa fa-briefcase user-profile-icon"></i> {{$curriculo->profesione->profesione}}
                    </li>
                </ul>

                @if(count($ofertas) > 0)
                    <form role="form" method="POST" enctype="multipart/form-data" action="/empresas/personas/oferta">
                     {{ csrf_field() }} 
                        <label>Enviar oferta</label>
                        <select id="oferta" class="form-control col-md-6 col-xs-12" name="oferta" required>
                            @foreach($ofertas as $oferta)
                                <option value="{{$oferta->id}}">{{$oferta->descripcion}}</option>
                            @endforeach     
                        </select>
                        <input type="hidden" name="curriculo" value="{{$curriculo->id}}"/>
                        
                        <button type="submit" class="btn btn-success col-md-6 col-xs-12">Enviar</button>
                       
                        
                    </form>

                @endif
                
                <br />
            </div>

            <div class="col-md-9 col-sm-9 col-xs-12">

                <div class="profile_title">
                    <div class="col-md-6">
                        <h2>Video Curriculo</h2>
                    </div>
                </div>
                <!-- start of video -->
                <div id="graph_bar">
                   <p align="center"><video src="{{$curriculo->video}}" controls width="75%" height="auto"><p>
                </div>
                <!-- end of video -->

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Perfil Profesional</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Experiencia Laboral</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Formación</a>
                        </li>
                    </ul>

                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <ul class="list-unstyled timeline">
                                <li>
                                    <div class="block">
                                        
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a>{{$curriculo->profesione->profesione_id}}</a>
                                            </h2>
                                            
                                            <br/>
                                            
                                            <p class="excerpt">
                                                <strong>Descripcion Perfil Profesional:</strong>
                                            </p>    
                                            
                                            <p class="excerpt">
                                                {{$curriculo->descripcion}}
                                            </p>
                                            
                                            <p class="excerpt">
                                                <strong>Situacion Laboral:</strong> {{$curriculo->situacione->situacion}}
                                            </p>
                                            
                                            <p class="excerpt">
                                                <strong>Salario:</strong> {{$curriculo->salario}}
                                            </p>

                                            <p class="excerpt">
                                                <strong>Disponibilidad para viajar:</strong>@if($curriculo->disponibilidad_viajar == 1) Si @else No @endif
                                            </p>

                                            <p class="excerpt">
                                                <strong>Disponibilidad cambio de residencia:</strong>@if($curriculo->disponibilidad_cambio_residencia == 1) Si @else No @endif
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            @if(count($experiencias) > 0)
                                <ul class="list-unstyled timeline">
                                    @foreach($experiencias as $experiencia)
                                        <li>
                                            <div class="block">
                                                
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>{{$experiencia->cargo}} en {{$experiencia->empresa}}</a>
                                                    </h2>
                                                    <div class="byline">
                                                        <span>{{$experiencia->inicio}} a @if($experiencia->continua == 1) actualmente @else {{$experiencia->fin}} @endif</span>
                                                    </div>
                                                    <p class="excerpt">
                                                        <strong>Departamento:</strong> {{$experiencia->departamento->departamento}}
                                                    </p>

                                                    <p class="excerpt">
                                                        <strong>Sector:</strong> {{$experiencia->sectore->sector}}
                                                    </p>

                                                    <p class="excerpt">
                                                        <strong>Area:</strong> {{$experiencia->area->area}}
                                                    </p>

                                                    <p>
                                                        {{$experiencia->descripcion}}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-danger">
                                    No se encuentra experiencia laboral de esta persona
                                </div>
                            @endif
                        

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            @if(count($formaciones) > 0)
                                <ul class="list-unstyled timeline">
                                    @foreach($formaciones as $formacion)
                                        <li>
                                            <div class="block">
                                                
                                                <div class="block_content">
                                                    <h2 class="title">
                                                        <a>{{$formacion->profesione->profesione_id}} en {{$formacion->centro_educativo}}</a>
                                                    </h2>
                                                    <div class="byline">
                                                        <span>{{$formacion->inicio}} a @if($formacion->continua == 1) actualmente @else {{$formacion->fin}} @endif</span>
                                                    </div>
                                                    <p class="excerpt">
                                                        <strong>Nivel Educativo:</strong> {{$formacion->nivele->nivel}}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="alert alert-danger">
                                    No se encuentra la formación de esta persona
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection