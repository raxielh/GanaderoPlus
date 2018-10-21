<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
<!-- Hierro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hierro', 'Hierro:') !!}
    {!! Form::file('hierro', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('hierros.index') !!}" class="btn btn-danger btn-fw"><i class="mdi mdi-close"></i>Cancelar</a>
</div>
</div></div></div>