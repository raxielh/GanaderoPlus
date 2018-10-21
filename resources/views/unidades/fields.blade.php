<!-- Descripcion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('descripcion', 'Descripcion:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
</div>

<!-- Corta Field -->
<div class="form-group col-sm-6">
    {!! Form::label('corta', 'Corta:') !!}
    {!! Form::text('corta', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('unidades.index') !!}" class="btn btn-danger">Cancelar</a>
</div>
