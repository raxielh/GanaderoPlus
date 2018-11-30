<table class="table table-responsive" id="ingresoAnimals-table">
    <thead>
        <tr>
            <th>Fecha</th>
        <th>Registro de Compra</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($ingresoAnimals as $ingresoAnimal)
        <tr>
            <td>{!! $ingresoAnimal->fecha !!}</td>
            <td>{!! $ingresoAnimal->numero_compra!!}</td>
            <td>
                {!! Form::open(['route' => ['ingresoAnimals.destroy', $ingresoAnimal->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ingresoAnimals.show', [$ingresoAnimal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('ingresoAnimals.edit', [$ingresoAnimal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
