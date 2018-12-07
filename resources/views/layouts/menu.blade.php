<li class="header">Menú de opciones</li>

<li>
  <a href="{{ env('APP_URL') }}home">
    <i class="fa fa-arrow-left"></i> <span>Atras</span>
  </a>
</li>

<li class="treeview
                    {{ Request::is('estadoProtreros*') ? 'active' : '' }}
                    {{ Request::is('estadoCompras*') ? 'active' : '' }}
                    {{ Request::is('tipoGanados*') ? 'active' : '' }}
                    {{ Request::is('tipoMedicamentos*') ? 'active' : '' }}
                    {{ Request::is('unidades*') ? 'active' : '' }}
                    {{ Request::is('presentacions*') ? 'active' : '' }}
                    {{ Request::is('tipoCompra*') ? 'active' : '' }}
                    {{ Request::is('deduccions*') ? 'active' : '' }}
                    {{ Request::is('preguntaLicencias*') ? 'active' : '' }}
                    {{ Request::is('preguntaFacturas*') ? 'active' : '' }}
                    {{ Request::is('estadoAnimals*') ? 'active' : '' }}"
">
  <a href="#">
    <i class="fa fa-folder"></i> <span>Administración</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="padding-top: 1.2em;padding-bottom: 1.2em;">

    <li class="{{ Request::is('estadoProtreros*') ? 'active' : '' }}"><a href="{!! route('estadoProtreros.index') !!}"><i class="fa fa-gear"></i> <span>Estado potreros</span></a></li>
    <li class="{{ Request::is('estadoCompras*') ? 'active' : '' }}"><a href="{!! route('estadoCompras.index') !!}"><i class="fa fa-gear"></i> <span>Estado Compra</span></a></li>
    </li><li class="{{ Request::is('tipoGanados*') ? 'active' : '' }}">
        <a href="{!! route('tipoGanados.index') !!}"><i class="fa fa-gear"></i><span>Tipos de Ganado</span></a>
    </li>
    <li class="{{ Request::is('tipoMedicamentos*') ? 'active' : '' }}">
      <a href="{!! route('tipoMedicamentos.index') !!}"><i class="fa fa-gear"></i><span>Tipos de Medicamentos</span></a>
    </li>
    <li class="{{ Request::is('tipoCompra*') ? 'active' : '' }}">
        <a href="{!! route('tipoCompra.index') !!}"><i class="fa fa-gear"></i><span>Tipos de compra</span></a>
    </li>
    <li class="{{ Request::is('unidades*') ? 'active' : '' }}">
      <a href="{!! route('unidades.index') !!}"><i class="fa fa-gear"></i><span>Unidades</span></a>
    </li>
    <li class="{{ Request::is('presentacions*') ? 'active' : '' }}">
      <a href="{!! route('presentacions.index') !!}"><i class="fa fa-gear"></i><span>Presentacion Medicamentos</span></a>
    </li>
    <li class="{{ Request::is('deduccions*') ? 'active' : '' }}">
        <a href="{!! route('deduccions.index') !!}"><i class="fa fa-gear"></i><span>Deducciones</span></a>
    </li>

    <li class="{{ Request::is('preguntaLicencias*') ? 'active' : '' }}">
        <a href="{!! route('preguntaLicencias.index') !!}"><i class="fa fa-gear"></i><span>Pregunta Licencias</span></a>
    </li>

    <li class="{{ Request::is('preguntaFacturas*') ? 'active' : '' }}">
        <a href="{!! route('preguntaFacturas.index') !!}"><i class="fa fa-gear"></i><span>Pregunta Facturas</span></a>
    </li>
    <li class="{{ Request::is('estadoAnimals*') ? 'active' : '' }}">
            <a href="{!! route('estadoAnimals.index') !!}"><i class="fa fa-edit"></i><span>Estado Animal</span></a>
        </li>



  </ul>
</li>


<li class="{{ Request::is('app*') ? 'active' : '' }}">
  <a href="{{ env('APP_URL') }}app">
    <i class="fa fa-home"></i> <span>Inicio</span>
  </a>
</li>

