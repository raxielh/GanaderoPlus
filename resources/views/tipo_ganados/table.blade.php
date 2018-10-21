<table class="table table-responsive" id="tipoGanados-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tipoGanados as $tipoGanado)
        <tr>
            <td>{!! $tipoGanado->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['tipoGanados.destroy', $tipoGanado->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tipoGanados.edit', [$tipoGanado->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>