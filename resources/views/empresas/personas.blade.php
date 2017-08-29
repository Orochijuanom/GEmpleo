@extends('layouts.empresas')

@section('content')
<div class="page-title">
              <div class="title_left">
                <h3>Personas</h3>
              </div>

              <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group pull-right top_search">
                <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="GET" action="/empresas/personas/{{$letra}}/buscador/{{$buscador}}">
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
                          <li><a  href="/empresas/personas/all/buscador/none/">Todos</a></li>
                          <li @if($letra == 'a') class="page-item active" @endif><a href="/empresas/personas/a/buscador/{{$buscador}}/{{$busqueda}}">A</a></li>
                          <li @if($letra == 'b') class="page-item active" @endif><a href="/empresas/personas/b/buscador/{{$buscador}}/{{$busqueda}}">B</a></li>
                          <li @if($letra == 'c') class="page-item active" @endif><a href="/empresas/personas/c/buscador/{{$buscador}}/{{$busqueda}}">C</a></li>
                          <li @if($letra == 'd') class="page-item active" @endif><a href="/empresas/personas/d/buscador/{{$buscador}}/{{$busqueda}}">D</a></li>
                          <li @if($letra == 'e') class="page-item active" @endif><a href="/empresas/personas/e/buscador/{{$buscador}}/{{$busqueda}}">E</a></li>
                          <li @if($letra == 'f') class="page-item active" @endif><a href="/empresas/personas/f/buscador/{{$buscador}}/{{$busqueda}}">F</a></li>
                          <li @if($letra == 'g') class="page-item active" @endif><a href="/empresas/personas/g/buscador/{{$buscador}}/{{$busqueda}}">G</a></li>
                          <li @if($letra == 'h') class="page-item active" @endif><a href="/empresas/personas/h/buscador/{{$buscador}}/{{$busqueda}}">H</a></li>
                          <li @if($letra == 'i') class="page-item active" @endif><a href="/empresas/personas/i/buscador/{{$buscador}}/{{$busqueda}}">I</a></li>
                          <li @if($letra == 'j') class="page-item active" @endif><a href="/empresas/personas/j/buscador/{{$buscador}}/{{$busqueda}}">J</a></li>
                          <li @if($letra == 'k') class="page-item active" @endif><a href="/empresas/personas/k/buscador/{{$buscador}}/{{$busqueda}}">K</a></li>
                          <li @if($letra == 'l') class="page-item active" @endif><a href="/empresas/personas/l/buscador/{{$buscador}}/{{$busqueda}}">L</a></li>
                          <li @if($letra == 'm') class="page-item active" @endif><a href="/empresas/personas/m/buscador/{{$buscador}}/{{$busqueda}}">M</a></li>
                          <li @if($letra == 'n') class="page-item active" @endif><a href="/empresas/personas/n/buscador/{{$buscador}}/{{$busqueda}}">N</a></li>
                          <li @if($letra == 'ñ') class="page-item active" @endif><a href="/empresas/personas/ñ/buscador/{{$buscador}}/{{$busqueda}}">Ñ</a></li>
                          <li @if($letra == 'o') class="page-item active" @endif><a href="/empresas/personas/o/buscador/{{$buscador}}/{{$busqueda}}">O</a></li>
                          <li @if($letra == 'p') class="page-item active" @endif><a href="/empresas/personas/p/buscador/{{$buscador}}/{{$busqueda}}">P</a></li>
                          <li @if($letra == 'q') class="page-item active" @endif><a href="/empresas/personas/q/buscador/{{$buscador}}/{{$busqueda}}">Q</a></li>
                          <li @if($letra == 'r') class="page-item active" @endif><a href="/empresas/personas/r/buscador/{{$buscador}}/{{$busqueda}}">R</a></li>
                          <li @if($letra == 's') class="page-item active" @endif><a href="/empresas/personas/s/buscador/{{$buscador}}/{{$busqueda}}">S</a></li>
                          <li @if($letra == 't') class="page-item active" @endif><a href="/empresas/personas/t/buscador/{{$buscador}}/{{$busqueda}}">T</a></li>
                          <li @if($letra == 'u') class="page-item active" @endif><a href="/empresas/personas/u/buscador/{{$buscador}}/{{$busqueda}}">U</a></li>
                          <li @if($letra == 'v') class="page-item active" @endif><a href="/empresas/personas/v/buscador/{{$buscador}}/{{$busqueda}}">V</a></li>
                          <li @if($letra == 'w') class="page-item active" @endif><a href="/empresas/personas/w/buscador/{{$buscador}}/{{$busqueda}}">W</a></li>
                          <li @if($letra == 'x') class="page-item active" @endif><a href="/empresas/personas/x/buscador/{{$buscador}}/{{$busqueda}}">X</a></li>
                          <li @if($letra == 'y') class="page-item active" @endif><a href="/empresas/personas/y/buscador/{{$buscador}}/{{$busqueda}}">Y</a></li>
                          <li @if($letra == 'z') class="page-item active" @endif><a href="/empresas/personas/z/buscador/{{$buscador}}/{{$busqueda}}">Z</a></li>
                        </ul>
                      </div>

                      <div class="clearfix"></div>
                      @if(count($curriculos) > 0)
                      <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                        
                      </div>
                      <div class="clearfix"></div>
                      <div class="clearfix"></div>
                        @foreach($curriculos as $curriculo)
                            <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i>{{$curriculo->profesione->profesione}}</i></h4>
                            <div class="left col-xs-7">
                              <h2>{{$curriculo->nombre}} {{$curriculo->apellido}}</h2>
                              <ul class="list-unstyled">
                                <li><i class="fa fa-gift"></i> {{$curriculo->fecha_nacimiento->age}} Años </li>
                                <li><i class="fa fa-map-marker"></i> {{$curriculo->municipio->municipio}}, {{$curriculo->municipio->departamento->departamento}}, {{$curriculo->municipio->departamento->paise->pais}}</li>
                                <li><i class="fa fa-home"></i> {{$curriculo->direccion}} </li>
                                <li><i class="fa fa-money"></i> $ {{$curriculo->salario}} </li>  
                              </ul>
                            </div>
                            <div class="right col-xs-5 text-center">
                              <img width="150" src="{{$curriculo->foto}}" alt="" class="img img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                            <a href="/empresas/personas/{{$curriculo->id}}" class="btn btn-primary btn-xs"><i class="fa fa-user"> </i> Ver Perfil</a>
                
                            </div>
                          </div>
                        </div>
                      </div>
                        @endforeach
                        <br/>
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                         {{$curriculos->links()}}
                        </div>
                      @else
                        <div class="alert alert-danger">
                            No se encuentran <strong>Personas</strong> que cumpla con sus criterios de busqueda
                        </div>
                      @endif
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection


