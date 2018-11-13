@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Registro Compra
        </h4>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'registroCompras.store']) !!}

                        @include('registro_compras.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="lp" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Lugar de procedencia</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'lugarProcedencias.store']) !!}
            <input type="hidden" value="1" name="op">
            <input type="hidden" name="fecha_compra" class="fecha_compra_">
            <input type="hidden" name="factura" class="factura_">
            <input type="hidden" name="deduccion" class="deduccion_">
            <input type="hidden" name="lugar_procedencia_id" class="lugar_procedencia_id_">
            <input type="hidden" name="vendedor_id" class="vendedor_id_">
            <input type="hidden" name="comprador_id" class="comprador_id_">
            <input type="hidden" name="empresas_id" class="empresas_id_">
            <input type="hidden" name="tipo_compras_id" class="tipo_compras_id_">
                @include('lugar_procedencias.rc_fields')
            {!! Form::close() !!}
        </div>
        <div class="modal-footer"></div>
      </div>    
    </div>
</div>

<div class="modal fade" id="ve" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Vendedor</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'vendedores.store']) !!}
            <input type="hidden" value="1" name="op">
            <input type="hidden" name="fecha_compra" class="fecha_compra_">
            <input type="hidden" name="factura" class="factura_">
            <input type="hidden" name="deduccion" class="deduccion_">
            <input type="hidden" name="lugar_procedencia_id" class="lugar_procedencia_id_">
            <input type="hidden" name="vendedor_id" class="vendedor_id_">
            <input type="hidden" name="comprador_id" class="comprador_id_">
            <input type="hidden" name="empresas_id" class="empresas_id_">
            <input type="hidden" name="tipo_compras_id" class="tipo_compras_id_">
                @include('vendedores.rc_fields')
            {!! Form::close() !!}
        </div>
        <div class="modal-footer"></div>
      </div>    
    </div>
</div>

<div class="modal fade" id="co" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Comprador</h4>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'compradores.store']) !!}
            <input type="hidden" value="1" name="op">
            <input type="hidden" name="fecha_compra" class="fecha_compra_">
            <input type="hidden" name="factura" class="factura_">
            <input type="hidden" name="deduccion" class="deduccion_">
            <input type="hidden" name="lugar_procedencia_id" class="lugar_procedencia_id_">
            <input type="hidden" name="vendedor_id" class="vendedor_id_">
            <input type="hidden" name="comprador_id" class="comprador_id_">
            <input type="hidden" name="empresas_id" class="empresas_id_">
            <input type="hidden" name="tipo_compras_id" class="tipo_compras_id_">
                @include('compradores.rc_fields')
            {!! Form::close() !!}
        </div>
        <div class="modal-footer"></div>
      </div>    
    </div>
</div>

<script>
    $(function() {
        $( ".fecha_compra_" ).val($( "#fecha_compra" ).val());
        $( ".lugar_procedencia_id_" ).val($( "#lugar_procedencia_id" ).val());
        $( ".factura_" ).val($( "#factura" ).val());
        $( ".deduccion_" ).val($( "#deduccion" ).val());
        $( ".vendedor_id_" ).val($( "#vendedor_id" ).val());
        $( ".comprador_id_" ).val($( "#comprador_id" ).val());
        $( ".empresas_id_" ).val($( "#empresas_id" ).val());
        $( ".tipo_compras_id_" ).val($( "#tipo_compras_id" ).val());

        $( "#vendedor_id" ).change(function() {
          $( ".vendedor_id_" ).val($( "#vendedor_id" ).val());
        });
        $( "#comprador_id" ).change(function() {
          $( ".comprador_id_" ).val($( "#comprador_id" ).val());
        });
        $( "#empresas_id" ).change(function() {
          $( ".empresas_id_" ).val($( "#empresas_id" ).val());
        });
        $( "#tipo_compras_id" ).change(function() {
          $( ".tipo_compras_id_" ).val($( "#tipo_compras_id" ).val());
        });
        $( "#lugar_procedencia_id" ).change(function() {
          $( ".lugar_procedencia_id_" ).val($( "#lugar_procedencia_id" ).val());
        });
        $( "#fecha_compra" ).change(function() {
          $( ".fecha_compra_" ).val($( "#fecha_compra" ).val());
        });
        $( "#factura" ).change(function() {
          $( ".factura_" ).val($( "#factura" ).val());
        });
        $( "#deduccion" ).change(function() {
          $( ".deduccion_" ).val($( "#deduccion" ).val());
        });

    });
</script>




@endsection
