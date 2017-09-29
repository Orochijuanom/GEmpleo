<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

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

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-suitcase"></i> <span>{{ config('app.name', 'Laravel') }}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                @yield('foto')
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2>{{Auth::user()->name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @yield('sidebar')
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @yield('fotodrop')
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    @yield('dropmenu')
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    @yield('content')
                  </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <!-- Derechos -->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    @section('scripts')
           <!-- jQuery -->
            <script src="/gentelella/js/jquery.min.js"></script>
            <!-- Bootstrap -->
            <script src="/gentelella/js/bootstrap.min.js"></script>
            <!-- FastClick -->
            <script src="/gentelella/js/fastclick.js"></script>
            <!-- NProgress -->
            <script src="/gentelella/js/nprogress.js"></script>
            <!-- jQuery custom content scroller -->
            <script src="/gentelella/js/jquery.mCustomScrollbar.concat.min.js"></script>
            <!-- jQuery Smart Wizard -->
            <script src="/gentelella/js/jquery.smartWizard.js"></script>
            <!-- validator -->
            <script src="/gentelella/js/validator.js"></script>
            <!-- Custom Theme Scripts -->
            <script src="/gentelella/js/custom.min.js"></script>
    @show
    

    
  </body>
</html>