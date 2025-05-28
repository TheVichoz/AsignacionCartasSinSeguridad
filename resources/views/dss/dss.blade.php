<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Control de Asignación de Equipos</title>

    <!-- Importing Bootstrap from local files -->
    <link href="{{ asset('bootstrap.min.css') }}" rel="stylesheet">

    <style>
       /* General body settings */
       body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #d6d6d6;
        }

        /* Header styles */
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
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #ddd;
        }

        .header img {
            height: 40px;
        }

        /* Main content container */
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
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1600px;
        }

        /* Form container */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-control, .form-select {
            font-size: 0.9rem;
            padding: 5px;
        }

        /* Footer styles */
        .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 0.9rem;
        }

        h4 {
            font-size: 1.1rem;
            margin-top: 15px;
        }

        table {
            font-size: 0.9rem;
        }

        /* Error message styles */
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

    <!-- Header with logo -->
    <header class="header">
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo">
    </header>

    <!-- Main container -->
    <main class="content">
        <div class="container-box">
            <h2 class="text-center">Control de Asignación de Equipos</h2>

            <!-- Assignment form -->
            <form>
                <div class="form-container">
                    <!-- Error message for unknown ID -->
                    <div id="error-message">El ID ingresado no existe.</div>

                    <!-- User ID input field -->
                    <div class="form-group">
                        <label class="form-label">User ID</label>
                        <input type="text" class="form-control" id="userId" placeholder="Ingrese el ID del usuario">
                    </div>

                    <!-- User information fields -->
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

                <!-- Technician and device selection -->
                <h4>Técnico</h4>
                <div class="form-group">
                    <label class="form-label">Técnico que entregará</label>
                    <select class="form-select" id="technician">
                        <option selected>Seleccione un técnico</option>
                    </select>
                </div>

<h4>Dispositivo</h4>
<div class="form-group">
    <label class="form-label">Ingresa el Número de Serie</label>
    <input type="text" class="form-control" id="serialInput" placeholder="Ej: SN123456789">
</div>


                <h4>Tipo de Asignación</h4>
                <div class="form-group">
                    <label class="form-label">Seleccione el tipo de asignación</label>
                    <select class="form-select" id="asignacion">
                        <option selected>Seleccione un tipo de asignación</option>
                    </select>
                </div>


                <!-- Table of assigned devices -->
                <h4>Lista de Dispositivos Asignados</h4>
                <table class="table table-bordered">
    <thead>
        <tr>
            <th>Descripción Dispositivo</th>
            <th>Asset Tag</th>
            <th>Número de Serie</th>
        </tr>
    </thead>
    <tbody id="assignedDevicesTable">
        
    </tbody>
</table>

                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit" id="assignDeviceBtn" class="btn btn-primary">Asignar Dispositivos</button>
                </div>

                <div class="text-center mt-3">
    <button type="button" id="generateLetterBtn" class="btn btn-success" disabled>
        Generar carta de asignación
    </button>
</div>
<div id="alertSuccess" class="alert alert-success mt-2 d-none"></div>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        &copy; 2025 Mi Aplicación. Todos los derechos reservados.
    </footer>

    <script>
    /**
 * Handles the 'blur' event for the user ID input field.
 * Fetches user details from the API and populates the form fields if a match is found.
 */
