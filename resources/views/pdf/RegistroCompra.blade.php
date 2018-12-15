<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body style="font-size:8px;margin:0px;padding:0px">
<div style="width: 100%">
    <section class="content-header">
        <div style="display: none;">
        @foreach ($registroCompras as $rcc)
            {{ $tipo=$rcc->tipo_compras_id }}
        @endforeach
        </div>
    </section>

                @foreach ($registroCompras as $rc)
                   <div class="content">
                        <div class="clearfix"></div>

                        @include('flash::message')

                        <div class="clearfix"></div>
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-12">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 style="text-align: center;font-weight: bold;">Numero de Registro de Compra ( {{($rc->numero_compra)}} )</h4>
                                      <h4 class="card-title" style="color: #3ca2e0">Información General de compra
                                          @if ($rc->tipo_compras_id  === 2)
                                            Uno a Uno
                                          @else
                                            Global
                                          @endif
                                      </h4>
                                      <div class="row">
                                        @foreach ($registroCompras as $registroCompras)
                                        <table class="table table-striped">
                                            <tr>
                                                <td><strong>Fecha compra: </strong> {{$registroCompras->fecha_compra}}</td>
                                                <td><strong>Lugar procedencias: </strong> {{$registroCompras->lugar_procedencias}}</td>
                                                <td><strong>Vendedor: </strong> {{$registroCompras->vendedor}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Comprador: </strong> {{$registroCompras->comprador}}</td>
                                                <td><strong>Empresa: </strong> {{$registroCompras->razon_social}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Direccion: </strong> {{$registroCompras->direccion_v}}</td>
                                                <td><strong>Contacto: </strong> {{$registroCompras->contacto_v}}</td>
                                                <td></td>
                                            </tr>
                                        </table>
                                        @endforeach
                                      </div>

                                      <div class="box box-primary" style="width: 100%">
                                        <div class="box-body">
                                          <table class="table table-striped">
                                            <tbody>
                                              <tr>
                                                <th>Tipo Ganado</th>
                                                <th>Cantidad</th>
                                                <th>Peso Promedio</th>
                                                <th>Peso Total</th>
                                                <th>Precio</th>
                                                <th>Valor total lote</th>
                                                <th>Deducción</th>
                                                <th>Valor Deducción</th>
                                                <th>Deducción</th>
                                                <th>Valor a Pagar</th>
                                              </tr>
                                              @php
                                                $total=0;
                                              @endphp
                                              @foreach ($estadistica as $estadistica)
                                              @php
                                                  $total=$total+$estadistica->valor_pagar;
                                              @endphp
                                              <tr>
                                                <td>{{$estadistica->tipo}}</td>
                                                <td>{{$estadistica->numer_gan}}</td>
                                                <td>{{number_format($estadistica->prome_peso)}}</td>
                                                <td>{{number_format($estadistica->peso_total)}}</td>
                                                <td>{{number_format($estadistica->precio_kilo)}}</td>
                                                <td>{{number_format($estadistica->valor_total)}}</td>
                                                <td>{{$estadistica->descdeducion}}</td>
                                                <td>{{number_format($estadistica->deduccion,2)}}</td>
                                                <td>{{number_format($estadistica->descuento)}}</td>
                                                <td>{{number_format($estadistica->valor_pagar)}}</td>
                                              </tr>
                                              @endforeach
                                              <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong>Total</strong></td>
                                                <td><strong>{{number_format($total)}}</strong></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>


                                        <?php $suma_pesos_total=0; ?>
                                        <?php $suma_pesos_promedio=0; ?>
                                      <?php $cl=$compra_lote;
                                      $pesos = array();
                                      $cantidad = array();
                                      ?>
                                      <?php $y=0 ?>
                                      @foreach ($compra_lote as $compra_lote)
                                      <?php $y=$y+1; ?>
                                      <p style="margin-top: 10px;font-weight: bold">Lote de {{$compra_lote->descripcion}}</p>
                                            <table class="table">
                                              <thead>
                                                <tr>
                                                  <th style="text-align: center;" style="padding:0px">No</th>
                                                  <th style="text-align: center;" style="padding:0px">Peso</th>
                                                  <th style="text-align: center;" style="padding:0px">Observaciones</th>
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
                                                  <td width="5%" style="padding:0px">{{$x=$x+1}}</td>
                                                  <?php $suma_pesos=$suma_pesos+$lote->peso; ?>
                                                  <td style="padding:0px">{{number_format($lote->peso)}}</td>
                                                  <td style="padding:0px">{{$lote->observaciones}}</td>
                                                  <td width="10%" style="padding:0px">
                                                  </td>
                                                  @endif
                                                  @endforeach
                                                </tr>
                                              </tbody>
                                            </table>

                                            <?php $suma_pesos;array_push($pesos,$suma_pesos);array_push($cantidad,$x); ?>
                                            <p style="text-align: right;margin-bottom: -3px;"><strong>Peso Acumulado (kilos): </strong> {{number_format($suma_pesos)}}</p>
                                            <p style="text-align: right;margin-bottom: -3px;"><strong>Valor del Lote: </strong> {{number_format($compra_lote->precio*$suma_pesos)}}</p>
                                            <?php $suma_pesos_total=$suma_pesos_total+$suma_pesos; ?>

                                            <?php if($x<>0){ ?>
                                            <p style="text-align: right;margin-bottom: -3px;"><strong>Peso Promedio: </strong> {{number_format($peso_promedio=$suma_pesos/$x)}}</p>
                                            <?php $suma_pesos_promedio=$suma_pesos_promedio+$peso_promedio; ?>
                                            <?php } ?>
                                            <p style="text-align: right;margin-bottom: -3px;" ><strong>Cantidad Animales :</strong> {{$x}}</p>
                                            <p style="text-align: right;margin-bottom: -3px;"><strong>Precio del Kilo: </strong> {{number_format($compra_lote->precio)}}</p>
                                            <p style="text-align: right;margin-bottom: -3px;"><strong>Deduccion: </strong>
                                              <?php if($compra_lote->deduccions_id==1){echo '%';}else{echo '$';} ?>
                                              {{number_format($compra_lote->deduccion)}}</p>
                                            <p style="text-align: right;margin-bottom: -3px;"><strong>Observaciones: </strong><br> {{($compra_lote->observaciones)}}</p>
                                            <br>




                                      @endforeach





                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>

                    </div>


                @endforeach
</div>
</body>
</html>
