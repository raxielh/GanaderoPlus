<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap-theme.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/materialdesignicons.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="shortcut icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon">
    <!-- jQuery 3 -->
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
    <style>
        .skin-green-light .sidebar-menu>li.header {color: #fff;background: #444444;}
        .skin-green-light .main-header .logo {background-color: #068c4f;color: #fff;border-bottom: 0 solid transparent;}
        .skin-green-light .sidebar-menu>li:hover>a, .skin-green-light .sidebar-menu>li.active>a {color: #000;background: #dedede;}
        .box.box-primary {border-top-color: #3c8dbc;}
        .box {padding: 1em;}
        .box.box-primary{border-top-color: #00a65a;}
        .bg-red, .callout.callout-danger, .alert-danger, .alert-error, .label-danger, .modal-danger .modal-body {
            background-color: #dd4b39 !important;
            color: #333 !important;
        }
        .bg-green, .callout.callout-success, .alert-success, .label-success, .modal-success .modal-body {
            background-color: #00a65a !important;
            color: #333 !important;
        }
    </style>
</head>

<body class="skin-green-light skin-green-light sidebar-collapse">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ env('APP_URL') }}home" class="logo">
              <span class="logo-lg" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">{{ env('APP_NAME') }}</</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{URL::asset('img/icono.png')}}"
                                     class="user-image" alt="User Image"/>
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{URL::asset('img/icono.png')}}"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/perfil" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright © 2018 <a href="#">Ganadero Plus</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! url('/') !!}">
                    InfyOm Generator
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! url('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! url('/login') !!}">Login</a></li>
                    <li><a href="{!! url('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Bootstrap 3.3.7 -->
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::asset('js/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('js/adminlte.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{URL::asset('js/jquery.sparkline.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{URL::asset('js/jquery.slimscroll.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{URL::asset('js/Chart.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('js/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::asset('js/demo.js')}}"></script>
</body>
</html>
