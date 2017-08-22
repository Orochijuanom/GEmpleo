@extends('layouts.login')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <h1>Ingresar</h1>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

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
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div>
                <button type="submit" class="btn btn-default">
                    Ingresar
                </button>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Olvidaste tu password?
                </a>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="separator">
        <p class="change_link">No estas registrado?
            <a href="{{ route('register') }}" class="to_register"> Registrate </a>
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