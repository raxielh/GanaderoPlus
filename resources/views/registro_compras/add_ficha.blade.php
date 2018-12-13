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
                            <div class="col-md-4">
                                <p><strong>Fecha compra: </strong> {{$registroCompras->fecha_compra}}</p>
                                <p><strong>Lugar procedencias: </strong> {{$registroCompras->lugar_procedencias}}</p>
                                <p><strong>Vendedor: </strong> {{$registroCompras->vendedor}}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Direccion: </strong> {{$registroCompras->direccion_v}}</p>
                                <p><strong>Contacto: </strong> {{$registroCompras->contacto_v}}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>Comprador: </strong> {{$registroCompras->comprador}}</p>
                                <p><strong># Factura: </strong> {{$registroCompras->factura}}</p>
                                <p><strong>Empresa: </strong> {{$registroCompras->razon_social}}</p>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add_lote"><i class="mdi mdi-plus"></i> Crear Lote</button>
                                <?php if($registroCompras->documento){ ?>
                                <a href="{{ env('APP_URL') }}{{ Storage::url($registroCompras->documento) }}" class="btn btn-info btn-sm" target="_new">Ver Documento {{ ($registroCompras->codigo) }}</a>
                                <?php } ?>
                            </div>
                        @endforeach
                      </div>

                      <div class="box box-primary" style="margin-top: 1em">
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

                      <div class="row" style="margin-top: 1em">
                        <?php $suma_pesos_total=0; ?>
                        <?php $suma_pesos_promedio=0; ?>
                      <?php $cl=$compra_lote;
                      $pesos = array();
                      $cantidad = array();
                      ?>
                      <?php $y=0 ?>
                      @foreach ($compra_lote as $compra_lote)
                      <?php $y=$y+1; ?>
                        <div class="col-md-4 col-sm-4" style="border-right: 1px solid #33333347;border-bottom: 1px solid #33333347;height: 600px;overflow: scroll">
                          <div style="display: block;">
                            <p style="margin-top: 10px;font-weight: bold">Lote de {{$compra_lote->descripcion}}</p>

                              @if ($rc->tipo_compras_id  === 2)


                                      <h6 class="modal-title">Nuevo Animal</h6>

                                      {!! Form::open(['route' => 'add_lote_ganado']) !!}
                                        <div class="form-group">
                                          <input type="number" name="peso" required="" placeholder="Peso en Kilos" class="form-control" value="{{old('peso')}}" id="<?php echo 'p'.$y;?>">
                                          <script>
                                            document.getElementById("<?php echo 'p'.$y;?>").focus();
                                          </script>
                                          <textarea name="observaciones" placeholder="Observaciones" class="form-control"></textarea>
                                          <input type="hidden" name="lote" value="{{$compra_lote->id}}">
                                          <input type="hidden" name="registro_compra" value="{{$rc->id}}">
                                          <div style="margin-top: 10px"></div>
                                          {!! Form::submit('Agregar', ['class' => 'btn btn-primary']) !!}
                                        </div>
                                      {!! Form::close() !!}

                                      {!! Form::open(['route' => ['lote.destroy', $compra_lote->id], 'method' => 'delete']) !!}
                                          <input type="hidden" name="lote" value="{{$compra_lote->id}}">
                                          <input type="hidden" name="registro_compra" value="{{$rc->id}}">
                                        {!! Form::button('<i class="mdi mdi-delete"></i> Borrar lote', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Estas seguro de borrar este lote?')"]) !!}
                                      {!! Form::close() !!}


                              @else


                              {!! Form::open(['route' => ['lote.destroy', $compra_lote->id], 'method' => 'delete']) !!}
                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_lote_ganado_{{ $compra_lote->id}}"><i class="mdi mdi-plus"></i>Agregar Animal</button>
                              {!! Form::button('<i class="mdi mdi-delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Estas seguro de borrar este lote?')"]) !!}

                            {!! Form::close() !!}
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
                                          <input type="number" name="peso" autofocus required="" placeholder="Peso Total en Kilos" class="form-control">
                                          <input type="number" name="cantidad" required="" placeholder="Cantidad" class="form-control">
                                          <input type="hidden" name="lote" value="{{$compra_lote->id}}">
                                          <input type="hidden" name="registro_compra" value="{{$rc->id}}">
                                          <div style="margin-top: 10px"></div>
                                          {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                          <a href="#" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-close"></i> Cerrar</a>
                                        </div>
                                      {!! Form::close() !!}
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @endif


                          </div>


                          <div>
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
                                  <td>{{number_format($lote->peso)}}</td>
                                  <td>{{$lote->observaciones}}</td>
                                  <td width="10%">
                                  {!! Form::open(['route' => ['animal.destroy', $lote->id], 'method' => 'delete']) !!}
                                                                            <input type="hidden" name="lote" value="{{$compra_lote->id}}">
                                          <input type="hidden" name="registro_compra" value="{{$rc->id}}">
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
                            <div>
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
                <input type="number" name="precio" value="" placeholder="Precio por Kilo" class="form-control" required=""><br>

                <div class="form-group col-sm-6" style="z-index: 1">
                    <div class="col-md-11 col-xs-11 col-sm-11" style="padding-left: 0px;padding-right: 0px;">
                        {!! Form::label('deduccions_id', 'Tipo de Deduccion:') !!}
                        {!! Form::select('deduccions_id',$deduccion, old('deduccions_id'), ['class' => 'form-control chosen-select']) !!}
                    </div>
                </div>

                <!-- Estado Id Field -->
                <div class="form-group col-sm-6" style="z-index: 1">
                    {!! Form::label('deduccion', 'Deduccion:') !!}
                    <input type="text" name="deduccion_v" id="deduccion_v" class="form-control" required="true" placeholder="Deduccion" value="{{old('deduccion')}}" onkeyup="format(this)">

                    {!! Form::hidden('deduccion', null, ['class' => 'form-control']) !!}

                </div>






                <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones"></textarea>
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

@endforeach

<script>
  $(function() {
    $('.register-form').hide();
    $('.login-form').show();
  });
</script>
<script>
    $(function() {

        var de=$("#deduccion").val();
        $("#deduccion_v").val(format2(de));

        $('#delete_factura').click(function(event) {
            $("#documento_factura").val(null);
        });

        $('#delete_documento').click(function(event) {
            $("#documento").val(null);
        });

        if($('#deduccions_id').val()==1){
            console.log(1);
            $("#deduccion_v").attr("placeholder", "Porcentaje deduccion");
        }else{
            console.log(2);
            $("#deduccion_v").attr("placeholder", "Valor deduccion");
        }

        $('#deduccions_id').change(function(event) {
            $("#deduccion_v").val('');
            $("#deduccion").val('');
            if($('#deduccions_id').val()==1){
                console.log(1);
                $("#deduccion_v").attr("placeholder", "Porcentaje deduccion");
            }else{
                console.log(2);
                $("#deduccion_v").attr("placeholder", "Valor deduccion");
            }
        });

        if($('#pregunta_licencias_id').val()==1){
            mostrar();
        }else{
            ocultar();
        }


        if($('#pregunta_facturas_id').val()==1){
            $('#f').show();
            $('#df').show();
            $('#f').val('');
            $('#df').val('');
        }else{
            $('#f').hide();
            $('#df').hide();
            $('#f').val('');
            $('#df').val('');
        }
        $('#pregunta_licencias_id').change(function(event) {
            if($('#pregunta_licencias_id').val()==1){
                $('#c').show();
                $('#d').show();
                $('#c').val('');
                $('#d').val('');
            }else{
                $('#c').hide();
                $('#d').hide();
                $('#c').val('');
                $('#d').val('');
            }
        });
        $('#pregunta_facturas_id').change(function(event) {
            if($('#pregunta_facturas_id').val()==1){
                $('#f').show();
                $('#df').show();
                $('#f').val('');
                $('#df').val('');
            }else{
                $('#f').hide();
                $('#df').hide();
                $('#f').val('');
                $('#df').val('');
            }
        });
    });

    function mostrar(){
        $('#c').show();
        $('#d').show();
        $('#c').val('');
        $('#d').val('');
    }
    function ocultar(){
        $('#c').hide();
        $('#d').hide();
        $('#c').val('');
        $('#d').val('');
    }

    function format(input)
    {

        if($('#deduccions_id').val()==1){
            $('#deduccion').val($('#deduccion_v').val());
        }else{
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                $('#deduccion').val(num);
                num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                input.value = num;
            }else{ alert('Solo se permiten numeros');
                input.value = input.value.replace(/[^\d\.]*/g,'');
                $('#deduccion').val('');
            }
        }

    }
    function format2(input)
    {
        if($('#deduccions_id').val()==1){
            var d=$('#deduccion').val();
            return d;
        }else{
            var num = input;
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/,'');
            return num;
        }
    }
</script>
@endsection

