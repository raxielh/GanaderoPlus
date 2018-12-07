@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="row">
            @foreach($potreros as $p)
            <div class="col-md-4">
                <div style="background: url({{URL::asset('img/pasto.jpg')}}) no-repeat center;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                height:250px;
                padding:1em;    border: 1px solid #0c7700;">
                    <h4 class="text-center">{!! $p->codigo !!} <br><span style="font-size:14px">({!! $p->area !!} mts2)</span></h4>
                    <h5 class="text-center">
                        Cantidad de Animales
                    </h5>
                    <div style="font-size: 26px;
                    width: 64px;
                    text-align: center;
                    margin: 0px auto;
                    background-color: #098e2d;
                    padding: 0.5em;
                    border-radius: 2em;
                    color: #ffff;
                    font-weight: bold;">

                    @foreach($potreros2 as $p2)
                        @if($p->id==$p2->potreros_id)
                            {{($p2->cantidad)}}
                        @endif
                    @endforeach
                    </div>
                </div>

                    @foreach($detalle_ingreso_animals as $dia)
                        @if($p->id==$dia->p_id)
@php
    $x=0;
    $suma=0;
@endphp
                        <table class="table" style="background:#ffff">
                            <thead>
                                <tr>
                                    <th scope="">#</th>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalle_ingreso_animals2 as $dia2)
                                @if($dia->id==$dia2->detalle_ingreso_animals_id)
                                <tr>
                                    <th>
                                        @php
                                            echo $x=$x+1;
                                            $suma=$suma+$dia2->peso;
                                        @endphp
                                    </th>
                                    <td>{{$dia2->peso}}</td>
                                    <td>{{$dia2->observaciones}}</td>
                                    <td>
                                        <select name="" id="">
                                            @foreach($potreros as $po)
                                            @if($dia->potreros_id==$po->id)
                                            @else
                                            <option value="{{$po->id}}">{{$po->codigo}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-warning">Transferir</button>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                <td>Peso Total</td>
                                <td><strong>{{number_format($suma)}}</strong></td>
                                </tr>
                                <tr>
                                        <td></td>
                                        <td></td>
                                    <td>Peso Promedio</td>
                                    <td><strong>{{number_format($suma/$x)}}</strong></td>
                                    </tr>
                            </tbody>
                        </table>



                    @endif
                @endforeach

            </div>
            @endforeach
        </div>


    </div>
@endsection

