@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4>
            Historico
        </h4>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    <a href="{!! route('medicamentos.index') !!}" class="btn btn-default">Atras</a>
                    
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <div id="chart_div"></div>
                    <div class="box-header" style="margin-top: 1em;">
                        <h3 class="box-title">Tabla de datos</h3>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                                @foreach ($precios as $r)
                                <tr>
                                    <th style="font-weight: lighter;">{{ $r->fecha }}</th>
                                    <th style="font-weight: lighter;">{{ $r->precio }}</th>
                                    <th style="font-weight: lighter;">{{ $r->cantidad }}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>                    
                     <script>
                        google.charts.load('current', {packages: ['corechart', 'line']});
                        google.charts.setOnLoadCallback(drawBasic);


                        function drawBasic() {

                                    var data = new google.visualization.DataTable();
                                    data.addColumn('string', 'Fecha');
                                    data.addColumn('number', 'Precio');

                                    data.addRows([
                                        @foreach ($precios as $precios)
                                            ['{{ $precios->fecha }}',{{ $precios->precio }}],
                                        @endforeach
                                    ]);

                                    var options = {
                                        hAxis: {
                                            viewWindow: {
                                                min: 0.5,
                                            },
                                            title: 'Fecha',
                                        },
                                        vAxis: {
                                            title: 'Precio'
                                        }
                                    };

                                    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                                    chart.draw(data, options);
                                }
                        </script>      
                </div>
            </div>
        </div>
    </div>
@endsection
