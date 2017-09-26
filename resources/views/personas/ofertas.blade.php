@extends('layouts.personas')

@section('content')
<div class="page-title">
              <div class="title_left">
                <h3>Ofertas</h3>
              </div>

              <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group pull-right top_search">
                <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="GET" action="/personas/ofertas/{{$letra}}/buscador/{{$buscador}}">
                {{ csrf_field() }} 
                  
                  <div class="col-md-5 col-sm-5 col-xs-12">
                    <select class="form-control" name="buscador">
                      <option value="" disabled selected>Buscar por...</option>
                      <option value="municipio">Municipio</option>
                      <option value="profesion">Profesión</option>
                      <option value="salario">Salario hasta</option>
                    </select>
                  </div>

                  <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="input-group">  
                    <input name="busqueda" type="text" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Ir!</button>
                    </span>
                    </div>
                  </div>
                  
                  </form>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
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
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <ul class="pagination pagination-split">
                          <li><a  href="/personas/ofertas/all/buscador/none/">Todos</a></li>
                          <li @if($letra == 'a') class="page-item active" @endif><a href="/personas/ofertas/a/buscador/{{$buscador}}/{{$busqueda}}">A</a></li>
                          <li @if($letra == 'b') class="page-item active" @endif><a href="/personas/ofertas/b/buscador/{{$buscador}}/{{$busqueda}}">B</a></li>
                          <li @if($letra == 'c') class="page-item active" @endif><a href="/personas/ofertas/c/buscador/{{$buscador}}/{{$busqueda}}">C</a></li>
                          <li @if($letra == 'd') class="page-item active" @endif><a href="/personas/ofertas/d/buscador/{{$buscador}}/{{$busqueda}}">D</a></li>
                          <li @if($letra == 'e') class="page-item active" @endif><a href="/personas/ofertas/e/buscador/{{$buscador}}/{{$busqueda}}">E</a></li>
                          <li @if($letra == 'f') class="page-item active" @endif><a href="/personas/ofertas/f/buscador/{{$buscador}}/{{$busqueda}}">F</a></li>
                          <li @if($letra == 'g') class="page-item active" @endif><a href="/personas/ofertas/g/buscador/{{$buscador}}/{{$busqueda}}">G</a></li>
                          <li @if($letra == 'h') class="page-item active" @endif><a href="/personas/ofertas/h/buscador/{{$buscador}}/{{$busqueda}}">H</a></li>
                          <li @if($letra == 'i') class="page-item active" @endif><a href="/personas/ofertas/i/buscador/{{$buscador}}/{{$busqueda}}">I</a></li>
                          <li @if($letra == 'j') class="page-item active" @endif><a href="/personas/ofertas/j/buscador/{{$buscador}}/{{$busqueda}}">J</a></li>
                          <li @if($letra == 'k') class="page-item active" @endif><a href="/personas/ofertas/k/buscador/{{$buscador}}/{{$busqueda}}">K</a></li>
                          <li @if($letra == 'l') class="page-item active" @endif><a href="/personas/ofertas/l/buscador/{{$buscador}}/{{$busqueda}}">L</a></li>
                          <li @if($letra == 'm') class="page-item active" @endif><a href="/personas/ofertas/m/buscador/{{$buscador}}/{{$busqueda}}">M</a></li>
                          <li @if($letra == 'n') class="page-item active" @endif><a href="/personas/ofertas/n/buscador/{{$buscador}}/{{$busqueda}}">N</a></li>
                          <li @if($letra == 'ñ') class="page-item active" @endif><a href="/personas/ofertas/ñ/buscador/{{$buscador}}/{{$busqueda}}">Ñ</a></li>
                          <li @if($letra == 'o') class="page-item active" @endif><a href="/personas/ofertas/o/buscador/{{$buscador}}/{{$busqueda}}">O</a></li>
                          <li @if($letra == 'p') class="page-item active" @endif><a href="/personas/ofertas/p/buscador/{{$buscador}}/{{$busqueda}}">P</a></li>
                          <li @if($letra == 'q') class="page-item active" @endif><a href="/personas/ofertas/q/buscador/{{$buscador}}/{{$busqueda}}">Q</a></li>
                          <li @if($letra == 'r') class="page-item active" @endif><a href="/personas/ofertas/r/buscador/{{$buscador}}/{{$busqueda}}">R</a></li>
                          <li @if($letra == 's') class="page-item active" @endif><a href="/personas/ofertas/s/buscador/{{$buscador}}/{{$busqueda}}">S</a></li>
                          <li @if($letra == 't') class="page-item active" @endif><a href="/personas/ofertas/t/buscador/{{$buscador}}/{{$busqueda}}">T</a></li>
                          <li @if($letra == 'u') class="page-item active" @endif><a href="/personas/ofertas/u/buscador/{{$buscador}}/{{$busqueda}}">U</a></li>
                          <li @if($letra == 'v') class="page-item active" @endif><a href="/personas/ofertas/v/buscador/{{$buscador}}/{{$busqueda}}">V</a></li>
                          <li @if($letra == 'w') class="page-item active" @endif><a href="/personas/ofertas/w/buscador/{{$buscador}}/{{$busqueda}}">W</a></li>
                          <li @if($letra == 'x') class="page-item active" @endif><a href="/personas/ofertas/x/buscador/{{$buscador}}/{{$busqueda}}">X</a></li>
                          <li @if($letra == 'y') class="page-item active" @endif><a href="/personas/ofertas/y/buscador/{{$buscador}}/{{$busqueda}}">Y</a></li>
                          <li @if($letra == 'z') class="page-item active" @endif><a href="/personas/ofertas/z/buscador/{{$buscador}}/{{$busqueda}}">Z</a></li>
                        </ul>
                      </div>

                      <div class="clearfix"></div>
                      @if(count($ofertas) > 0)
                      <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                        
                      </div>
                      <div class="clearfix"></div>
                      <div class="clearfix"></div>
                        @foreach($ofertas as $oferta)
                            <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>{{$oferta->profesione->profesione}}</i></h4>
                            <div class="left col-xs-7">
                              <h2>{{$oferta->nombre}}</h2>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-map-marker"></i> {{$oferta->municipio->municipio}}, {{$oferta->municipio->departamento->departamento}}, {{$oferta->municipio->departamento->paise->pais}}</li>
                                <li><i class="fa fa-money"></i> $ {{$oferta->salario}} </li>
                                <li><i class="fa fa-industry"></i> {{$oferta->empresa->nombre}} </li>
                                <li><i class="fa fa-thumb-tack"></i> {{$oferta->descripcion}} </li>   
                              </ul>
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                                <form role="form" method="POST" enctype="multipart/form-data" action="/personas/ofertas/inscripcion">
                                    {{ csrf_field() }} 
                                    
                                    
                                    <input type="hidden" name="curriculo" value="{{Auth::user()->curriculo->id}}"/>
                                    <input type="hidden" name="oferta" value="{{$oferta->id}}">
                                    <button type="submit" class="btn btn-success col-md-12 col-xs-12">Inscribir a la oferta</button>
                                
                                    
                                </form>
                
                            </div>
                          </div>
                        </div>
                      </div>
                        @endforeach
                        <br/>
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                         {{$ofertas->links()}}
                        </div>
                      @else
                        <div class="alert alert-danger">
                            No se encuentran <strong>Ofertas</strong> que cumpla con sus criterios de busqueda
                        </div>
                      @endif
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection


