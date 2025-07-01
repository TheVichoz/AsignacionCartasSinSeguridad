<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Control de Asignación de Equipos</title>
  <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #d6d6d6;
    }
    .header {
      background-color: #f8f9fa;
      padding: 10px;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      border-bottom: 2px solid #ddd;
    }
    .header img { height: 40px; }
    .content {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 80px;
      padding-bottom: 40px;
    }
    .container-box {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      width: 90%;
      max-width: 1600px;
    }
    .form-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 10px;
    }
    .form-group { flex: 1; min-width: 200px; }
    .form-control, .form-select {
      font-size: 0.9rem;
      padding: 5px;
    }
    .footer {
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 10px;
      font-size: 0.9rem;
    }
    h4 { font-size: 1.1rem; margin-top: 15px; }
    table { font-size: 0.9rem; }
    #error-message {
      display: none;
      font-size: 0.9rem;
      padding: 8px;
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 250px;
      z-index: 1000;
      border-radius: 5px;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
      background-color: #f8d7da;
      color: #721c24;
      text-align: center;
    }
  </style>
</head>
<body>
<header class="header d-flex justify-content-between px-4">
  <img src="{{ asset('img/GTIM-Logo.jpeg') }}" alt="GTIM">
  <img src="{{ asset('img/logo.jpg') }}" alt="Whirlpool">
</header>
<main class="content">
  <div class="container-box">
    <h2 class="text-center">Control de Asignación de Equipos</h2>
    <form>
      <div class="form-container">
        <div id="error-message">El ID ingresado no existe.</div>
        <div class="form-group">
          <label class="form-label fw-bold">User ID</label>
          <input type="text" class="form-control" id="userId" placeholder="Ingrese el ID del usuario">
        </div>
        <div class="form-group">
          <label class="form-label">Nombre de Usuario</label>
          <input type="text" class="form-control" id="name" disabled>
        </div>
        <div class="form-group">
          <label class="form-label">Correo</label>
          <input type="email" class="form-control" id="email" disabled>
        </div>
        <div class="form-group">
          <label class="form-label">Ubicación</label>
          <input type="text" class="form-control" id="location" disabled>
        </div>
        <div class="form-group">
          <label class="form-label">Centro de C.</label>
          <input type="text" class="form-control" id="callCenter" disabled>
        </div>
        <div class="form-group">
          <label class="form-label">Supervisor</label>
          <input type="text" class="form-control" id="supervisor" disabled>
        </div>
      </div>
      <h4 class="fw-bold">Técnico</h4>
      <div class="form-group">
        <select class="form-select" id="technician">
          <option selected>Seleccione un técnico</option>
        </select>
      </div>

      <h4 class="fw-bold">Dispositivo</h4>
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="serialInput" placeholder="Ej: SN123456789">
        <button type="button" id="assignDeviceBtn" class="btn btn-primary">
          Asignar Dispositivo
        </button>
      </div>

      <h4 class="fw-bold">Tipo de Asignación</h4>
      <div class="form-group">
        <select class="form-select" id="asignacion">
          <option selected>Seleccione un tipo de asignación</option>
        </select>
      </div>

      <h4 class="fw-bold">Lista de Dispositivos Asignados</h4>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="fw-bold">Descripción Dispositivo</th>
            <th class="fw-bold">Asset Tag</th>
            <th class="fw-bold">Número de Serie</th>
            <th class="fw-bold">Accesorio</th>
          </tr>
        </thead>
        <tbody id="assignedDevicesTable"></tbody>
      </table>
      <h4 class="fw-bold mt-4">Retirar Dispositivo</h4>
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="serialInputRetiro" placeholder="Ej: SN987654321">
        <button type="button" id="retirarDeviceBtn" class="btn btn-warning">
          Retirar Dispositivo
        </button>
      </div>

      <h4 class="fw-bold">Lista de Dispositivos Retirados</h4>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="fw-bold">Descripción Dispositivo</th>
            <th class="fw-bold">Asset Tag</th>
            <th class="fw-bold">Número de Serie</th>
            <th class="fw-bold">Accesorio</th>
          </tr>
        </thead>
        <tbody id="retiredDevicesTable"></tbody>
      </table>

      <div class="text-center mt-3">
        <button type="button" id="generateLetterBtn" class="btn btn-success" disabled>
          Generar carta de asignación
        </button>
      </div>
      <div id="alertSuccess" class="alert alert-success mt-2 d-none"></div>
    </form>
  </div>
