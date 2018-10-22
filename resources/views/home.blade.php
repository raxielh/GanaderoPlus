<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="shortcut icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{URL::asset('favicon.ico')}}" type="image/x-icon">
    <style>
      .skin-green-light .sidebar-menu>li.header {color: #fff;background: #444444;}
      .skin-green-light .main-header .logo {background-color: #068c4f;color: #fff;border-bottom: 0 solid transparent;}
      .d-none {
        display: block !important;
      }
      .gm-style-mtc,.gm-svpc{
        display: none;
      }
      #map {
        height: 250px;
        width: 100%;
        margin-bottom: 10px;
      }
      #delete{
        display: inline-block;
      }
      .alert-success {
          width: 100%;
      }
      .bt{
        background-color: #fff;
        border: 0px;
        width: 100%;
        margin-left: 9px;
      }
      .bt:hover{
        color: red;
      }
    </style>
</head>
<body class="skin-green-light layout-top-nav" style="height: auto; min-height: 100%;">
<div class="wrapper" style="height: auto; min-height: 100%;">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ env('APP_URL') }}home" class="navbar-brand">{{ env('APP_NAME') }}</a>
        </div>

        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{URL::asset('img/icono.png')}}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{URL::asset('img/icono.png')}}" class="img-circle" alt="User Image">
                  <p>{!! Auth::user()->name !!}</p>
                </li>
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
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <div class="content-wrapper" style="min-height: 847px;">
    <div class="container">
      <h2>@if (count($Fincas) === 0)Crea tu primera finca @else Elije tu finca @endif <button type="button" class="btn btn-success btn-fw"data-toggle="modal"data-target="#add">
        <i class="fa fa-plus"></i> Crear finca</button>
      </h2>
      <div class="row">@include('flash::message')</div>
    </div>
    <div style="padding: 1em" class="container">
      <div class="row" style="margin-top: 1em;">

        @foreach ($Fincas as $Finca)
              <div class="col-md-4">
                <div class="card card-statistics" style="background-color: #FFF;margin: 10px;padding: 1em;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.10);" >
                  <div class="card-body">
                    <h4 style="text-align: center;font-weight: bold;">Finca {{ $Finca->nombre }}</h4>
                    <p style="text-align: center;display: none;">{{ $Finca->descripcion }}</p>
                    <div class="row">
                      <div class="colmd-12">
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{ $Finca->lat}},{{ $Finca->lon}}&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:F%7C{{ $Finca->lat}},{{ $Finca->lon}}&key=AIzaSyBcuL57fE7kGODVpu6TsoFRFR2kaIr5LWw" width="100%" alt="">
                      </div>
                    </div>
                    <div class="row" style="text-align: end;padding: 1em">

                      <div class="col-md-12" style="text-align: center;">
                        {!! Form::open(['route' => ['elegir_finca'], 'method' => 'post']) !!}
                          <input type="hidden" name="finca" value="{{ $Finca->id }}">
                          <button type="submit" class="btn btn-block btn-info btn-fw"><i class="fa fa-globe"></i> Entrar</button>
                        {!! Form::close() !!}
                      </div>

                      <div class="col-md-12" style="text-align: end;margin-top: 10px">
                        <div class="btn-group">
                          <button type="button" class="btn btn-warning" dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa  fa-chevron-circle-down"></i></button>
                          <ul class="dropdown-menu" role="menu">
                            <li>
                              <a href="#"  data-toggle="modal" data-target="#update_{{ $Finca->id }}" style="color: #333"><i class="fa fa-pencil"></i>Editar</a>
                            </li>
                            <li>
                              {!! Form::open(['route' => ['fincas.destroy', $Finca->id], 'method' => 'delete','id'=>'delete']) !!}
                                {!! Form::button('<i class="fa fa-trash" style="margin-right: 9px;"></i> Borrar', ['type' => 'submit', 'class' => 'bt', 'onclick' => "return confirm('Estas seguro de borrar esta finca?')"]) !!}
                              {!! Form::close() !!}     
                            </li>
                          </ul>
                        </div>
                      </div>

                    </div>      
                  </div>
                </div>
              </div>
              <!---ModALES--->              
              <div id="update_{{ $Finca->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Finca {{ $Finca->nombre }}</h4>
                    </div>
                    <div class="modal-body">
                     {!! Form::open(['route' => 'update_finca','enctype'=>'multipart/form-data']) !!}
                     <input type="hidden" name="id" value="{{ $Finca->id }}">

                        <div class="form-group">
                          <label for="exampleInputPassword1">Nombre</label>
                          <input type="text" class="form-control" name="nombre" placeholder="" value="{{ $Finca->nombre }}" required="">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">Descripcion</label>
                          <input type="text" class="form-control" name="descripcion" rows="4" placeholder="" value="{{ $Finca->descripcion }}" >
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">Latitud</label>
                          <input type="text" class="form-control" name="lat" placeholder="Latitud" value="{{ $Finca->lat }}" required="">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">Longitud</label>
                          <input type="text" class="form-control" name="lon" placeholder="Longitud" value="{{ $Finca->lon }}" required="">
                        </div>
                        
                        <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Guardar</button>
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>

                      {!! Form::close() !!}

                    </div>
                  </div>
                </div>
              </div>

              @endforeach
      </div>


      <div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Crear nueva finca</h4>
            </div>
            <div class="modal-body">

              {!! Form::open(['route' => 'crear_finca','enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                  {!! Form::label('nombre', 'Nombre:') !!}
                  {!! Form::text('nombre', null, ['class' => 'form-control','autofocus'=>'autofocus','placeholder'=>'La Bonita','required'=>'true']) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('descripcion', 'Descripcion:') !!}
                  {!! Form::textarea('descripcion', null, ['class' => 'form-control','rows' => '4','autofocus'=>'autofocus','placeholder'=>'Descripcion...']) !!}
                </div>

                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lon" id="lon">
                <div id="map"></div> 
                
                <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Guardar</button>
                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>

              {!! Form::close() !!}

            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcuL57fE7kGODVpu6TsoFRFR2kaIr5LWw&callback=initMap"async defer></script>
<script>
  var map;
  var geo_options = {
    enableHighAccuracy: true, 
    maximumAge        : 30000, 
    timeout           : 27000
  };

  function geo_success(position) {

    $('#lat').val(position.coords.latitude);
    $('#lon').val(position.coords.longitude);

    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat:position.coords.latitude, lng:position.coords.longitude},
      zoom:10
    });
     
     var marker=new google.maps.Marker({
        position:map.getCenter(), 
        map:map, 
        draggable:true
     });
        
     google.maps.event.addListener(marker,'dragend',function(event) {
        $('#lat').val(this.getPosition().lat());
        $('#lon').val(this.getPosition().lng());
     });
  }

  function geo_error(){
    alert('error gps ');
  }


  var wpid = navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);

    function initMap() {
    $('#lat').val(8.756917);
    $('#lon').val(-75.879524);
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 8.756917, lng: -75.879524},
      zoom:10  
    });
     
     var marker=new google.maps.Marker({
        position:map.getCenter(), 
        map:map, 
        draggable:true
     });
        
     google.maps.event.addListener(marker,'dragend',function(event) {
        $('#lat').val(this.getPosition().lat());
        $('#lon').val(this.getPosition().lng());
     });
  }

</script>
    <!-- jQuery 3 -->
    <script src="{{URL::asset('js/jquery.min.js')}}"></script>
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