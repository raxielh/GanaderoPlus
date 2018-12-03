@foreach ($ingresoAnimal as $ingresoAnimal)
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <p><strong>Fecha de Ingreso:</strong> {!! $ingresoAnimal->fecha !!}</p>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="form-group">
            <p><strong>Numero de Compra:</strong> {!! $ingresoAnimal->numero_compra !!}</p>
        </div>
    </div>
</div>
@endforeach

<div class="row">
    @php
        $c_lote=0;
    @endphp


            <div class="box-body table-responsive no-padding" style="padding:1em !important" >
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>Tipo Ganado</th>
                    <th>Cantidad</th>
                    <th>Peso Promedio</th>
                    <th>Peso Total</th>
                    <th>Precio</th>
                    <th>Valor total lote</th>
                  </tr>
                  @php
                      $total=0;
                      $c=0;
                      $p=0;
                  @endphp
                  @foreach ($lotes as $lote)
                  @php
                      $total=$total+$lote->valor_total;
                      $c=$c+$lote->numer_gan;
                      $p=$p+$lote->peso_total;
                  @endphp
                  <tr>
                    <td>{{$lote->descripcion}}</td>
                    <td>{{$lote->numer_gan}}</td>
                    <td>{{number_format($lote->prome_peso)}}</td>
                    <td>{{number_format($lote->peso_total)}}</td>
                    <td>{{number_format($lote->precio_kilo)}}</td>
                    <td>{{number_format($lote->valor_total)}}</td>
                  </tr>
                  @endforeach
                  <tr>
                    <td><strong>Cantidad de Animales</strong></td>
                    <td><strong>{{number_format($c)}}</strong></td>
                    <td><strong>Peso Total</strong></td>
                    <td><strong>{{number_format($p)}}</strong></td>
                    <td><strong>Total</strong></td>
                    <td><strong>{{number_format($total)}}</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Animales Ingresados</strong></td>
                    <td><strong>{{number_format($animales_ingresados)}}</strong></td>
                  </tr>
                  <tr>
                    <td><strong>Faltan por Ingresar</strong></td>
                    <td><strong>{{number_format($c-$animales_ingresados)}}</strong></td>
                  </tr>
                </tbody>
              </table>
            </div>





</div>

<div class="row">
    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_lote"><i class="mdi mdi-plus"></i> Crear Lote</button>
</div>
<hr>
<div class="row">

<?php $y=0; ?>
@foreach ($lotes2 as $lotes2)
<?php $y=$y+1; ?>

<div class="col-md-3 col-sm-3 col-xs-3"style="border: 1px solid #eee;">

    <div id="btn-{!! $lotes2->id !!}">
        {!! Form::open(['route' => ['ingreso.destroy', $lotes2->id], 'method' => 'delete']) !!}
        <input type="hidden" name="lote" value="{{$lotes2->id}}">
        {!! Form::button('<i class="mdi mdi-delete"></i> Borrar este lote', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Estas seguro de borrar este lote?')"]) !!}
        {!! Form::close() !!}
    </div>


    @if ($c-$animales_ingresados>0)
        <h5 class="modal-title">Nuevo Animal</h5>
        {!! Form::open(['route' => 'add_ingreso_ganado']) !!}
            <div class="form-group">
                <input type="number" name="peso" required="" placeholder="Peso en Kilos" class="form-control" value="{{old('peso')}}" id="<?php echo 'p'.$y;?>">
                <script>document.getElementById("<?php echo 'p'.$y;?>").focus();</script>
                <textarea name="observaciones" placeholder="Observaciones" class="form-control"></textarea>
                <input type="hidden" name="detalle_ingreso1" value="{!! $lotes2->id !!}">
                <input type="hidden" name="registro_compra" value="{!! $lotes2->registro_compra_lote_id !!}">
                <div style="margin-top: 10px"></div>
                {!! Form::submit('Agregar', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    @endif

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
                @foreach ($animales as $a)

                    @if ($a->detalle_ingreso_animals_id===$lotes2->id)
                        <tr>
                            <td>{{$x=$x+1}}</td>
                            <td>{{$a->peso}}</td>
                            <td>{{$a->observaciones}}</td>
                            <td width="10%">
                            {!! Form::open(['route' => ['animal_ingreso.destroy', $a->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                            {!! Form::close() !!}
                            </td>
                        </tr>
                        <script>
                            $('#btn-{!! $lotes2->id !!}').hide();
                        </script>
                    @endif

                @endforeach
                </tbody>
            </table>
            <table class="table">
                <tr>
                    <td><strong>Peso</strong></td>
                    <td>{{$a->peso}}</td>
                    <td width="10%">
                </tr>
                <tr>
                    <td><strong>Cantidad</strong></td>
                    <td>{{$x}}</td>
                    <td width="10%">
                </tr>
                <tr>
                    <td><strong>Peso P</strong></td>
                    <td>{{$a->peso}}</td>
                    <td width="10%">
                </tr>
            </table>
        </div>





</div>
@endforeach

</div>







<div id="add_lote" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xs">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Crear nuevo lote</h4>
            </div>
            <div class="modal-body">
              {!! Form::open(['route' => 'ingresar_ganado']) !!}
                <div class="form-group">
                  {!! Form::label('tipo_ganado', 'Tipo de Ganado:') !!}
                  {!! Form::select('tipo_ganado',$tipo_ganado, null, ['class' => 'form-control','required'=>'true']) !!} <br>
                  {!! Form::label('potreros', 'Potreros:') !!}
                  {!! Form::select('potreros',$potreros, null, ['class' => 'form-control','required'=>'true']) !!} <br>
                  <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones"></textarea>
                  <br>
                  <input type="hidden" name="registro_compra_lote" value="{{$ingresoAnimal->id}}">
                  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                  <a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</a>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
