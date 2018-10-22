@extends('layouts.app')

@section('content')

<style>
p {
    margin-top: 0;
    margin-bottom: 5px;
}
table td {
  padding: 1px 1px !important;
  text-align: center;
}
</style>
<section class="content-header">
  <h4 class="pull-left"><a href="{!! route('registroCompras.index') !!}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Atras</a> Registro de Compra</h4> 
  <div style="display: none;">
  @foreach ($registroCompras as $rcc)
    {{ $tipo=$rcc->tipo_compras_id }}
  @endforeach  
  </div>

</section>

@foreach ($registroCompras as $rc)

@if ($rc->tipo_compras_id  === 2)

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title" style="color: #3ca2e0">Información General de compra</h4>
                      <div class="row">
                        @foreach ($registroCompras as $registroCompras)
                            <div class="col-md-3">
                                <p><strong>Fecha compra: </strong> {{$registroCompras->fecha_compra}}</p>
                                <p><strong>Lugar procedencias: </strong> {{$registroCompras->lugar_procedencias}}</p>
                                <p><strong>Vendedor: </strong> {{$registroCompras->vendedor}}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Direccion: </strong> {{$registroCompras->direccion_v}}</p>
                                <p><strong>Contacto: </strong> {{$registroCompras->contacto_v}}</p>
                                <p><strong>Deduccion: </strong> {{$registroCompras->deduccion}}%</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Comprador: </strong> {{$registroCompras->comprador}}</p>
                                <p><strong># Factura: </strong> {{$registroCompras->factura}}</p>
                                <p><strong>Empresa: </strong> {{$registroCompras->razon_social}}</p>
                            </div>
                            <div class="col-md-3" style="text-align: center;">
                                <p><img height="60px" src="{{ Storage::url($registroCompras->logo) }}"> <img height="60px" src="{{ Storage::url($registroCompras->hierro) }}"></p>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_lote"><i class="mdi mdi-plus"></i> Crear Lote</button>
                            </div>
                        @endforeach
                      </div>
                      
                      <div class="row" style="margin-top: 1em">
                        <?php $suma_pesos_total=0; ?>
                        <?php $suma_pesos_promedio=0; ?>
                      <?php $cl=$compra_lote; 
                      $pesos = array();
                      $cantidad = array();
                      ?>
                      
                      @foreach ($compra_lote as $compra_lote)
                        <div class="col-md-4 col-sm-4" style="border-right: 1px solid #33333347;">
                          <div style="display: block;">
                            <p style="margin-top: 10px;font-weight: bold">Lote de {{$compra_lote->descripcion}}</p>
                            {!! Form::open(['route' => ['lote.destroy', $compra_lote->id], 'method' => 'delete']) !!}
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_lote_ganado_{{ $compra_lote->id}}"><i class="mdi mdi-plus"></i>Agregar Animal</button>
                              {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Estas seguro de borrar este lote?')"]) !!}
                            {!! Form::close() !!}
                          </div>


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
                                <?php $suma_pesos=0; ?>
                                <?php $lg=$CompraLoteGanado; ?>
                                @foreach ($CompraLoteGanado as $lote)
                                @if ($lote->compra_lote_id==$compra_lote->id)
                                <tr>
                                  <td width="5%">{{$x=$x+1}}</td>
                                  <?php $suma_pesos=$suma_pesos+$lote->peso; ?>
                                  <td>{{$lote->peso}}</td>
                                  <td>{{$lote->observaciones}}</td>
                                  <td width="10%">
                                  {!! Form::open(['route' => ['animal.destroy', $lote->id], 'method' => 'delete']) !!}
                                      {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                                  {!! Form::close() !!}
                                  </td>
                                  @endif
                                  @endforeach
                                </tr>
                                <tr>
                                  <td></td><td></td><td></td>
                                </tr>
                              </tbody>
                            </table>
                            <div style="display: none;">
                            <?php $suma_pesos;array_push($pesos,$suma_pesos);array_push($cantidad,$x); ?>
                            <p style="text-align: center;margin-bottom: -3px;display: none;"><strong>Peso Acumulado (kilos): </strong> {{number_format($suma_pesos)}}</p>
                            <p style="text-align: center;margin-bottom: -3px;display: none;"><strong>Valor del Lote: </strong> {{number_format($compra_lote->precio*$suma_pesos)}}</p>
                            <?php $suma_pesos_total=$suma_pesos_total+$suma_pesos; ?>

                            <?php if($x<>0){ ?>
                            <p style="text-align: center;margin-bottom: -3px;display: none;"><strong>Peso Promedio: </strong> {{$peso_promedio=$suma_pesos/$x}}</p>
                            <?php $suma_pesos_promedio=$suma_pesos_promedio+$peso_promedio; ?>
                            <?php } ?>
                            <p style="text-align: center;margin-bottom: -3px;" style="display: none;"><strong>Cantidad Animales :</strong> {{$x}}</p>
                            <p style="text-align: center;margin-bottom: -3px;" style="display: none;"><strong>Precio del Kilo: </strong> {{number_format($compra_lote->precio)}}</p>
                            </div>
                          </div>
                        </div>

                        <div id="add_lote_ganado_{{ $compra_lote->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-xs">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Nuevo Animal</h4>
                              </div>
                              <div class="modal-body">
                                {!! Form::open(['route' => 'add_lote_ganado']) !!}
                                  <div class="form-group">
                                    <input type="number" name="peso" autofocus required="" placeholder="Peso" class="form-control">
                                    <textarea name="observaciones" placeholder="Observaciones" class="form-control"></textarea>
                                    <input type="hidden" name="registro_compra" value="{{$compra_lote->id}}">
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


                      </div>


                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
          <div class="box-body table-responsive no-padding">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th>Tipo Ganado</th>
                  <th>Cantidad</th>
                  <th>Peso Promedio</th>
                  <th>Peso Total</th>
                  <th>Precio</th>
                  <th>Valor total lote</th>
                  <th>% Deducción</th>
                  <th>Deducción</th>
                  <th>No. Factura</th>
                  <th>Valor a Pagar</th>
                </tr>
                <?php $c=0; ?>
                @foreach ($cl as $cl)

                      <tr>
                        <td>{{$cl->descripcion}}</td>
                        <td>{{$cantidad[$c]}}</td>
                        <td>
                          <?php
                            if($cantidad[$c]==0){
                              echo 0;
                            }else{
                              echo number_format($pesos[$c]/$cantidad[$c]);
                            }
                          ?>
                        </td>
                        <td>{{$pesos[$c]}}</td>
                        <td>{{number_format($cl->precio)}}</td>
                        <td>{{number_format($cl->precio*$pesos[$c])}}</td>
                        <td>{{$registroCompras->deduccion}}</td>
                        <td>{{number_format($cl->precio*$pesos[$c]*$registroCompras->deduccion/100)}}</td>
                        <td>{{$registroCompras->factura}}</td>
                        <td>{{number_format($cl->precio*$pesos[$c]-$cl->precio*$pesos[$c]*$registroCompras->deduccion/100)}}</td>
                        
                      </tr>
                      
                      <?php $c=$c+1; ?>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <div id="add_lote" class="modal fade" role="dialog">
      <div class="modal-dialog modal-xs">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Crear nuevo lote</h4>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => 'add_lote']) !!}
              <div class="form-group">
                {!! Form::label('tipo_ganado', 'Tipo de Ganado:') !!}
                {!! Form::select('tipo_ganado',$tipo_ganado, null, ['class' => 'form-control','required'=>'true']) !!} <br>
                <input type="number" name="precio" value="" placeholder="Precio por Kilo" class="form-control" required="">
                <input type="hidden" name="registro_compra" value="{{$registroCompras->id}}">
                <br>
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</a>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
@else


    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title" style="color: #3ca2e0">Información General de compra</h4>
                      <div class="row">
                        @foreach ($registroCompras as $registroCompras)
                            <div class="col-md-3">
                                <p><strong>Fecha compra: </strong> {{$registroCompras->fecha_compra}}</p>
                                <p><strong>Lugar procedencias: </strong> {{$registroCompras->lugar_procedencias}}</p>
                                <p><strong>Vendedor: </strong> {{$registroCompras->vendedor}}</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Direccion: </strong> {{$registroCompras->direccion_v}}</p>
                                <p><strong>Contacto: </strong> {{$registroCompras->contacto_v}}</p>
                                <p><strong>Deduccion: </strong> {{$registroCompras->deduccion}}%</p>
                            </div>
                            <div class="col-md-3">
                                <p><strong>Comprador: </strong> {{$registroCompras->comprador}}</p>
                                <p><strong># Factura: </strong> {{$registroCompras->factura}}</p>
                                <p><strong>Empresa: </strong> {{$registroCompras->razon_social}}</p>
                            </div>
                            <div class="col-md-3" style="text-align: center;">
                                <p><img height="60px" src="{{ Storage::url($registroCompras->logo) }}"> <img height="60px" src="{{ Storage::url($registroCompras->hierro) }}"></p>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_lote"><i class="mdi mdi-plus"></i> Crear Lote</button>
                            </div>
                        @endforeach
                      </div>
                      
                      <div class="row" style="margin-top: 1em">
                        <?php $suma_pesos_total=0; ?>
                        <?php $suma_pesos_promedio=0; ?>
                      <?php $cl=$compra_lote; 
                      $pesos = array();
                      $cantidad = array();
                      ?>
                      
                      @foreach ($compra_lote as $compra_lote)
                        <div class="col-md-4 col-sm-4" style="border-right: 1px solid #33333347;">
                          <div style="display: block;">
                            <p style="margin-top: 10px;font-weight: bold">Lote de {{$compra_lote->descripcion}}</p>
                            {!! Form::open(['route' => ['lote.destroy', $compra_lote->id], 'method' => 'delete']) !!}
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_lote_ganado_{{ $compra_lote->id}}"><i class="mdi mdi-plus"></i>Agregar Animales</button>
                              {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Estas seguro de borrar este lote?')"]) !!}
                            {!! Form::close() !!}
                          </div>


                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th style="text-align: center;">No</th>
                                  <th style="text-align: center;">Peso</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $x=0; ?>
                                <?php $suma_pesos=0; ?>
                                <?php $lg=$CompraLoteGanado; ?>
                                @foreach ($CompraLoteGanado as $lote)
                                @if ($lote->compra_lote_id==$compra_lote->id)
                                <tr>
                                  <td width="5%">{{$x=$x+1}}</td>
                                  <?php $suma_pesos=$lote->peso; ?>
                                  <td>{{$lote->peso}}</td>
                                  <td width="10%">
                                  {!! Form::open(['route' => ['animal.destroy', $lote->id], 'method' => 'delete']) !!}
                                      {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas seguro?')"]) !!}
                                  {!! Form::close() !!}
                                  </td>
                                  @endif
                                  @endforeach
                                </tr>
                                <tr>
                                  <td></td><td></td><td></td>
                                </tr>
                              </tbody>
                            </table>
                            <div style="display: none;">
                            <?php $suma_pesos;array_push($pesos,$suma_pesos);array_push($cantidad,$x); ?>
                            <p style="text-align: center;margin-bottom: -3px;display: block;"><strong>Peso Acumulado (kilos): </strong> {{($suma_pesos)}}</p>
                            <p style="text-align: center;margin-bottom: -3px;display: block;"><strong>Valor del Lote: </strong> {{number_format($compra_lote->precio*$suma_pesos)}}</p>
                            <?php $suma_pesos_total=$suma_pesos_total+$suma_pesos; ?>

                            <?php if($x<>0){ ?>
                            <p style="text-align: center;margin-bottom: -3px;display: block;"><strong>Peso Promedio: </strong> {{$peso_promedio=$suma_pesos/$x}}</p>
                            <?php $suma_pesos_promedio=$suma_pesos_promedio+$peso_promedio; ?>
                            <?php } ?>
                            <p style="text-align: center;margin-bottom: -3px;" style="display: block;"><strong>Cantidad Animales :</strong> {{$x}}</p>
                            <p style="text-align: center;margin-bottom: -3px;" style="display: block;"><strong>Precio del Kilo: </strong> {{number_format($compra_lote->precio)}}</p>
                            </div>
                          </div>
                        </div>

                        <div id="add_lote_ganado_{{ $compra_lote->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog modal-xs">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Nuevo Animal</h4>
                              </div>
                              <div class="modal-body">
                                {!! Form::open(['route' => 'add_lote_ganado']) !!}
                                  <div class="form-group">
                                    <input type="hidden" name="tipo" value="{{ $tipo }}">
                                    <input type="number" name="peso" autofocus required="" placeholder="Peso Total" class="form-control">
                                    <input type="number" name="cantidad" required="" placeholder="Cantidad" class="form-control">
                                    <input type="hidden" name="registro_compra" value="{{$compra_lote->id}}">
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


                      </div>


                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="box box-primary">
          <div class="box-body table-responsive no-padding">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th>Tipo Ganado</th>
                  <th>Cantidad</th>
                  <th>Peso Promedio</th>
                  <th>Peso Total</th>
                  <th>Precio</th>
                  <th>Valor total lote</th>
                  <th>% Deducción</th>
                  <th>Deducción</th>
                  <th>No. Factura</th>
                  <th>Valor a Pagar</th>
                </tr>
                <?php $c=0; ?>
                @foreach ($cl as $cl)

                      <tr>
                        <td>{{$cl->descripcion}}</td>
                        <td>{{$cantidad[$c]}}</td>
                        <td>
                          <?php
                            if($cantidad[$c]==0){
                              echo 0;
                            }else{
                              echo number_format($pesos[$c]/$cantidad[$c]);
                            }
                          ?>
                        </td>
                        <td>{{$pesos[$c]}}</td>
                        <td>{{number_format($cl->precio)}}</td>
                        <td>{{number_format($cl->precio*$pesos[$c])}}</td>
                        <td>{{$registroCompras->deduccion}}</td>
                        <td>{{number_format($cl->precio*$pesos[$c]*$registroCompras->deduccion/100)}}</td>
                        <td>{{$registroCompras->factura}}</td>
                        <td>{{number_format($cl->precio*$pesos[$c]-$cl->precio*$pesos[$c]*$registroCompras->deduccion/100)}}</td>
                        
                      </tr>
                      
                      <?php $c=$c+1; ?>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>

    </div>

    <div id="add_lote" class="modal fade" role="dialog">
      <div class="modal-dialog modal-xs">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Crear nuevo lote</h4>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => 'add_lote']) !!}
              <div class="form-group">
                {!! Form::label('tipo_ganado', 'Tipo de Ganado:') !!}
                {!! Form::select('tipo_ganado',$tipo_ganado, null, ['class' => 'form-control','required'=>'true']) !!} <br>
                <input type="text" name="precio" value="" placeholder="Precio base" class="form-control" required="">
                <input type="hidden" name="registro_compra" value="{{$registroCompras->id}}">
                <br>
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</a>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>

@endif
@endforeach    

    
@endsection

