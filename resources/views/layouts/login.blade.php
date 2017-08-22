<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
        <link href="/gentelella/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="/gentelella/css/nprogress.css" rel="stylesheet">
        <!-- jQuery custom content scroller -->
        <link href="/gentelella/css/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

        <!-- Custom Theme Style -->
        <link href="/gentelella/css/custom.min.css" rel="stylesheet">

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            @if (Session::get('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                    <br><br>			
                </div>
            @endif
            @yield('content')
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
