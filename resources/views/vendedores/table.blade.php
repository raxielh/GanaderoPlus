<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
        <th>Identificacion</th>
        <th>Direccion</th>
        <th>Contacto</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($vendedores as $vendedores)
        <tr>
            <td>{!! $vendedores->nombre !!}</td>
            <td>{!! $vendedores->identificacion !!}</td>
            <td>{!! $vendedores->direccion !!}</td>
            <td>{!! $vendedores->contacto !!}</td>
            <td width="10%">
                {!! Form::open(['route' => ['vendedores.destroy', $vendedores->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('vendedores.edit', [$vendedores->id]) !!}" class='btn btn-default btn-xs'><i class="mdi mdi-pencil"></i></a>
                    {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div></div></div>