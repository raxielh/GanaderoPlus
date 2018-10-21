@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h4 class="pull-left">Control LLuvias Resumen</h4>
    </section>
    <div class="content">

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <a href="{!! route('controlLLuvias.index') !!}" class="btn btn-default">Atras</a>
                
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <div id="chart_div"></div>
                
                    <div class="box-header" style="margin-top: 1em;">
                        <h3 class="box-title">Tabla de datos</h3>
                    </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th>Año</th>
                                    <th>Mes</th>
                                    <th>Cantidad</th>
                                </tr>
                                @foreach ($resumen_table as $r)
                                <tr>
                                    <th style="font-weight: lighter;">{{ $r->ano }}</th>
                                    <th style="font-weight: lighter;">
                                    <?php 
                                        if($r->mes==1){ echo'Enero'; }
                                        if($r->mes==2){ echo'Febrero'; }
                                        if($r->mes==3){ echo'Marzo'; }
                                        if($r->mes==4){ echo'Abril'; }
                                        if($r->mes==5){ echo'Mayo'; }
                                        if($r->mes==6){ echo'Junio'; }
                                        if($r->mes==7){ echo'Julio'; }
                                        if($r->mes==8){ echo'Agosto'; }
                                        if($r->mes==9){ echo'Septiembre'; }
                                        if($r->mes==10){ echo'Octubre'; }
                                        if($r->mes==11){ echo'Noviembre'; }
                                        if($r->mes==12){ echo'Diciembre'; }
                                    ?>
                                    </th>
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
                            data.addColumn('string', 'Mes');
                            data.addColumn('number', 'Cantidad');

                            data.addRows([
                                @foreach ($resumen as $resumen)
                                    <?php 
                                        if($resumen->to_char==1){ $mes='Enero'; }
                                        if($resumen->to_char==2){ $mes='Febrero'; }
                                        if($resumen->to_char==3){ $mes='Marzo'; }
                                        if($resumen->to_char==4){ $mes='Abril'; }
                                        if($resumen->to_char==5){ $mes='Mayo'; }
                                        if($resumen->to_char==6){ $mes='Junio'; }
                                        if($resumen->to_char==7){ $mes='Julio'; }
                                        if($resumen->to_char==8){ $mes='Agosto'; }
                                        if($resumen->to_char==9){ $mes='Septiembre'; }
                                        if($resumen->to_char==10){ $mes='Octubre'; }
                                        if($resumen->to_char==11){ $mes='Noviembre'; }
                                        if($resumen->to_char==12){ $mes='Diciembre'; }
                                    ?>
                                    ['{{ $mes }}',{{ $resumen->cantidad }}],
                                @endforeach
                            ]);

                            var options = {
                                hAxis: {
                                    viewWindow: {
                                        min: 0.5,
                                    },
                                    title: 'Mes',
                                },
                                vAxis: {
                                    title: 'Cantidad'
                                }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

                            chart.draw(data, options);
                        }
                </script>            
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

