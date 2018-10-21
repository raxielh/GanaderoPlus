<!-- Peso Inicial Field -->
<div class="form-group col-sm-3">
    {!! Form::label('peso_inicial', 'Peso Inicial:') !!}
    {!! Form::text('peso_inicial', null, ['class' => 'form-control','placeholder' => 'Kilos']) !!}
</div>

<!-- Peso Final Field -->
<div class="form-group col-sm-3">
    {!! Form::label('peso_final', 'Peso Final:') !!}
    {!! Form::text('peso_final', null, ['class' => 'form-control','placeholder' => 'Kilos']) !!}
</div>

<!-- Dosis Field -->
<div class="form-group col-sm-3">
    {!! Form::label('dosis', 'Dosis:') !!}
    {!! Form::text('dosis', null, ['class' => 'form-control','placeholder'=>$medicamentos->unidades]) !!}
</div>
<input type="hidden" name="medicamento_id" value="{!! $medicamentos->id !!}">
<!-- Submit Field -->
<div class="form-group col-sm-3">
    {!! Form::label('Accion', 'Accion') !!}<br>
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>
