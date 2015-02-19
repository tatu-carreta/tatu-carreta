<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <body>
        <div style="max-width: 600px; font-family: sans-serif; font-size:16px; line-height:20px; padding:30px; color: #0E4B70">

            <img src="{{URL::to('images/jma.png')}}" style="width:100%">

            <!-- remitente -->
            <p style="font-weight:bold; font-size: 18px">CONSULTA:</p>
            <p>
                <strong>Nombre y Apellido: </strong>{{ $data['nombre'] }}<BR>
                <strong>Email: </strong>{{ $data['email'] }}<BR>
                @if(isset($data['telefono']))
                <strong>Teléfono: </strong>{{ $data['telefono'] }}<BR>
                @endif
                @if(isset($data['consulta']))
                <strong>Consulta: </strong>{{ $data['consulta'] }}
                @endif
            </p>
            <!-- datos empresa -->
            <div style="border-top:1px solid #ccc;">
                <p style="font-weight:bold; font-size: 18px">CONTÁCTENOS:</p>
                <p style="">
                    <strong>Teléfonos: </strong>Tel: (54 11) 4305-1788 / Fax:--<br>
                    <strong>Nextel: </strong>-- --<br>
                    <strong>Email: </strong>info@perfilesjma.com.ar<br>
                    <strong>Sitio web: </strong><a href="http://perfilesjma.com.ar/">www.perfilesjma.com.ar</a>
                </p>
            </div>
        </div>
    </body>
</html>