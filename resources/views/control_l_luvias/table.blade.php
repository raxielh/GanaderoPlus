<table class="table table-responsive" id="controlLLuvias-table">
    <thead>
        <tr>
            <th>Dia</th>
        <th>Cantidad</th>
            <th  width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($controlLLuvias as $controlLLuvias)
        <tr>
            <td>{!! $controlLLuvias->dia !!}</td>
            <td>{!! $controlLLuvias->cantidad !!}</td>
            <td>
                {!! Form::open(['route' => ['controlLLuvias.destroy', $controlLLuvias->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('controlLLuvias.show', [$controlLLuvias->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('controlLLuvias.edit', [$controlLLuvias->id]) !!}" class='btn btn-default  btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>