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
                                <h4 style="text-align:center">Peso Ahora</h4>
                                <img src="{{URL::asset('img/animal.png')}}" width="25%" alt="">
                            </div>
                            <table class="table" style="background:#ffff" >
                                    <thead>
                                        <tr>
                                            <th scope="" style="padding: 5px;">#</th>
                                            <th scope="col" style="padding: 5px;">Peso</th>
                                            <th scope="col" style="padding: 5px;">Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=0;$p=0; @endphp
                                        @foreach($animales as $a)
                                        <tr>
                                            <th style="padding: 5px;">
                                                @php  echo $x=$x+1; @endphp
                                            </th>
                                            <td style="padding: 5px;">{{$a->peso}}</td>
                                            @php
                                                $p=$p+$a->peso;
                                            @endphp
                                            <td style="padding: 5px;">{{$a->observaciones}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <table class="table" style="background:#ffff" >
                                    <tbody>
                                        <tr>
                                            <th style="padding: 5px;width: 90px">
                                                Peso Total
                                            </th>
                                            <td style="padding: 5px;">{{$p}}</td>
                                            <td style="padding: 5px;"></td>
                                        </tr>
                                    </tbody>
                                </table>
                    </div>
            </div>
            <div class="col-md-6">
                <div style="padding:2em">
                        <div style="text-align:center">
                                <h4 style="text-align:center">Peso Antes</h4>
                                <img src="{{URL::asset('img/animal.png')}}" width="25%" alt="">
                            </div>
                        <table class="table" style="background:#ffff" >
                            <thead>
                                <tr>
                                    <th scope="" style="padding: 5px;">#</th>
                                    <th scope="col" style="padding: 5px;">Peso</th>
                                    <th scope="col" style="padding: 5px;">Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x=0;$p=0; @endphp
                                @foreach($animales as $a)
                                <tr>
                                    <th style="padding: 5px;">
                                        @php  echo $x=$x+1; @endphp
                                    </th>
                                    <td style="padding: 5px;">{{$a->peso}}</td>
                                    @php
                                        $p=$p+$a->peso;
                                    @endphp
                                    <td style="padding: 5px;">{{$a->observaciones}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table" style="background:#ffff" >
                            <tbody>
                                <tr>
                                    <th style="padding: 5px;width: 90px">
                                        Peso Total
                                    </th>
                                    <td style="padding: 5px;">{{$p}}</td>
                                    <td style="padding: 5px;"></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>

        </div>





    </div>
@endsection

