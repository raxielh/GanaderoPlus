<aside class="main-sidebar" id="sidebar-wrapper">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{URL::asset('img/icono.png')}}" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                @if (Auth::guest())
                <p>Desconectado</p>
                @else
                    <p style="line-height: 17px;">
                        {{ Auth::user()->name}} 
                        <br>Finca
                        @foreach ($Fincas as $Fincas)
                          {{ $Fincas->nombre }}
                        @endforeach
                        <br>
                        <i class="fa fa-circle text-success"></i> Online
                    </p>
                @endif
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree" style="margin-top: 1em">
            @include('layouts.menu')
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>