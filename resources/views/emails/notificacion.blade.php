<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
</head>
<body style="font-family: Arial, sans-serif; color: #202124; line-height:1.5;">

    <ul>
        <li>
            Buen día, <strong>{{ $nombreUsuario }}</strong>.
            <br><br>

            En respuesta a la solicitud de <strong>{{ $tipoAsignacion }}</strong> de Dispositivo Tecnológico, 
            enviamos el formulario de entrega de los dispositivos solicitados, en el cual confirma de recibido y 
            acepta las políticas de uso.
            <br><br>

            En caso de alguna duda o comentario puede contactar al ingeniero que solicitó la carta.
            <br><br>

            Favor de firmar la carta una vez que el equipo sea entregado y se valide que el número de serie 
            coincida con los datos indicados en la carta, antes de proceder con el formulario.
            <br><br>

            <a href="{{ route('letter.view', ['user_id' => $user_id]) }}?devices={{ $encodedDevices }}&tipo_asignacion={{ urlencode($tipoAsignacion) }}" style="color:#1155cc; text-decoration:underline;">
                Link Firma de Aceptación
            </a>

            <br><br>
            Saludos.
        </li>
    </ul>

</body>
</html>
