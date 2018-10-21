<table class="table table-responsive" id="estadoProtreros-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estadoProtreros as $estadoProtrero)
        <tr>
            <td>{!! $estadoProtrero->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['estadoProtreros.destroy', $estadoProtrero->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('estadoProtreros.edit', [$estadoProtrero->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>