@extends('layouts.main')

@section('foto')
  <img src="@if(isset(Auth::user()->curriculo)){{Auth::user()->curriculo->foto}}@else /images/user.png @endif" alt="..." class="img-circle profile_img">
@endsection

@section('fotodrop')
  <img src="@if(isset(Auth::user()->curriculo)){{Auth::user()->curriculo->foto}}@else /images/user.png @endif" alt="">{{Auth::user()->name}}
@endsection

@section('sidebar')
<li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href="/personas">Inicio</a></li>
  </ul>
</li>
<li><a><i class="fa fa-edit"></i> Curriculo <span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href=" /personas/curriculo/datos-personales">Curriculo</a></li>
    <li><a href="/personas/curriculo/video">Video Curriculo</a></li>
    <li><a href="/personas/curriculo/experiencia-laboral">Experiencia Laboral</a></li>
    <li><a href="/personas/curriculo/formacion">Formación</a></li>
  </ul>
</li>
@endsection

@section('content')

  @yield('content')
  
@endsection

@section('scripts')
  @parent

  <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>

@endsection