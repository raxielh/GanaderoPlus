<!-- Medicamento Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medicamento_id', 'Medicamento:') !!}
    {!! Form::select('medicamento_id',$medicamentos, null, ['class' => 'form-control']) !!}
</div>

<!-- Precio Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::number('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::number('cantidad', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('compraMedicamentos.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
<script>
    $(function()
    {
        llenar_precio($( "#medicamento_id" ).val());
        
        $( "#medicamento_id" ).change(function() {
            llenar_precio($( "#medicamento_id" ).val());
        });

    });
    
    function llenar_precio(id){
        var url="/api/buscar/precio/medicamento/"+id;
        $.getJSON(url, function( data ) {
            $( "#precio" ).val(data[0].precio);
        });
    }

</script>