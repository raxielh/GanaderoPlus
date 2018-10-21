<table class="table table-responsive" id="medicamentos-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Tipo Medicamentos</th>
        <th>Precio</th>
        <th>Presentacion</th>
        <th>Unidad</th>
            <th width="120px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($medicamentos as $medicamentos)
        <tr>
            <td>{!! $medicamentos->descripcion !!}</td>
            <td>{!! $medicamentos->tipo_medicamentos !!}</td>
            <td>{!! $medicamentos->precio !!}</td>
            <td>{!! $medicamentos->presentacion !!}</td>
            <td>{!! $medicamentos->unidades !!}</td>
            <td>
                {!! Form::open(['route' => ['medicamentos.destroy', $medicamentos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('medicamento.historial', [$medicamentos->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-area-chart"></i></a>
                    <a href="{!! route('medicamentos.show', [$medicamentos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('medicamentos.edit', [$medicamentos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>