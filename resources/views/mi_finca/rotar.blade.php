@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <a href="{!! route('mi_finca.index') !!}" class="btn btn-danger">Atras</a>

        <div class="row">

            <div class="col-md-6">
                    <div style="padding:2em">
                            <div style="text-align:center">
                                <h4 style="text-align:center">Peso Antes</h4>
                                <img src="{{URL::asset('img/animal.png')}}" width="20%" alt="">
                            </div>
                            <table class="table" style="background:#ffff" >
                                    <thead>
                                        <tr>
                                            <th scope="" style="padding: 5px;">#</th>
                                            <th scope="col" style="padding: 5px;">Peso</th>
                                            <th scope="col" style="padding: 5px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=0;$p=0; @endphp
                                        @foreach($animales as $a)
                                        {!! Form::open(['route' => 'pesar']) !!}
                                        <tr>
                                            <th style="padding: 5px;">
                                                @php  echo $x=$x+1; @endphp
                                            </th>
                                            <td style="padding: 5px;">{{$a->peso}}</td>
                                            @php
                                                $p=$p+$a->peso;
                                            @endphp
                                            <td style="padding: 5px;" id="frm_{{ $x }}">


                                                    <input type="date"  placeholder="Fecha Pesaje" name="fecha" value="{{ date('Y-m-d') }}" required>
                                                    <input type="hidden" value="{{$a->id}}" name="ubicacion_animal_id" >
                                                    <input type="number" value="" placeholder="Peso kilo" name="peso_final" required autofocus>
                                                    <input type="hidden" value="{{$a->peso}}" placeholder="Peso kilo" name="peso_inicial">
                                                    <input type="hidden" value="{{$a->potreros_id}}" name="potrero_inicial">
                                                    <input type="hidden" value="{{$a->potreros_id}}" name="potrero_final">
                                                    <button type="submit" class="btn btn-sm btn-info">Pesar</button>



                                            </td>
                                        </tr>
                                        {!! Form::close() !!}
                                        @endforeach
                                    </tbody>
                                </table>
                            <table class="table" style="background:#ffff" >
                                    <tbody>
                                        <tr>
                                            <th style="padding: 5px;width: 90px">
                                                Peso Total
                                            </th>
                                            <td style="padding: 5px;">{{ number_format($p) }}</td>
                                            <td style="padding: 5px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                    </div>
            </div>
            <div class="col-md-6">
                <div style="padding:2em">
                        <div style="text-align:center">
                                <h4 style="text-align:center">Peso Ahora</h4>
                                <img src="{{URL::asset('img/animal.png')}}" width="20%" alt="">
                            </div>
                        <table class="table" style="background:#ffff" >
                            <thead>
                                <tr>
                                    <th scope="" style="padding: 5px;">#</th>
                                    <th scope="col" style="padding: 5px;">Peso Inicial</th>
                                    <th scope="col" style="padding: 5px;">Peso Final</th>
                                    <th scope="col" style="padding: 5px;">Fecha del Pesaje</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x=0;$p=0;$pf=0; @endphp
                                @foreach($existe as $e)
                                <tr>
                                    <th style="padding: 5px;">
                                        @php  echo $x=$x+1; @endphp
                                    </th>
                                    <td style="padding: 5px;">{{$e->peso_inicial}}</td>
                                    <td style="padding: 5px;">{{$e->peso_final}}</td>
                                    <td style="padding: 5px;">{{$e->fecha}}</td>
                                    @php
                                        $p=$p+$e->peso_inicial;
                                        $pf=$pf+$e->peso_final;
                                    @endphp
                                </tr>
                                <script>
                                    $(function () {
                                        $('#frm_{{ $x }}').hide();
                                        $('#frm_{{ $x+1 }}').focus();
                                    });
                                </script>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table" style="background:#ffff" >
                            <tbody>
                                <tr>
                                    <th style="padding: 5px;width: 140px">
                                        Peso Total Inicial
                                    </th>
                                    <td style="padding: 5px;">{{ number_format($p)}}</td>
                                </tr>
                                <tr>
                                    <th style="padding: 5px;width: 140px">
                                        Peso Total Final
                                    </th>
                                    <td style="padding: 5px;">{{ number_format( $pf)}}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div style="text-align:end">
                                {!! Form::open(['route' => 'pasar_lote']) !!}

                                @php
                                    if(count($existe)==0){

                                    }
                                    else{
                                        if(count($animales)===count($existe)){
                                @endphp

                                <div class="col-md-5">
                                    <input type="date"  placeholder="Fecha Rotacion" name="fecha_rotacion" value="{{ date('Y-m-d') }}" class="form-control" required>
                                </div>

                                <div class="col-md-5">
                                        <select name="potreros_id" class="form-control">
                                                @foreach($potreros as $po)
                                                <option value="{{$po->id}}">{{$po->codigo}}</option>
                                                @endforeach
                                        </select>
                                </div>

                                <div class="col-md-2">
                                        <input type="hidden" value="{{$a->potreros_id}}" name="potrero_inicial">
                                        <button type="submit" class="btn btn-xl btn-success">Rotar Lote</button>
                                </div>
                                @php
                                        }
                                    }
                                @endphp



                                {!! Form::close() !!}
                        </div>

                </div>


            </div>

        </div>





    </div>
@endsection

