<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta de Asignación de Equipo</title>

    <!-- Link to Bootstrap styles -->
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">

    <style>
        /* Global styles for PDF or web rendering */
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            background-color: #f9f9f9;
            padding: 30px;
        }

        .container {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 30px;
            max-width: 850px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 10px;
        }

        .highlight {
            background-color: #ffcc00;
            padding: 8px;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #003366;
            color: white;
            text-transform: uppercase;
        }

        .terms {
            font-size: 13px;
            text-align: justify;
        }

        /* Checkbox and button styling for better UX */
        .form-check-input:checked {
            background-color: #FDBB30;
            border-color: #FDBB30;
        }

        .btn-primary {
            background-color: #003366;
            border: none;
            width: 100%;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #002244;
        }
    </style>
</head>
<body>
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <div style="display:flex; align-items:center;">
        <img src="data:image/jpeg;base64,{{ $logoWhirlpool }}" style="height:100px; margin-right:10px;">
    </div>
    <div style="display:flex; align-items:center;">
        <img src="data:image/jpeg;base64,{{ $logoGtim }}" style="height:60px;">
    </div>
</div>



<div class="container">

    <!-- Header: date and timestamp -->
    <div class="header">
        <div>&nbsp;</div>
        <div>{{ \Carbon\Carbon::now()->format('D M d Y H:i:s T') }}</div>
    </div>

    <h2>Carta de Asignación de Equipo</h2>

    <!-- Warning section for the employee -->
    <div class="highlight">
        Leer detenidamente - <i>Política de uso de dispositivos tecnológicos.</i>
    </div>

    <!-- Static user information table -->
    <table>
        <tr><th>Nombre</th><td>{{ $nombreUsuario }}</td></tr>
        <tr><th>User ID</th><td>{{ $userId }}</td></tr>
        <tr><th>Email</th><td>{{ $email }}</td></tr>
        <tr><th>Puesto</th><td>{{ $position }}</td></tr>
        <tr><th>Ubicación</th><td>{{ $location }}</td></tr>
        <tr><th>Centro de Costo</th><td>{{ $costCenter }}</td></tr>
        <tr><th>Supervisor</th><td>{{ $supervisor }}</td></tr>
        <tr><th>FOLIO</th><td>{{ $folio }}</td></tr>

    </table>

    <!-- Looping through assigned devices -->
    <h5 class="fw-bold">Lista de Dispositivos Asignados</h5>
    <div id="deviceTableContainer">
        @foreach ($assigned_devices as $index => $device)
            <h6>Dispositivo #{{ $index + 1 }}</h6>
            <table>
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
    </div>
    @if (!empty($retired_devices))
    <h5 class="fw-bold">Lista de Dispositivos Retirados</h5>
    <div id="retiredDeviceTableContainer">
        @foreach ($retired_devices as $index => $device)
            <h6>Dispositivo Retirado #{{ $index + 1 }}</h6>
            <table>
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
    </div>
@endif


    <!-- Terms and link to policy -->
    <p class="terms">
        Por medio de la presente declaro que he recibido los dispositivos tecnológicos antes mencionados.
        Asumo la responsabilidad de su guarda y cuidado, y me comprometo a cumplir con la
        <a href="https://drive.google.com/open?id=1ns1BJsclUz1vrURq5zEoMuI0-MKR6a6Lq" target="_blank">
            Política de uso de Dispositivos Tecnológicos
        </a> definida por la empresa.
    </p>

    <!-- Acceptance form with JS fetch logic -->
    <form id="aceptacionForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ $userId }}">
        <div class="form-check my-3">
            <input type="checkbox" class="form-check-input" id="acceptCheck" required>
            <label class="form-check-label" for="acceptCheck">Acepto los términos y condiciones</label>
        </div>
        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Enviar Aceptación</button>
    </form>
</div>

<!-- Script actualizado sin descarga -->
<script>
    // Habilitar el botón solo si el checkbox está marcado
    document.getElementById("acceptCheck").addEventListener("change", function () {
        document.getElementById("submitBtn").disabled = !this.checked;
    });

    // Enviar los datos al backend usando fetch (sin descarga)
    document.getElementById("aceptacionForm").addEventListener("submit", function (event) {
        event.preventDefault();
        fetch("{{ route('letter.confirmar') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_id: "{{ $userId }}",
                assigned_devices: @json($assigned_devices),
                    retired_devices: @json($retired_devices),
                tipo_asignacion: "{{ $tipo_asignacion ?? 'Asignación Regular' }}"
            })
        })
        .then(response => {
            if (response.ok) {
                alert("✅ Aceptación enviada correctamente. Recibirás el PDF por correo.");
            } else {
                alert("❌ Hubo un problema al enviar la aceptación.");
            }
        })
        .catch(err => {
            alert("❌ Error: " + err.message);
        });
    });
</script>

</body>
</html>