document.getElementById('userId').addEventListener('blur', function() {
    let userId = this.value.trim();
    let errorMessage = document.getElementById('error-message');

    // ✅ If the user clears the input, reset fields and exit
    if (userId === '') {
        clearFields();
        return;
    }

    let apiUrl = `http://localhost:8000/getUserById?user_id=${userId}`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error("Usuario no encontrado"); // ❗ Message displayed to the user in Spanish
            }
            return response.json();
        })
        .then(data => {
            console.log("📡 Received data:", data); // Log API response

            if (!data.employees || data.employees.length === 0) {
                throw new Error("No se encontró el usuario."); // ❗ Message displayed to the user in Spanish
            }

            // ✅ Find the employee with the entered user ID
            let user = data.employees.find(emp => emp.user_id === userId);

            if (!user || user.user_id === "") {
                console.warn("⚠ Usuario no encontrado en la API."); // ❗ Message displayed to the user in Spanish
                clearFields();
                return;
            }

            // ✅ Populate fields only if the user exists
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

/**
 * Clears all user-related input fields.
 */
function clearFields() {
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('location').value = '';
    document.getElementById('callCenter').value = '';
    document.getElementById('supervisor').value = '';
}

    </script>

<script>
let assignedDevicesList = [];
let deviceData = [];

document.addEventListener("DOMContentLoaded", function () {
    const assignDeviceBtn = document.getElementById("assignDeviceBtn");
    const generateLetterBtn = document.getElementById("generateLetterBtn");
    const assignedDevicesTable = document.getElementById("assignedDevicesTable");

    // ✅ Cargar dispositivos desde la API
    fetch("http://localhost:8000/getDeviceList")
        .then(response => response.json())
        .then(data => {
            if (!data.devices || data.devices.length === 0) {
                throw new Error("No hay dispositivos disponibles.");
            }

            deviceData = data.devices;
            console.log("✅ Lista de dispositivos cargada:", deviceData);
        })
        .catch(error => {
            console.error("❌ Error al obtener dispositivos:", error);
            alert("No se pudo cargar la lista de dispositivos.");
        });

    // ✅ Asignar dispositivo por número de serie ingresado
    assignDeviceBtn.addEventListener("click", function (event) {
        event.preventDefault();

        const serialInput = document.getElementById("serialInput").value.trim().toUpperCase();

        const selectedDevice = deviceData.find(device =>
            device.serial_number.trim().toUpperCase() === serialInput
        );

        if (!selectedDevice) {
            alert("Número de serie no encontrado en la base de datos.");
            return;
        }

        if (assignedDevicesList.some(d => d.serial_number === selectedDevice.serial_number)) {
            alert("Este dispositivo ya fue asignado.");
            return;
        }

        const row = assignedDevicesTable.insertRow();
        row.insertCell(0).innerText = selectedDevice.display_name;
        row.insertCell(1).innerText = selectedDevice.asset_tag;
        row.insertCell(2).innerText = selectedDevice.serial_number;

        assignedDevicesList.push({
            display_name: selectedDevice.display_name,
            asset_tag: selectedDevice.asset_tag,
            serial_number: selectedDevice.serial_number
        });

        localStorage.setItem("assignedDevicesList", JSON.stringify(assignedDevicesList));
        generateLetterBtn.disabled = false;

        console.log("✅ Dispositivo agregado correctamente:", selectedDevice);
    });
});
</script>


<script>
  /**
 * Fetches and populates the technician selection dropdown with available technicians.
 * Ensures valid technicians are displayed, filtering out empty or invalid entries.
 */
document.addEventListener("DOMContentLoaded", function () {
    const selectTechnician = document.getElementById("technician");

    /**
     * Fetches the list of available technicians from the API and populates the dropdown.
     */
    function fetchTechnicians() {
        fetch("http://localhost:8000/getTechnicianList") // Ensure the API route is correct
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al obtener la lista de técnicos."); // ❗ Message displayed to the user in Spanish
                }
                return response.json();
            })
            .then(data => {
                console.log("📡 Received technician data:", data); // ✅ Log API response

                // ✅ Validate that the API response contains technicians
                if (!data.technicians || data.technicians.length === 0) {
                    throw new Error("No hay técnicos disponibles."); // ❗ Message displayed to the user in Spanish
                }

                // ✅ Filter out technicians with empty "display_name"
                const filteredTechnicians = data.technicians.filter(tech => tech.display_name && tech.display_name.trim() !== "");

                // ✅ Clear previous options in the select dropdown
                selectTechnician.innerHTML = '<option selected>Seleccione un técnico</option>';

                // ✅ Populate the dropdown with valid technicians
                filteredTechnicians.forEach(tech => {
                    let option = document.createElement("option");
                    option.value = tech.user_id; // Use user_id as the value
                    option.textContent = `${tech.user_id} - ${tech.display_name} (${tech.location})`; // Display ID, name, and location
                    selectTechnician.appendChild(option);
                });

                console.log("✅ Technicians added to the select dropdown.");
            })
            .catch(error => {
                console.error("❌ Error fetching technicians:", error);
                alert("No se pudo cargar la lista de técnicos."); // ❗ Message displayed to the user in Spanish
            });
    }

    // Fetch and populate the technician list when the page loads
    fetchTechnicians();
});

</script>
<script>
    /**
 * Populates the assignment type dropdown with predefined values.
 * Ensures that selecting an option does not trigger form submission.
 */
document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("asignacion");

    /**
     * Prevents form submission when changing the selection in the dropdown.
     */
    select.addEventListener("change", function (event) {
        event.preventDefault(); // Prevents the page from reloading
    });

    // Predefined assignment types
    const data = {
        "tipos_asignacion": [
            "Reasignación", "Adición", "Adición Monitor", "Cambio de Modelo",
            "PC Refresh", "Préstamo", "Reemplazo por Robo", "Préstamo por Daño",
            "Reemplazo por Daño", "Préstamo por Falla", "Reemplazo por Garantía",
            "Validación de Información"
        ]
    };

    /**
     * Populates the select dropdown with assignment types.
     */
    data.tipos_asignacion.forEach(tipo => {
        let option = document.createElement("option");
        option.value = tipo;
        option.textContent = tipo;
        select.appendChild(option);
    });
});

</script>
<script>
document.getElementById('generateLetterBtn').addEventListener('click', function () {
    console.log("🔍 Dispositivos antes de enviar:", assignedDevicesList);

    if (assignedDevicesList.length === 0) {
        alert("No hay dispositivos asignados. Agregue al menos uno antes de continuar.");
        return;
    }

    const tipoAsignacion = document.getElementById("asignacion").value;

    const userId = document.getElementById("userId").value.trim();

const payload = {
    user_id: userId,
    tipo_asignacion: tipoAsignacion || "Sin especificar",
    assigned_devices: assignedDevicesList
};


    console.log("📤 Enviando correo con la carta de aceptación:", JSON.stringify(payload, null, 2));

    fetch("{{ route('enviar.correo') }}", { 
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
