<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
</head>
<body style="font-family: Arial, sans-serif; color: #202124; line-height:1.5;">

    <!--  
        Email Notification Template for Device Assignment

        This email is sent to the employee when a device assignment has been approved.
        It includes:
        - A message explaining the context of the assignment
        - A link to sign the delivery confirmation letter
        - Instructions for verifying device information

        Variables used:
        - $nombreUsuario: Recipient's name
        - $tipoAsignacion: Type of device assignment (e.g., new, temporary)
        - $user_id: ID used to identify the recipient
        - $encodedDevices: Base64-encoded JSON array of assigned devices
    -->
    
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

            <!--  
                Link to the signature form. 
                It includes the user_id as a route parameter and the list of devices as a base64 query string.
                This link opens the carta view and allows the user to confirm the assignment.
            -->
            <a href="{{ route('letter.view', ['user_id' => $user_id]) }}?devices={{ $encodedDevices }}" style="color:#1155cc; text-decoration:underline;">
                Link Firma de Aceptación
            </a>

            <br><br>
            Saludos.
        </li>
    </ul>

</body>
</html>
