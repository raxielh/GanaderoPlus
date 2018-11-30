<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    @if ($ingresoAnimal === 0)
        {!! Form::date('fecha', date('Y-m-d'), ['class' => 'form-control']) !!}
    @else
        {!! Form::date('fecha', \Carbon\Carbon::parse($ingresoAnimal->fecha)->format('Y-m-d'), ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Registro Compra Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('registro_compra_id', 'Registro de Compra:') !!}
    {!! Form::select('registro_compra_id',$compra, null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ingresoAnimals.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
