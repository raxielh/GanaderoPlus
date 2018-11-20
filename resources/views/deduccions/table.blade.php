<table class="table table-responsive" id="deduccions-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($deduccions as $deduccion)
        <tr>
            <td>{!! $deduccion->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['deduccions.destroy', $deduccion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('deduccions.show', [$deduccion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('deduccions.edit', [$deduccion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>