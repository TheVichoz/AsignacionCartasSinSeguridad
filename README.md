# 🎯 Proyecto: Control de Asignación de Equipos  

📌 **Descripción**  
Este proyecto es un sistema de gestión de asignación de equipos que permite a los administradores asignar dispositivos a empleados y técnicos.  
La autenticación se maneja a través de **Google OAuth** y el sistema cuenta con roles y permisos gestionados mediante **Spatie Permission**.

También permite la **generación de cartas en PDF**, **firma digital del empleado**, y **almacenamiento automático en Google Drive**.

---

## 🚀 Tecnologías Utilizadas  
✅ **Laravel** – Framework PHP para el desarrollo backend  
✅ **Spatie Permission** – Gestión de roles y permisos  
✅ **Bootstrap 5** – Estilización de la interfaz  
✅ **Socialite** – Autenticación con Google  
✅ **DomPDF** – Generación de PDFs  
✅ **Google Drive API** – Subida de documentos firmados  
✅ **MySQL** – Base de datos  
✅ **Blade** – Sistema de plantillas de Laravel  

---

## 📌 Requisitos Previos  
🔹 **PHP** >= 8.1  
🔹 **Composer**  
🔹 **Node.js & npm** (para compilar assets)  
🔹 **MySQL**  
🔹 Archivo de credenciales `google-drive.json` (proporcionado por Google Cloud)  
🔹 ID de carpeta de Google Drive configurado en `.env`

---

## ⚙️ Instalación  

### 1️⃣ Clonar el repositorio  
```bash
git clone git clone https://github.com/W1lly2/Proyecto.git

```

### 2️⃣ Instalar dependencias  
```bash
composer install
npm install && npm run dev
```

### 3️⃣ Configurar variables de entorno  
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Editar el archivo `.env`  
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña

GOOGLE_DRIVE_FOLDER_ID=TU_ID_DE_CARPETA
```

### 5️⃣ Ejecutar migraciones y seeders  
```bash
php artisan migrate --seed
```

### 6️⃣ Iniciar el servidor  
```bash
php artisan serve
```

📌 Ahora puedes abrir el navegador y acceder a la URL mostrada (por defecto: `http://localhost:8000`)

---

## 📂 Estructura del Proyecto  

```
casig-back/
├── app/
│   ├── Http/
│   │   ├── Controllers/         # Lógica del sistema
│   │   ├── Middleware/          # Autenticación y validación de roles/firma
│   ├── Models/                  # Modelos del sistema
│   ├── Services/                # Servicio de subida a Google Drive
│   ├── Mail/                    # Notificación de correo
├── database/
│   ├── migrations/              # Migraciones de base de datos
│   ├── seeders/                 # Usuarios y datos iniciales
├── resources/
│   ├── views/                   # Vistas Blade
│   │   ├── letter.blade.php     # Carta web firmable
│   │   ├── carta_asignacion.blade.php # PDF generado
│   │   ├── emails/              # Plantilla de notificación
├── routes/
│   ├── web.php                  # Todas las rutas del sistema
```

---

## 🔑 Funcionalidades Clave  

✔️ Autenticación con Google (OAuth2 + Socialite)  
✔️ Gestión de Roles y Permisos (Admin, Empleado, DSS)  
✔️ Asignación de dispositivos tecnológicos  
✔️ Generación de carta responsiva con datos del usuario y dispositivos  
✔️ Firma digital del empleado (aceptación en línea)  
✔️ Generación automática de PDF  
✔️ Subida automática del PDF a Google Drive  
✔️ Validación de identidad por sesión y correo  
✔️ Estilización responsiva con Bootstrap 5  

---

## 📌 Uso del Sistema

🔹 **Inicio de sesión**  
1. Ve a `http://localhost:8000`  
2. Haz clic en "Iniciar sesión con Google"  
3. El sistema te redirige al panel correspondiente según tu rol:

| Rol      | Redirección              |
|----------|--------------------------|
| DSS      | `/dss`                   |

🔹 **Asignación y firma de carta**  
- El DSS selecciona dispositivos y asigna al empleado  
- Se envía un correo al empleado con el link para firmar  
- El empleado accede, revisa la carta y firma  
- Se genera un PDF que se sube a Google Drive automáticamente  

---

## 🔗 Rutas Principales

| Método | Ruta                        | Descripción                                 |
|--------|-----------------------------|---------------------------------------------|
| GET    | `/`                         | Página de inicio                            |
| GET    | `/auth/redirect/google`     | Redirección a login con Google              |
| GET    | `/auth/callback/google`     | Callback después de autenticación           |
| GET    | `/dashboard`                | Redirección a dashboard según rol           |
| GET    | `/dss`                      | Panel de dss                      |
| GET    | `/letter/{user_id}`         | Visualizar carta responsiva                 |
| POST   | `/letter-confirmar`         | Generar PDF firmado y subir a Drive         |
| POST   | `/enviar-correo`            | Enviar notificación de carta al empleado    |

---

## 🤝 Contribución  

1. Haz un fork del repositorio  
2. Crea una nueva rama  
```bash
git checkout -b feature/nueva-funcionalidad
```
3. Realiza los cambios y haz commit  
```bash
git commit -m "feat: descripción clara del cambio"
```
4. Sube los cambios  
```bash
git push origin feature/nueva-funcionalidad
```
5. Abre un pull request  

---

## ✍️ Autor  
👩‍💻 Desarrollador: VHernandez