<table class="table table-responsive" id="presentacions-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($presentacions as $presentacion)
        <tr>
            <td>{!! $presentacion->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['presentacions.destroy', $presentacion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('presentacions.show', [$presentacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('presentacions.edit', [$presentacion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
