@foreach ($medicamentos as $medicamentos)
<div class="col-md-3">
    <!-- Id Field -->
    <div class="form-group">
        {!! Form::label('id', 'Id:') !!}
        <p>{!! $medicamentos->id !!}</p>
    </div>

    <!-- Descripcion Field -->
    <div class="form-group">
        {!! Form::label('descripcion', 'Descripcion:') !!}
        <p>{!! $medicamentos->descripcion !!}</p>
    </div>

    <!-- Tipo Medicamentos Id Field -->
    <div class="form-group">
        {!! Form::label('tipo_medicamentos_id', 'Tipo Medicamentos:') !!}
        <p>{!! $medicamentos->tipo_medicamentos !!}</p>
    </div>

    <!-- Valor Field -->
    <div class="form-group">
        {!! Form::label('valor', 'Valor:') !!}
        <p>{!! $medicamentos->precio !!}</p>
    </div>

    <!-- Presentacion Field -->
    <div class="form-group">
        {!! Form::label('presentacion', 'Presentacion:') !!}
        <p>{!! $medicamentos->presentacion !!}</p>
    </div>

    <!-- Unidad Field -->
    <div class="form-group">
        {!! Form::label('unidad', 'Unidad:') !!}
        <p>{!! $medicamentos->unidades !!}</p>
    </div>

    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $medicamentos->created_at !!}</p>
    </div>

    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $medicamentos->updated_at !!}</p>
    </div>
    <a href="{!! route('medicamentos.index') !!}" class="btn btn-default">Atras</a>
</div>
@endforeach
<div class="col-md-9">
    <h4>Dosificaciones</h4>
    {!! Form::open(['route' => 'dosificaciones.store']) !!}

        @include('dosificaciones.fields')

    {!! Form::close() !!}
    <div class="clearfix"></div>
    <div class="box-body table-responsive no-padding">
        @include('dosificaciones.table')
    </div>
</div>
