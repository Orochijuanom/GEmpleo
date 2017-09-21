@extends('layouts.main')

@section('foto')
  <img src="@if(isset(Auth::user()->empresa)){{Auth::user()->empresa->logo}}@else /images/user.png @endif" alt="..." class="img-circle profile_img">
@endsection

@section('fotodrop')
  <img src="@if(isset(Auth::user()->empresa)){{Auth::user()->empresa->logo}}@else /images/user.png @endif" alt="">{{Auth::user()->name}}
@endsection

@section('dropmenu')

  <li><a href="/empresas/informacion"> Informacion</a></li>

  <li>
      <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out pull-right"></i> Salir</a>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
  </li>

@endsection

@section('sidebar')
<li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href="/empresas">Inicio</a></li>
  </ul>
</li>
<li><a><i class="fa fa-edit"></i>Información Empresarial<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href=" /empresas/informacion">Información</a></li>
  </ul>
</li>
<li><a><i class="fa fa-user-circle-o"></i>Personas<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href=" /empresas/personas/all/buscador/none/">Buscar</a></li>
  </ul>
</li>
<li><a><i class="fa fa-money"></i>Ofertas<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href=" /empresas/ofertas">Ofertas</a></li>
  </ul>
</li>
@endsection

@section('content')

  @yield('content')
  
@endsection
