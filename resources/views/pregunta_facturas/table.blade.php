<table class="table table-responsive" id="preguntaFacturas-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($preguntaFacturas as $preguntaFacturas)
        <tr>
            <td>{!! $preguntaFacturas->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['preguntaFacturas.destroy', $preguntaFacturas->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('preguntaFacturas.show', [$preguntaFacturas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('preguntaFacturas.edit', [$preguntaFacturas->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>