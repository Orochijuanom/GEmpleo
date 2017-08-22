@extends('layouts.main')

@section('foto')
  <img src="@if(isset(Auth::user()->empresa)){{Auth::user()->empresa->logo}}@else /images/user.png @endif" alt="..." class="img-circle profile_img">
@endsection

@section('fotodrop')
  <img src="@if(isset(Auth::user()->empresa)){{Auth::user()->empresa->logo}}@else /images/user.png @endif" alt="">{{Auth::user()->name}}
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
    <li><a href=" /empresas/personas//">Buscar</a></li>
  </ul>
</li>
@endsection

@section('content')

  @yield('content')
  
@endsection
