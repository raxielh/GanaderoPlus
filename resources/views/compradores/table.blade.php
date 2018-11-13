<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>No. de identidad o Nit de la empresa</th>
        <th>Direccion</th>
        <th>Contacto</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($compradores as $compradores)
        <tr>
            <td>{!! $compradores->nombre !!}</td>
            <td>{!! $compradores->identificacion !!}</td>
            <td>{!! $compradores->direccion !!}</td>
            <td>{!! $compradores->contacto !!}</td>
            <td width="10%">
                {!! Form::open(['route' => ['compradores.destroy', $compradores->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('compradores.edit', [$compradores->id]) !!}" class='btn btn-default btn-xs'><i class="mdi mdi-pencil"></i></a>
                    {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div></div></div>