@extends('layouts.login')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <h1>Registrarse</h1>
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

            <div>
                <input id="tipouser_id" type="hidden" name="tipouser_id" value="3">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

            <div>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Email">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

            <div>
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">

            <div>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Cofirmar password">
            </div>
        </div>
        <div class="form-group">
            <div>
                <button type="submit" class="btn btn-default">
                    Registrar
                </button>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="separator">
        <p class="change_link">Ya estas registrado ?
            <a href="{{ route('login') }}" class="to_register"> Ingresar </a>
        </p>

        <div class="clearfix"></div>
        <br />

        <div>
            <h1><i class="fa fa-suitcase"></i> {{ config('app.name', 'Laravel') }}</h1>
            <p><!-- Derechos --></p>
        </div>
        </div>
    </form>
@endsection
