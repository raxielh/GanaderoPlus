<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Descripcion</th>
            <th width="90px">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($lugarProcedencias as $lugarProcedencia)
        <tr>
            <td>{!! $lugarProcedencia->descripcion !!}</td>
            <td width="10%">
                {!! Form::open(['route' => ['lugarProcedencias.destroy', $lugarProcedencia->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('lugarProcedencias.edit', [$lugarProcedencia->id]) !!}" class='btn btn-default btn-xs'><i class="mdi mdi-pencil"></i></a>
                    {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div></div></div>