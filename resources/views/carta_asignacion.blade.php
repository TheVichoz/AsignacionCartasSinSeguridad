<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Firma de Aceptación de Dispositivo Tecnológico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
            padding: 0;
            line-height: 1.6;
            background-color: white;
            color: #000;
        }
        .header {
            font-size: 12px;
            text-align: right;
            margin-bottom: 10px;
            color: #666;
        }
        h2 {
            text-align: left;
            font-size: 20px;
            margin-bottom: 5px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        .data-row {
            margin-bottom: 4px;
        }
        .signature-block {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 30px;
        }
        .signature-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .small-text {
            font-size: 12px;
            color: #555;
        }
        a {
            color: #003366;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="header">
        {{ \Carbon\Carbon::now()->format('D M d Y H:i:s T') }}
    </div>

    <h2>Firma de aceptación de la asignación de Dispositivo Tecnológico</h2>

    <div class="section">
        <div class="section-title">Datos del Usuario</div>
        <div class="data-row">Nombre Completo: {{ $nombreUsuario }}</div>
        <div class="data-row">User ID: {{ $userId }}</div>
        <div class="data-row">Email: {{ $email }}</div>
        <div class="data-row">Puesto: {{ $position }}</div>
        <div class="data-row">Ubicación: {{ $location }}</div>
        <div class="data-row">Centro de Costo: {{ $costCenter }}</div>
        <div class="data-row">Supervisor: {{ $supervisor }}</div>
    </div>

    <div class="section">
        <div class="section-title">Datos de los Dispositivos Tecnológicos</div>
        @foreach ($assigned_devices as $index => $device)
            <div class="data-row">
                Equipo entregado #{{ $index + 1 }}:
                {{ $device['display_name'] ?? 'N/A' }},
                Asset Tag: {{ $device['asset_tag'] ?? 'N/A' }},
                Número de Serie: {{ $device['serial_number'] ?? 'N/A' }},
                Accesorio: {{ $device['accesorio'] ?? 'N/A' }}
            </div>
        @endforeach

        @if (!empty($retired_devices))
            @foreach ($retired_devices as $index => $device)
                <div class="data-row">
                    Equipo retirado #{{ $index + 1 }}:
                    {{ $device['display_name'] ?? 'N/A' }},
                    Asset Tag: {{ $device['asset_tag'] ?? 'N/A' }},
                    Número de Serie: {{ $device['serial_number'] ?? 'N/A' }},
                    Accesorio: {{ $device['accesorio'] ?? 'N/A' }}
                </div>
            @endforeach
        @endif
    </div>

    <div class="section">
        Por medio de la presente declaro que he recibido el(los) dispositivo(s) tecnológico(s) antes mencionado(s),
        los cuales se me han asignado para el desempeño de mis funciones.<br><br>
        Asumo la responsabilidad de su guarda y cuidado, y me comprometo a cumplir con la
        <b>Política de uso de Dispositivos Tecnológicos</b> definida por la empresa.
    </div>

    <div class="section">
        <b>Política de uso de Dispositivos Tecnológicos:</b><br>
        <a href="https://drive.google.com/open?id=1ns1BJsclUz1vrURq5zEoMuI0-MKR6a6Lq">
            https://drive.google.com/open?id=1ns1BJsclUz1vrURq5zEoMuI0-MKR6a6Lq
        </a>
    </div>

    <div class="signature-block">
        <div class="signature-row">
            <div>{{ $nombreUsuario }} : {{ $email }}</div>
            <div>Estoy de acuerdo</div>
            <div>{{ $fechaAceptacion }}</div>
        </div>
        <div class="signature-row">
            <div>Nombre y firma de quien firma de aceptación</div>
            <div>Fecha de aceptación</div>
        </div>
    </div>

</body>
</html>
