<table class="table table-responsive" id="empresas-table">
    <thead>
        <tr>
            <th>Nit</th>
        <th>Razon Social</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Logo</th>
           <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($empresas as $empresa)
        <tr>
            <td>{!! $empresa->nit !!}</td>
            <td>{!! $empresa->razon_social !!}</td>
            <td>{!! $empresa->direccion !!}</td>
            <td>{!! $empresa->telefono !!}</td>
            <td><img width="100px" src="{{ Storage::url($empresa->logo) }}"></td>
            <td>
                {!! Form::open(['route' => ['empresas.destroy', $empresa->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('empresas.edit', [$empresa->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>