</main>

<footer class="footer">
  &copy; 2025 Mi Aplicación. Todos los derechos reservados.
</footer>
<script>
document.getElementById('userId').addEventListener('blur', function() {
  let userId = this.value.trim();
  let errorMessage = document.getElementById('error-message');

  if (userId === '') {
    clearFields();
    return;
  }

  let apiUrl = `http://147.182.190.223:8000/getUserById?user_id=${userId}`;

  fetch(apiUrl)
    .then(response => {
      if (!response.ok) throw new Error("Usuario no encontrado");
      return response.json();
    })
    .then(data => {
      if (!data.employees || data.employees.length === 0) throw new Error("No se encontró el usuario.");

      let user = data.employees.find(emp => emp.user_id === userId);
      if (!user || user.user_id === "") {
        clearFields();
        return;
      }

      document.getElementById('name').value = user.display_name || '';
      document.getElementById('email').value = user.email || '';
      document.getElementById('location').value = user.location || '';
      document.getElementById('callCenter').value = user.cost_center_name || '';
      document.getElementById('supervisor').value = user.supervisor || '';
      errorMessage.style.display = 'none';
    })
    .catch(error => {
      console.error("❌ Error:", error);
      errorMessage.style.display = 'block';
      setTimeout(() => errorMessage.style.display = "none", 3000);
      clearFields();
    });
});

function clearFields() {
  document.getElementById('name').value = '';
  document.getElementById('email').value = '';
  document.getElementById('location').value = '';
  document.getElementById('callCenter').value = '';
  document.getElementById('supervisor').value = '';
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const selectTechnician = document.getElementById("technician");
  fetch("http://147.182.190.223:8000/getTechnicianList")
    .then(response => {
      if (!response.ok) throw new Error("Error al obtener la lista de técnicos.");
      return response.json();
    })
    .then(data => {
      if (!data.technicians || data.technicians.length === 0) throw new Error("No hay técnicos disponibles.");
      const filtered = data.technicians.filter(t => t.display_name && t.display_name.trim() !== "");
      selectTechnician.innerHTML = '<option selected>Seleccione un técnico</option>';
      filtered.forEach(t => {
        let option = document.createElement("option");
        option.value = t.user_id;
        option.textContent = `${t.user_id} - ${t.display_name} (${t.location})`;
        selectTechnician.appendChild(option);
      });
    })
    .catch(error => {
      console.error("❌ Error:", error);
      alert("No se pudo cargar la lista de técnicos.");
    });
});
</script>
<script>
let assignedDevicesList = [];
let retiredDevicesList = [];
let deviceData = [];

