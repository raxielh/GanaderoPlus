<table class="table table-responsive" id="estadoAnimals-table">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estadoAnimals as $estadoAnimal)
        <tr>
            <td>{!! $estadoAnimal->descripcion !!}</td>
            <td>
                {!! Form::open(['route' => ['estadoAnimals.destroy', $estadoAnimal->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('estadoAnimals.show', [$estadoAnimal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('estadoAnimals.edit', [$estadoAnimal->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>