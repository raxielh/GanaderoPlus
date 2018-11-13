<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Area mts2</th>
                        <th>Estado</th>
                        <th width="90px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php $x=0; ?>
                @foreach($potreros as $potreros)
                <?php $x=$x+$potreros->area; ?>
                    <tr>
                        <td>{!! $potreros->codigo !!}</td>
                        <td>{!! $potreros->area !!}</td>
                        <td>{!! $potreros->descripcion !!}</td>
                        <td  width="10%">
                            {!! Form::open(['route' => ['potreros.destroy', $potreros->id], 'method' => 'delete']) !!}
                            <div class='btn-group'>
                                <a href="{!! route('potreros.edit', [$potreros->id]) !!}" class='btn btn-default btn-xs'><i class="mdi mdi-pencil"></i></a>
                                {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger  btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                      <td><strong>Total</strong></td>
                      <td><?php echo $x; ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

