<table class="table table-responsive" id="preguntaLicencias-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($preguntaLicencias as $preguntaLicencia)
        <tr>
            <td>{!! $preguntaLicencia->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['preguntaLicencias.destroy', $preguntaLicencia->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('preguntaLicencias.show', [$preguntaLicencia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('preguntaLicencias.edit', [$preguntaLicencia->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>