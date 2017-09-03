@extends('layouts.main')


@section('dropmenu')

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
    <li><a href="/administrador">Inicio</a></li>
  </ul>
</li>
<li><a><i class="fa fa-edit"></i>Empresas<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href="/administrador/empresas">Información</a></li>
  </ul>
</li>

@endsection

@section('content')

  @yield('content')
  
@endsection