document.addEventListener("DOMContentLoaded", function () {
  const assignDeviceBtn = document.getElementById("assignDeviceBtn");
  const retirarDeviceBtn = document.getElementById("retirarDeviceBtn");
  const generateLetterBtn = document.getElementById("generateLetterBtn");

  const assignedDevicesTable = document.getElementById("assignedDevicesTable");
  const retiredDevicesTable = document.getElementById("retiredDevicesTable");

  fetch("http://147.182.190.223:8000/getDeviceList")
    .then(response => response.json())
    .then(data => {
      deviceData = data.devices;
    })
    .catch(error => {
      console.error("❌ Error al obtener dispositivos:", error);
      alert("No se pudo cargar la lista de dispositivos.");
    });

  assignDeviceBtn.addEventListener("click", function (event) {
    event.preventDefault();
    const input = document.getElementById("serialInput");
    const serial = input.value.trim().toUpperCase();
    const selectedDevice = deviceData.find(d => d.serial_number.toUpperCase() === serial);
    if (!selectedDevice) return alert("No encontrado.");

    if (assignedDevicesList.some(d => d.serial_number === serial))
      return alert("Ya agregado.");

    const row = assignedDevicesTable.insertRow();
    row.insertCell(0).innerText = `${selectedDevice.brand} ${selectedDevice.model}`;
    const assetInput = crearInput(selectedDevice.asset_tag);
    row.insertCell(1).appendChild(assetInput);
    row.insertCell(2).innerText = serial;
    const accInput = crearInput("");
    row.insertCell(3).appendChild(accInput);

    assignedDevicesList.push({
      display_name: `${selectedDevice.brand} ${selectedDevice.model}`,
      get asset_tag() { return assetInput.value; },
      serial_number: serial,
      get accesorio() { return accInput.value; }
    });

    generateLetterBtn.disabled = false;
    localStorage.setItem("assignedDevicesList", JSON.stringify(assignedDevicesList));

    input.value = '';
    input.focus();
  });

  retirarDeviceBtn.addEventListener("click", function (event) {
    event.preventDefault();
    const input = document.getElementById("serialInputRetiro");
    const serial = input.value.trim().toUpperCase();
    const selectedDevice = deviceData.find(d => d.serial_number.toUpperCase() === serial);
    if (!selectedDevice) return alert("No encontrado.");

    if (retiredDevicesList.some(d => d.serial_number === serial))
      return alert("Ya marcado para retiro.");

    const row = retiredDevicesTable.insertRow();
    row.insertCell(0).innerText = `${selectedDevice.brand} ${selectedDevice.model}`;
    const assetInput = crearInput(selectedDevice.asset_tag);
    row.insertCell(1).appendChild(assetInput);
    row.insertCell(2).innerText = serial;
    const accInput = crearInput("");
    row.insertCell(3).appendChild(accInput);

    retiredDevicesList.push({
      display_name: `${selectedDevice.brand} ${selectedDevice.model}`,
      get asset_tag() { return assetInput.value; },
      serial_number: serial,
      get accesorio() { return accInput.value; }
    });

    localStorage.setItem("retiredDevicesList", JSON.stringify(retiredDevicesList));

    input.value = '';
    input.focus();
  });

  function crearInput(valor) {
    const input = document.createElement("input");
    input.type = "text";
    input.className = "form-control";
    input.value = valor || "";
    return input;
  }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const select = document.getElementById("asignacion");
  select.addEventListener("change", function (event) {
    event.preventDefault();
  });
  const tipos = [
    "Reasignación", "Adición", "Adición Monitor", "Cambio de Modelo",
    "PC Refresh", "Préstamo", "Reemplazo por Robo", "Préstamo por Daño",
    "Reemplazo por Daño", "Préstamo por Falla", "Reemplazo por Garantía",
    "Validación de Información"
  ];
  tipos.forEach(tipo => {
    let option = document.createElement("option");
    option.value = tipo;
    option.textContent = tipo;
    select.appendChild(option);
  });
});
</script>

<script>
document.getElementById('generateLetterBtn').addEventListener('click', function () {
  if (assignedDevicesList.length === 0) {
    alert("No hay dispositivos asignados.");
    return;
  }

  const tipoAsignacion = document.getElementById("asignacion").value;
  const userId = document.getElementById("userId").value.trim();

  const payload = {
    user_id: userId,
    tipo_asignacion: tipoAsignacion || "Sin especificar",
    assigned_devices: assignedDevicesList,
    retired_devices: retiredDevicesList
  };

  fetch("{{ route('enviar.asset') }}", {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(payload)
  })
  .then(response => response.json())
  .then(data => {
    if(data.success){
      const alertSuccess = document.getElementById('alertSuccess');
      alertSuccess.textContent = data.success;
      alertSuccess.classList.remove('d-none');
      setTimeout(() => {
        alertSuccess.classList.add('d-none');
        alertSuccess.textContent = '';
      }, 4000);
    } else if(data.error) {
      alert('Error al enviar correo: ' + data.error);
    }
  })
  .catch(error => {
    alert('Error inesperado: ' + error);
    console.error('Error:', error);
  });
});
</script>
</body>
</html>
