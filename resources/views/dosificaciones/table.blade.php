<table class="table table-responsive" id="dosificaciones-table">
    <thead>
        <tr>
            <th>Peso Inicial</th>
        <th>Peso Final</th>
        <th>Dosis</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($dosificaciones as $dosificaciones)
        <tr>
            <td>{!! $dosificaciones->peso_inicial !!}</td>
            <td>{!! $dosificaciones->peso_final !!}</td>
            <td>{!! $dosificaciones->dosis !!}</td>
            <td>
                {!! Form::open(['route' => ['dosificaciones.destroy', $dosificaciones->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>