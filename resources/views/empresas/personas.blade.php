@extends('layouts.empresas')

@section('content')
<div class="page-title">
              <div class="title_left">
                <h3>Personas</h3>
              </div>

              <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 form-group pull-right top_search">
                <form data-parsley-validate class="form-horizontal form-label-left" role="form" method="GET" action="/empresas/personas/">
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
                          <li><a href="/empresas/personas/">Todos</a></li>
                          <li><a href="/empresas/personas/a">A</a></li>
                          <li><a href="/empresas/personas/b">B</a></li>
                          <li><a href="/empresas/personas/c">C</a></li>
                          <li><a href="/empresas/personas/d">D</a></li>
                          <li><a href="/empresas/personas/e">E</a></li>
                          <li><a href="/empresas/personas/f">F</a></li>
                          <li><a href="/empresas/personas/g">G</a></li>
                          <li><a href="/empresas/personas/h">H</a></li>
                          <li><a href="/empresas/personas/i">I</a></li>
                          <li><a href="/empresas/personas/j">J</a></li>
                          <li><a href="/empresas/personas/k">K</a></li>
                          <li><a href="/empresas/personas/l">L</a></li>
                          <li><a href="/empresas/personas/m">M</a></li>
                          <li><a href="/empresas/personas/n">N</a></li>
                          <li><a href="/empresas/personas/ñ">Ñ</a></li>
                          <li><a href="/empresas/personas/o">O</a></li>
                          <li><a href="/empresas/personas/p">P</a></li>
                          <li><a href="/empresas/personas/q">Q</a></li>
                          <li><a href="/empresas/personas/r">R</a></li>
                          <li><a href="/empresas/personas/s">S</a></li>
                          <li><a href="/empresas/personas/t">T</a></li>
                          <li><a href="/empresas/personas/u">U</a></li>
                          <li><a href="/empresas/personas/v">V</a></li>
                          <li><a href="/empresas/personas/w">W</a></li>
                          <li><a href="/empresas/personas/x">X</a></li>
                          <li><a href="/empresas/personas/y">Y</a></li>
                          <li><a href="/empresas/personas/z">Z</a></li>
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
                              <img src="{{$curriculo->foto}}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">
                            <div class="col-xs-12 col-sm-6 emphasis">
                              
                            </div>
                            <div class="col-xs-12 col-sm-6 emphasis">
                              <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                </i> <i class="fa fa-comments-o"></i> </button>
                              <button type="button" class="btn btn-primary btn-xs">
                                <i class="fa fa-user"> </i> View Profile
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                        @endforeach
                        <br/>
                        <div class="col-md-12 col-sm-12 col-xs-12 profile_details">
                        
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


