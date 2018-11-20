<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
                <div class="row">
<!-- Fecha Compra Field -->
<div class="form-group col-sm-3" style="z-index: 1">
    {!! Form::label('fecha_compra', 'Fecha Compra:') !!}
    
    @if ($registroCompra === 0)
        {!! Form::date('fecha_compra', date('Y-m-d'), ['class' => 'form-control','value' => old('fecha_compra')]) !!}
    @else
        {!! Form::date('fecha_compra', \Carbon\Carbon::parse($registroCompra->fecha_compra)->format('Y-m-d'), ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-2" style="z-index: 1">
    {!! Form::label('factura', 'Numero de factura:') !!}
     {!! Form::text('factura', null, ['class' => 'form-control','required' => 'true','placeholder' => 'Numero de factura','value' => old('factura')]) !!}
</div>

<div class="form-group col-sm-2" style="z-index: 1">
    <div class="col-md-11 col-xs-11 col-sm-11" style="padding-left: 0px;padding-right: 0px;">
        {!! Form::label('deduccions_id', 'Tipo de Deduccion:') !!}
        {!! Form::select('deduccions_id',$deduccion, old('deduccions_id'), ['class' => 'form-control chosen-select']) !!}
    </div>
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-2" style="z-index: 1">
    {!! Form::label('deduccion', 'Deduccion:') !!}
    {!! Form::number('deduccion', null, ['class' => 'form-control','required' => 'true','placeholder' => 'Porcentaje de deduccion','value' => old('deduccion')]) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-3" style="z-index: 1">
    {!! Form::label('estado_id', 'Estado:') !!}
    {!! Form::select('estado_id',$estado_compra, null, ['class' => 'form-control chosen-select']) !!}
</div>

<!-- Lugar Procedencia Id Field -->
<div class="form-group col-sm-6" style="z-index: 1">
    <div class="col-md-11 col-xs-11 col-sm-11" style="padding-left: 0px;padding-right: 0px;">
        {!! Form::label('lugar_procedencia_id', 'Lugar Procedencia:') !!}
        {!! Form::select('lugar_procedencia_id',$LugarProcedencia, old('lugar_procedencia_id'), ['class' => 'form-control chosen-select']) !!}
    </div>
    <div class="col-md-1 col-xs-1 col-sm-1" style="margin-top: 7px;padding-left: 0px; padding-right: 0px;">
        <br>
        <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#lp"><i class="fa fa-plus"></i></a>
    </div>
</div>

<!-- Vendedor Id Field -->
<div class="form-group col-sm-6" style="z-index: 1">
    <div class="col-md-11 col-xs-11 col-sm-11" style="padding-left: 0px;padding-right: 0px;">
    {!! Form::label('vendedor_id', 'Vendedor:') !!}
    {!! Form::select('vendedor_id',$Vendedores, null, ['class' => 'form-control chosen-select']) !!}
    </div>
    <div class="col-md-1 col-xs-1 col-sm-1" style="margin-top: 7px;padding-left: 0px; padding-right: 0px;">
        <br>
        <a href="#" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#ve"><i class="fa fa-plus"></i></a>
    </div>
</div>

<!-- Comprador Id Field -->
<div class="form-group col-sm-6" style="z-index: 1">
    <div class="col-md-11 col-xs-11 col-sm-11" style="padding-left: 0px;padding-right: 0px;">
    {!! Form::label('comprador_id', 'Comprador:') !!}
    {!! Form::select('comprador_id',$Compradores, null, ['class' => 'form-control chosen-select']) !!}
    </div>
    <div class="col-md-1 col-xs-1 col-sm-1" style="margin-top: 7px;padding-left: 0px; padding-right: 0px;">
        <br>
        <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#co"><i class="fa fa-plus"></i></a>
    </div>
</div>

<!-- Responsable Id Field -->
<div class="form-group col-sm-6" style="z-index: 1">
    <div class="col-md-12 col-xs-12 col-sm-12" style="padding-left: 0px;padding-right: 0px;">
    {!! Form::label('empresas_id', 'Empresa:') !!}
    {!! Form::select('empresas_id',$empresa, null, ['class' => 'form-control chosen-select']) !!}
    </div>
</div>

<div class="form-group col-sm-2" style="z-index: 1">
    <div class="col-md-11 col-xs-11 col-sm-11" style="padding-left: 0px;padding-right: 0px;">
    {!! Form::label('tipo_compras_id', 'Tipo de Compra:') !!}
    {!! Form::select('tipo_compras_id',$tipo_compras, null, ['class' => 'form-control chosen-select']) !!}
    </div>
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-2" style="z-index: 1">
    {!! Form::label('pregunta_licencias_id', 'Licencia?') !!}
    {!! Form::select('pregunta_licencias_id',$Pregunta_licencia, null, ['class' => 'form-control chosen-select']) !!}
</div>


<!-- Estado Id Field -->
<div class="form-group col-sm-3" style="z-index: 1" id="c">
    {!! Form::label('codigo', 'Codigo de asentamiento:') !!}
     {!! Form::text('codigo', null, ['class' => 'form-control','required' => 'true','placeholder' => 'Codigo de asentamiento','value' => old('codigo')]) !!}
</div>


<!-- Estado Id Field -->
<div class="form-group col-sm-5" style="z-index: 1" id="d">
    {!! Form::label('documento', 'Documento asentamiento de licencia:') !!}
     {!! Form::file('documento', null, ['class' => 'form-control','required' => 'true','placeholder' => 'documento','value' => old('documento')]) !!}
</div>

<!--
<div class="form-group col-sm-6" style="z-index: 0">
    
     <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
        <h5 style="font-weight: bold;">Elija un hierro</h5>
        @foreach ($Hierro as $Hierro)
            @if ($registroCompra === 0)
                <div class="form-group col-sm-2 col-xs-3" style="text-align: center;">
                    <input type="radio" name="hierro_id" value="{{$Hierro->id}}"><img width="100%" src="{{ Storage::url($Hierro->hierro) }}" >
                </div>    
            @else
                <div class="form-group col-sm-2 col-xs-3" style="text-align: center;">
                    <?php
                        $rc=$registroCompra->hierro_id;
                        $h=$Hierro->id;
                        if($rc==$h){
                    ?>
                        <input type="radio" name="hierro_id" value="{{$Hierro->id}}" checked="checked"><img width="100%" src="{{ Storage::url($Hierro->hierro) }}" >
                    <?php
                        }else{
                    ?>
                        <input type="radio" name="hierro_id" value="{{$Hierro->id}}"><img width="100%" src="{{ Storage::url($Hierro->hierro) }}" >
                    <?php
                        }
                    ?>
                </div>
            @endif
        @endforeach
    </div>

</div>
-->
<br><br><br>

<script>
    $(function() {
        $('#pregunta_licencias_id').change(function(event) {
            if($('#pregunta_licencias_id').val()==1){
                mostrar();
            }else{
                ocultar();
            }
        });
    });

    function mostrar(){
        $('#c').show();
        $('#d').show();
        $("#documento").attr("required", "true");
        $("#codigo").attr("required", "true");
        $('#c').val('');
        $('#d').val('');
    }
    function ocultar(){
        $('#c').hide();
        $('#d').hide();
        $("#documento").removeAttr("required");
        $("#codigo").removeAttr("required");
        $('#c').val('');
        $('#d').val('');
    }
</script>

<!-- Submit Field -->
<div class="form-group col-sm-12 col-xs-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('registroCompras.index') !!}" class="btn btn-danger btn-fw"><i class="mdi mdi-close"></i>Cancelar</a>
</div>

</div></div></div></div>










