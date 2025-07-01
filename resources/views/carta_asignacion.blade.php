<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta de Asignación de Equipo</title>
    <style>
        /*
         * Global styles for the PDF layout:
         * - Clean and professional appearance
         * - Highlight section, tables, and signature format
        */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 40px;
            border: 1px solid #ddd;
            padding: 20px;
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 3px solid #003366;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }

        h2 {
            color: #003366;
            text-align: center;
            margin-bottom: 10px;
        }

        .highlight {
            background-color: #ffcc00;
            padding: 8px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }

        .info-table, .device-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-bottom: 20px;
        }

        .info-table th, .info-table td,
        .device-table th, .device-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .info-table th, .device-table th {
            background-color: #003366;
            color: white;
            text-transform: uppercase;
        }

        h4 {
            color: #003366;
            margin-bottom: 5px;
        }

        .terms {
            font-size: 13px;
            text-align: justify;
            margin-top: 20px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .signature-table th, .signature-table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        .signature-table th {
            background-color: #f4f4f4;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>

    <!-- Header section: displays current timestamp for document traceability -->
    <div class="header">
        <div>&nbsp;</div>
        <div>{{ \Carbon\Carbon::now()->format('D M d Y H:i:s T') }}</div>
    </div>

    <h2>Carta de Asignación de Equipo</h2>

    <!-- Visual highlight for drawing attention to important policy notice -->
    <div class="highlight">
        Leer detenidamente - <i>Política de uso de dispositivos tecnológicos.</i>
    </div>

    <!-- User information table. Filled dynamically from controller-provided variables -->
    <table class="info-table">
        <tr><th>Nombre</th><td>{{ $nombreUsuario }}</td></tr>
        <tr><th>User ID</th><td>{{ $userId }}</td></tr>
        <tr><th>Email</th><td>{{ $email }}</td></tr>
        <tr><th>Puesto</th><td>{{ $position }}</td></tr>
        <tr><th>Ubicación</th><td>{{ $location }}</td></tr>
        <tr><th>Centro de Costo</th><td>{{ $costCenter }}</td></tr>
        <tr><th>Supervisor</th><td>{{ $supervisor }}</td></tr>
        <tr><th>Fecha Aceptación</th><td>{{ $fechaAceptacion }}</td></tr>
    </table>

    <h3 style="color:#003366;">Lista de Dispositivos Asignados</h3>

    <!-- Loop through the assigned devices array to show each one in a table -->
    @foreach ($assigned_devices as $index => $device)
        <h4>Dispositivo #{{ $index + 1 }}</h4>
        <table class="device-table">
<thead>
<tr>
    <th>Descripción</th>
    <th>Asset Tag</th>
    <th>Número de Serie</th>
    <th>Accesorio</th>
</tr>
</thead>
<tbody>
<tr>
    <td>{{ $device['display_name'] ?? 'N/A' }}</td>
    <td>{{ $device['asset_tag'] ?? 'N/A' }}</td>
    <td>{{ $device['serial_number'] ?? 'N/A' }}</td>
    <td>{{ $device['accesorio'] ?? 'N/A' }}</td>
</tr>
</tbody>


        </table>
    @endforeach

    @if (!empty($retired_devices))
    <h3 style="color:#003366;">Lista de Dispositivos Retirados</h3>

    @foreach ($retired_devices as $index => $device)
        <h4>Dispositivo Retirado #{{ $index + 1 }}</h4>
        <table class="device-table">
<thead>
<tr>
    <th>Descripción</th>
    <th>Asset Tag</th>
    <th>Número de Serie</th>
    <th>Accesorio</th>
</tr>
</thead>
<tbody>
<tr>
    <td>{{ $device['display_name'] ?? 'N/A' }}</td>
    <td>{{ $device['asset_tag'] ?? 'N/A' }}</td>
    <td>{{ $device['serial_number'] ?? 'N/A' }}</td>
    <td>{{ $device['accesorio'] ?? 'N/A' }}</td>
</tr>
</tbody>


        </table>
    @endforeach
@endif

    <!-- Declaration and acknowledgment section regarding device usage policy -->
    <p class="terms">
        Por medio de la presente declaro que he recibido los dispositivos tecnológicos antes mencionados,
        los cuales se me han asignado para el desempeño de mis funciones.<br><br>
        Asumo la responsabilidad de su guarda y cuidado, y me comprometo a cumplir con
        la <b>Política de uso de Dispositivos Tecnológicos</b> definida por la empresa.
    </p>

    <!-- Link to the official policy document stored on Google Drive -->
    <p>
        <b>Política de uso de Dispositivos Tecnológicos:</b><br>
        <a href="https://drive.google.com/open?id=1ns1BJsclUz1vrURq5zEoMuI0-MKR6a6Lq">
            https://drive.google.com/open?id=1ns1BJsclUz1vrURq5zEoMuI0-MKR6a6Lq
        </a>
    </p>

    <!-- Signature confirmation section -->
    <table class="signature-table">
        <tr>
            <th>Nombre</th>
            <th>Aceptación</th>
            <th>Fecha</th>
        </tr>
        <tr>
            <td>{{ $nombreUsuario }}: {{ $email }}</td>
            <td>Estoy de acuerdo</td>
            <td>{{ $fechaAceptacion }}</td>
        </tr>
        <tr>
            <td colspan="2">Nombre y firma de quien firma de aceptación:</td>
            <td>Fecha de aceptación:</td>
        </tr>
    </table>

    <div class="footer">
        Documento generado automáticamente. Para más información, contactar al área de TI.
    </div>

</body>
</html>
