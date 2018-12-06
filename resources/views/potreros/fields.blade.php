<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
                <div class="row">
					<!-- Codigo Field -->
					<div class="form-group col-sm-6">
					    {!! Form::label('codigo', 'Nombre:') !!}
					    {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
					</div>

					<!-- Area Field -->
					<div class="form-group col-sm-6">
					    {!! Form::label('area', 'Area:') !!}
					    {!! Form::text('area', null, ['class' => 'form-control','placeholder'=>'mts2']) !!}
					</div>

					<div class="form-group col-sm-6">
                            {!! Form::label('cantidad_max', 'Cantidad maxima:') !!}
                            {!! Form::text('cantidad_max', null, ['class' => 'form-control','placeholder'=>'mts2']) !!}
                        </div>

					<!-- Estado Id Field -->
					<div class="form-group col-sm-6">
					    {!! Form::label('estado_id', 'Estado:') !!}
					    {!! Form::select('estado_id', $EstadoPotrero, null, ['class' => 'form-control chosen-select']) !!}
					</div>

					<!-- Submit Field -->
					<div class="form-group col-sm-12">
					    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
					    <a href="{!! route('potreros.index') !!}" class="btn btn-danger btn-fw"><i class="mdi mdi-close"></i>Cancelar</a>
					</div>

        	</div>
        </div>
    </div>
</div>
