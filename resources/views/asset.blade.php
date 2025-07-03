<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aprobación de Carta por Asset</title>
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
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

        h2 {
            text-align: center;
            color: #003366;
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
        }

        .form-check {
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
            width: 100%;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <table width="100%" style="margin-bottom:10px;">
    <tr>
        <td align="left">
            <img src="data:image/jpeg;base64,{{ $logoWhirlpool }}" style="height:100px;">
        </td>
        <td align="right">
            <img src="data:image/jpeg;base64,{{ $logoGtim }}" style="height:50px;">
        </td>
    </tr>
</table>

<div class="container">

    <h2>Revisión y Aprobación de Carta</h2>

    <p class="text-center">
        Verifica la siguiente información antes de autorizar la generación de la carta para el usuario.
    </p>

    <!-- Datos del usuario -->
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

    <h5 class="fw-bold">Lista de Dispositivos Asignados</h5>

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
@if (!empty($retired_devices))
    <h5 class="fw-bold">Lista de Dispositivos Retirados</h5>
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
@endif

    <!-- Checkbox y botón de autorización -->
    <form id="assetApprovalForm">
    @csrf
    <input type="hidden" name="user_id" value="{{ $userId }}">
    <input type="hidden" name="folio" value="{{ $folio }}">

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="approveCheck" required>
            <label class="form-check-label" for="approveCheck">He revisado y autorizo esta carta.</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3" id="submitBtn" disabled>Autorizar Carta</button>
    </form>
</div>

<script>
    document.getElementById("approveCheck").addEventListener("change", function () {
        document.getElementById("submitBtn").disabled = !this.checked;
    });

    document.getElementById("assetApprovalForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const folioValue = document.querySelector('input[name="folio"]').value;

        fetch("{{ route('asset.aprobar') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_id: "{{ $userId }}",
                assigned_devices: @json($assigned_devices),
                retired_devices: @json($retired_devices),
                tipo_asignacion: "{{ $tipo_asignacion ?? 'Asignación Regular' }}",
                folio: folioValue
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || "✅ Carta autorizada correctamente.");
            location.reload(); // o redirigir si quieres
        })
        .catch(error => {
            alert("❌ Error: " + error.message);
        });
    });
</script>

</body>
</html>
