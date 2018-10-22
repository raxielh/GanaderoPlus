@foreach ($ingresoAnimal as $ingresoAnimal)
<div class="col-md-4 col-sm-4 col-xs-4">
    <div class="form-group">
        {!! Form::label('fecha', 'Fecha de Ingreso:') !!}
        <p>{!! $ingresoAnimal->fecha !!}</p>
    </div>  
</div>
<div class="col-md-4 col-sm-4 col-xs-4">
    <div class="form-group">
        {!! Form::label('fecha', 'Potrero:') !!}
        <p>{!! $ingresoAnimal->potreros !!}</p>
    </div>  
</div>
<div class="col-md-4 col-sm-4 col-xs-4">
    <div class="form-group">
        {!! Form::label('fecha', 'Numero de Factura:') !!}
        <p>{!! $ingresoAnimal->factura !!}</p>
    </div>  
</div>
@endforeach

@foreach ($compra_lote as $compra_lote)
    <div class="col-md-4 col-sm-4" style="border-right: 1px solid #33333347;">
        <div style="display: block;">
            <p style="margin-top: 10px;font-weight: bold">Lote de {{$compra_lote->descripcion}}</p>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_lote_ganado_{{ $compra_lote->id}}"><i class="mdi mdi-plus"></i>Agregar Animal</button>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Peso</th>
                            <th style="text-align: center;">Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=0; ?>
                        @foreach ($detalle as $d)
                            @if ($d->registro_compra_lote_id==$compra_lote->id)
                                <tr>
                                    <td width="5%">{{$x=$x+1}}</td>
                                    <td>{{$d->peso}}</td>
                                    <td>{{$d->observaciones}}</td>
                                      <td width="10%">
                                      {!! Form::open(['route' => ['ingreso.destroy', $d->id], 'method' => 'delete']) !!}
                                          {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                                      {!! Form::close() !!}
                                      </td>
                                </tr>
                            @endif
                        @endforeach
                   </tbody>
                </table>
            </div>

        </div>
    </div>
    
    <div id="add_lote_ganado_{{ $compra_lote->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xs">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Ingresar Animal</h4>
                              </div>
                              <div class="modal-body">
                                {!! Form::open(['route' => 'ingresar_ganado']) !!}
                                  <div class="form-group">
                                    <input type="number" name="peso" autofocus required="" placeholder="Peso" class="form-control">
                                    <textarea name="observaciones" placeholder="Observaciones" class="form-control"></textarea>
                                    <input type="hidden" name="registro_compra_lote" value="{{$compra_lote->id}}">
                                    <div style="margin-top: 10px"></div>
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                    <a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</a>
                                  </div>
                                {!! Form::close() !!}
                              </div>
                            </div>
        </div>
    </div>
@endforeach


