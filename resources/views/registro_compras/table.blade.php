<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
    <thead>
        <tr>
            <th width="85px">Fecha</th>
            <th width="85px">Factura</th>
            <th>Procedencia</th>
            <th>Vendedor</th>
            <th>Comprador</th>
            <th>Empresa</th>
            <th width="75px">Estado</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($registroCompras as $registroCompra)
        <tr>
            <td>{!! $registroCompra->fecha_compra !!}</td>
            <td>{!! $registroCompra->factura !!}</td>
            <td>{!! $registroCompra->lugar_procedencias !!}</td>
            <td>{!! $registroCompra->vendedor !!}</td>
            <td>{!! $registroCompra->comprador !!}</td>
            <td>{!! $registroCompra->razon_social !!}</td>
            <td>
                {{$registroCompra->estado_compra}}
            </td>
            <td>
                {!! Form::open(['route' => ['registroCompras.destroy', $registroCompra->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{{ env('APP_URL') }}/registroCompras/ficha/{{$registroCompra->id}}/ver" class='btn btn-default btn-xs'><i class="mdi mdi-eye"></i></a>
                    <a href="{!! route('registroCompras.edit', [$registroCompra->id]) !!}" class='btn btn-default btn-xs'><i class="mdi mdi-pencil"></i></a>
                    {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div></div></div>