<li class="treeview
                    {{ Request::is('hierros*') ? 'active' : '' }}
                    {{ Request::is('potreros*') ? 'active' : '' }}
                    {{ Request::is('lugarProcedencias*') ? 'active' : ''}}
                    {{ Request::is('vendedores*') ? 'active' : '' }}
                    {{ Request::is('compradores*') ? 'active' : '' }}
                    {{ Request::is('responsableCompras*') ? 'active' : '' }}
                    {{ Request::is('empresas*') ? 'active' : '' }}
                    {{ Request::is('medicamentos*') ? 'active' : '' }}

">
  <a href="#">
    <i class="fa fa-folder"></i> <span>Configura tu finca</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="padding-top: 1.2em;padding-bottom: 1.2em;">

    <li class="{{ Request::is('empresas*') ? 'active' : '' }}">
        <a href="{!! route('empresas.index') !!}"><i class="fa fa-archive"></i><span>Empresa</span></a>
    </li>
    <li class="{{ Request::is('hierros*') ? 'active' : '' }}"><a href="{!! route('hierros.index') !!}"><i class="fa fa-odnoklassniki"></i> <span>Hierros</span></a></li>
    <li class="{{ Request::is('potreros*') ? 'active' : '' }}"><a href="{!! route('potreros.index') !!}"><i class="fa fa-object-ungroup"></i> <span>Potreros</span></a></li>
    <li class="{{ Request::is('lugarProcedencias*') ? 'active' : ''}}"><a href="{!! route('lugarProcedencias.index') !!}"><i class="fa fa-globe"></i> <span>Lugar Procedencias</span></a></li>
    <li class="{{ Request::is('vendedores*') ? 'active' : '' }}"><a href="{!! route('vendedores.index') !!}"><i class="fa fa-user-secret"></i> <span>Vendedores</span></a></li>
    <li class="{{ Request::is('compradores*') ? 'active' : '' }}"><a href="{!! route('compradores.index') !!}"><i class="fa fa-user-secret"></i> <span>Compradores</span></a></li>
    <li class="{{ Request::is('responsableCompras*') ? 'active' : '' }}"><a href="{!! route('responsableCompras.index') !!}"><i class="fa fa-user-secret"></i> <span>Responsable de ingreso</span></a></li>
    <li class="{{ Request::is('medicamentos*') ? 'active' : '' }}">
      <a href="{!! route('medicamentos.index') !!}"><i class="fa fa-stethoscope"></i><span>Medicamentos</span></a>
    </li>





  </ul>
</li>




<li class="treeview
  {{ Request::is('registroCompras*') ? 'active' : '' }}
  {{ Request::is('compraMedicamentos*') ? 'active' : '' }}
">
  <a href="#">
    <i class="fa fa-folder"></i> <span>Compras</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="padding-top: 1.2em;padding-bottom: 1.2em;">
    <li class="{{ Request::is('registroCompras*') ? 'active' : '' }}">
      <a href="{!! route('registroCompras.index') !!}">
        <i class="fa fa-shopping-cart"></i>
          <span> Compra de Animales</span>
      </a>
    </li>
    <li class="{{ Request::is('compraMedicamentos*') ? 'active' : '' }}">
      <a href="{!! route('compraMedicamentos.index') !!}"><i class="fa fa-shopping-cart"></i><span>Compra de Medicamentos</span></a>
    </li>


  </ul>
</li>

<li class="{{ Request::is('ingresoAnimals*') ? 'active' : '' }}">
    <a href="{!! route('ingresoAnimals.index') !!}"><i class="fa fa-truck"></i><span>Ingreso de Animales</span></a>
</li>

<li class="{{ Request::is('mi_finca*') ? 'active' : '' }}">
    <a href="{!! route('mi_finca.index') !!}"><i class="fa fa-map-o" aria-hidden="true"></i><span>Mi Finca</span></a>
</li>







<li class="{{ Request::is('controlLLuvias*') ? 'active' : '' }}">
    <a href="{!! route('controlLLuvias.index') !!}"><i class="fa fa-thermometer-half"></i><span> Control de lluvias</span></a>
</li>









