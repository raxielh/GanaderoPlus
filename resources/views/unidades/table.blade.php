<table class="table table-responsive" id="unidades-table">
    <thead>
        <tr>
            <th>Descripcion</th>
        <th>Corta</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($unidades as $unidades)
        <tr>
            <td>{!! $unidades->descripcion !!}</td>
            <td>{!! $unidades->corta !!}</td>
            <td>
                {!! Form::open(['route' => ['unidades.destroy', $unidades->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('unidades.show', [$unidades->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('unidades.edit', [$unidades->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
