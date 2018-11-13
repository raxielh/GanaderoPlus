<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
                <div class="row">
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Identificacion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('identificacion', 'No. de identidad o Nit de la empresa:') !!}
    {!! Form::text('identificacion', null, ['class' => 'form-control']) !!}
</div>

<!-- Direccion Field -->
<div class="form-group col-sm-6">
    {!! Form::label('direccion', 'Direccion:') !!}
    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
</div>

<!-- Contacto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contacto', 'Contacto:') !!}
    {!! Form::text('contacto', null, ['class' => 'form-control','placeholder' => 'Telefono Fijo ó Celular']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('compradores.index') !!}" class="btn btn-danger btn-fw"><i class="mdi mdi-close"></i>Cancelar</a>
</div>
</div></div></div></div>