<!-- Dia Field -->
<div class="form-group col-sm-2">
    {!! Form::label('dia', 'Dia:') !!}
    {!! Form::date('dia', date('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!-- Cantidad Field -->
<div class="form-group col-sm-2">
    {!! Form::label('cantidad', 'Cantidad:') !!}
    {!! Form::text('cantidad', null, ['class' => 'form-control','placeholder' => 'En milimetros']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('controlLLuvias.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
