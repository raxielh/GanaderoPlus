<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

        @foreach ($registroCompras as $rc)
        <?php $tipo=$rc->tipo_compras_id ?>
        <div class="row">
            <div class="col-md-12" style="text-align: center;margin-top: 1em">{{$rc->razon_social}}</div>
        </div>
        <h6 style="text-align: center;">Registro de Compra ( {{$rc->numero_compra}} ) <br> {{$rc->fecha_compra}}</h6>
        @endforeach
        
        <div class="row">
            @foreach ($registroCompras as $registroCompras)

                <table style="font-size: 10px;" border="1" width="100%">
                    <tr>
                        <td><strong>Fecha compra:</strong></td>
                        <td style="text-align: left">{{$registroCompras->fecha_compra}}</td>
                        <td><strong>Lugar procedencias:</strong></td>
                        <td style="text-align: left">{{$registroCompras->lugar_procedencias}}</td>
                        <td><strong>Vendedor:</strong> </td>
                        <td style="text-align: left">{{$registroCompras->vendedor}}</td>
                    </tr>
                    <tr>
                        <td><strong>Direccion:</strong></td>
                        <td style="text-align: left">{{$registroCompras->direccion_v}}</td>
                        <td><strong>Contacto:</strong></td>
                        <td style="text-align: left">{{$registroCompras->contacto_v}}</td>
                        <td><strong>Deduccion:</strong> </td>
                        <td style="text-align: left">{{$registroCompras->deduccion}}</td>
                    </tr>
                    <tr>
                        <td><strong>Comprador:</strong></td>
                        <td style="text-align: left">{{$registroCompras->comprador}}</td>
                        <td><strong>#Factura:</strong></td>
                        <td style="text-align: left">{{$registroCompras->factura}}</td>
                        <td><strong>Empresa:</strong> </td>
                        <td style="text-align: left">{{$registroCompras->razon_social}}</td>
                    </tr>
                </table>
                

            @endforeach
        </div>
</body>
</html>
