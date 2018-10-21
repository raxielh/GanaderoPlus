<table class="table table-responsive" id="tipoMedicamentos-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tipoMedicamentos as $tipoMedicamentos)
        <tr>
            <td>{!! $tipoMedicamentos->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoMedicamentos.destroy', $tipoMedicamentos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoMedicamentos.show', [$tipoMedicamentos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tipoMedicamentos.edit', [$tipoMedicamentos->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
