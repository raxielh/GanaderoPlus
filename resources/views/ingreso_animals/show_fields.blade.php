@foreach ($ingresoAnimal as $ingresoAnimal)
<div class="row">
    <div class="col-md-6 col-sm-4 col-xs-6">
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
                </tbody>
              </table>
            </div>





</div>

<div class="row">
    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_lote"><i class="mdi mdi-plus"></i> Crear Lote</button>






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
                  <br>
                  {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                  <a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</a>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
