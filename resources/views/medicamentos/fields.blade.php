<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Medicamentos Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_medicamentos_id', 'Tipo Medicamento:') !!}
    {!! Form::select('tipo_medicamentos_id', $tipo_medicamentos, null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('precio', 'Precio:') !!}
    {!! Form::text('precio', null, ['class' => 'form-control']) !!}
</div>

<!-- Presentacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presentacion', 'Presentacion:') !!}
    {!! Form::select('presentacion_id', $presentacion, null, ['class' => 'form-control']) !!}
</div>

<!-- Unidad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unidad_id', 'Unidad:') !!}
    {!! Form::select('unidad_id', $Unidades, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medicamentos.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
