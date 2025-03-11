# 🏨 Sistema de Gestión de Hoteles - Decameron Colombia

## 📌 Descripción General

Este proyecto es un sistema web diseñado para gestionar los hoteles de la compañía Decameron Colombia. Permite registrar y administrar información básica de los hoteles, como nombre, dirección, ciudad, NIT y datos tributarios. Además, el sistema permite configurar las habitaciones de cada hotel, asignando tipos de habitación (Estándar, Junior, Suite) y acomodaciones específicas según las reglas establecidas:

- **Estándar**: Sencilla o Doble.
- **Junior**: Triple o Cuádruple.
- **Suite**: Sencilla, Doble o Triple.

El sistema valida que:

- La cantidad total de habitaciones configuradas no supere el máximo permitido por hotel.
- No existan hoteles repetidos.
- No se dupliquen tipos de habitación y acomodaciones para el mismo hotel.

## 🎯 Características Principales

- ✅ **CRUD de Hoteles**: Crear, leer, actualizar y eliminar hoteles.
- ✅ **Configuración de Habitaciones**: Asignar tipos de habitación y acomodaciones según las reglas establecidas.
- ✅ **Validaciones Automáticas**: Garantiza que los datos ingresados cumplan con las restricciones del negocio.
- ✅ **Interfaz Responsiva**: Diseñada para funcionar en navegadores modernos (Firefox y Chrome) y dispositivos con pantallas de 13" y 15".
- ✅ **RESTful API**: Backend completamente desacoplado del frontend.

## 💻 Tecnologías Utilizadas

### Backend

- **Lenguaje**: PHP (Framework Laravel).
- **Base de Datos**: PostgreSQL.
- **API**: RESTful, siguiendo principios SOLID y buenas prácticas de diseño.

### Frontend

- **Framework**: React.js.
- **Librerías**:
  - Inertia.js: Para conectar el frontend con el backend sin necesidad de una API manual.
  - TailwindCSS: Para estilizar la interfaz de usuario.
  - React-Toastify: Para mostrar notificaciones al usuario.
- **Herramientas**:
  - Vite: Para el desarrollo rápido y optimizado del frontend.
  - Axios: Para manejar solicitudes HTTP.

### Herramientas Adicionales

- **Git**: Control de versiones.
- **Docker (opcional)**: Para facilitar la configuración del entorno local.
- **Nube**: El sistema está desplegado en la nube (AWS, Heroku u otra plataforma).

## 🗂️ Estructura del Proyecto

### Backend

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HotelController.php       # Manejo de CRUD de hoteles
│   │   └── RoomTypeController.php    # Manejo de tipos de habitación
├── Models/
│   ├── Hotel.php                     # Modelo de Hotel
│   ├── RoomType.php                  # Modelo de Tipo de Habitación
│   └── Accommodation.php             # Modelo de Acomodación
database/
├── migrations/                       # Migraciones de la base de datos
└── seeders/                          # Datos iniciales para la base de datos
routes/
├── web.php                           # Rutas principales del sistema
resources/
└── views/                            # Vistas básicas (si aplica)
```

### Frontend

```
src/
├── components/
│   ├── HotelEdit.tsx                 # Componente para editar hoteles
│   └── HotelList.tsx                 # Componente para listar hoteles
├── layouts/
│   └── AppLayout.tsx                 # Layout principal de la aplicación
├── pages/
│   ├── Dashboard.tsx                 # Página de inicio
│   └── Hotel/
│       ├── Index.tsx                 # Lista de hoteles
│       └── Edit.tsx                  # Edición de hoteles
public/
└── assets/                           # Archivos estáticos (imágenes, CSS, etc.)
```

## Diagrama de Base de Datos

```
+----------+      +--------------------------+      +---------------+
|  hotels  |      | hotel_room_accommodations |      | accommodations |
+----------+      +--------------------------+      +---------------+
| id       |------>| id                       |------>| id            |
| nombre   |      | hotel_id                 |      | nombre        |
| direccion|      | room_type_id             |      | created_at    |
| ciudad   |      | accommodation_id         |      | updated_at    |
| nit      |      | cantidad                 |      |               |
| num_hab. |      | created_at               |      |               |
| created_at|      | updated_at               |      |               |
| updated_at|      +--------------------------+      +---------------+
+----------+          ^          ^
                      |          |
                      |          |
+------------+      +------------+
| room_types |      
+------------+      
| id         |      
| nombre     |      
| created_at |      
| updated_at |      
+------------+      


```

## Instrucciones de Instalación

### Requisitos Previos

- PHP >= 8.0
- Composer (https://getcomposer.org/)
- Node.js >= 16.x (https://nodejs.org/)
- PostgreSQL instalado y configurado.
- Git instalado.

### 1. Clonar el Repositorio

```sh
git clone https://github.com/tu-repositorio/hotel-management.git
cd hotel-management
```

### 2. Configurar el Backend

```sh
cp .env.example .env
```

Configura las variables de entorno en el archivo `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=hotel_management
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

Instala las dependencias:

```sh
composer install
```

Genera la clave de la aplicación:

```sh
php artisan key:generate
```

Ejecuta las migraciones y los seeders:

```sh
php artisan migrate --seed
```

### 3. Configurar el Frontend

```sh
npm install
```

Compila los assets:

```sh
npm run build
```

### 4. Iniciar el Servidor

```sh
php artisan serve
```

Abre la aplicación en tu navegador:

[http://localhost:8000](http://localhost:8000)

## 🚀 Instrucciones de Uso

### Crear un Hotel

1. Ve a la página de "Crear Hotel".
2. Ingresa los datos básicos (nombre, dirección, ciudad, NIT, número de habitaciones).
3. Configura las habitaciones asignando tipos de habitación y acomodaciones.

### Editar un Hotel

1. Selecciona un hotel desde la lista.
2. Modifica los datos básicos o ajusta las configuraciones de habitaciones.

### Eliminar un Hotel

1. Desde la lista de hoteles, selecciona "Eliminar" para borrar un registro.

### Validaciones

El sistema validará automáticamente que no se superen los límites de habitaciones ni se dupliquen configuraciones.

## Consideraciones Adicionales

### Buenas Prácticas

- El código sigue los principios SOLID.
- Las clases y métodos están documentados.
- Se utilizan patrones de diseño como Repository para mejorar la escalabilidad.

### Limitaciones

- No se requiere autenticación para usuarios administrativos.
- Los catálogos (ciudades, tipos de habitación, acomodaciones) son estáticos.