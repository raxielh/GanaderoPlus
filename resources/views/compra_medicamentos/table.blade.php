<table class="table table-responsive" id="compraMedicamentos-table">
    <thead>
        <tr>
            <th>Precio</th>
        <th>Cantidad</th>
        <th>Fecha</th>
        <th>Medicamento</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($compraMedicamentos as $compraMedicamento)
        <tr>
            <td>{!! $compraMedicamento->precio !!}</td>
            <td>{!! $compraMedicamento->cantidad !!}</td>
            <td>{!! $compraMedicamento->fecha !!}</td>
            <td>{!! $compraMedicamento->medicamentos !!}</td>
            <td>
                {!! Form::open(['route' => ['compraMedicamentos.destroy', $compraMedicamento->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('compraMedicamentos.show', [$compraMedicamento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('compraMedicamentos.edit', [$compraMedicamento->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>