# Task Manager Laravel API

Este proyecto es un sistema para gestionar una lista de tareas utilizando Laravel, jQuery y AJAX, sin recargar la página.

## Características

- CRUD completo para tareas.
- Gestión de personas y asignación de tareas.
- Relación pivote entre tareas y personas.
- Validación, manejo de errores y diseño frontend.
- APIs RESTful consumidas con AJAX.
- Código limpio y comentado.

## Requisitos

- PHP >= 8.0
- Composer
- MySQL o SQL Server
- Node.js y npm (opcional para assets)

## Instalación

1. Clonar el repositorio
git clone https://github.com/PAFGAresFS/task_app.git
cd task_app

2. Instalar dependencias PHP
composer install

3. Copiar archivo de entorno
cp .env.example .env

4. Configurar base de datos en .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=task_app
DB_USERNAME=root
DB_PASSWORD=

5. Generar clave de aplicación
php artisan key:generate

6. Ejecutar migraciones y seeders
php artisan migrate --seed

7. Iniciar servidor local
php artisan serve

## Uso

- Accede a http://127.0.0.1:8000 en tu navegador.
- La aplicación permite crear, editar, eliminar tareas y gestionar personas.
- Las operaciones se hacen sin recargar la página mediante AJAX.

## API Endpoints Principales

- GET /api/tasks — Listar tareas
- POST /api/tasks — Crear tarea
- PUT /api/tasks/{id} — Actualizar tarea
- DELETE /api/tasks/{id} — Eliminar tarea
- POST /api/tasks/{id}/assign — Asignar persona a tarea
- POST /api/tasks/{id}/unassign — Quitar persona de tarea
- GET /api/persons — Listar personas
- POST /api/persons — Crear persona
- PUT /api/persons/{id} — Actualizar persona
- DELETE /api/persons/{id} — Eliminar persona

## Tests con Postman

Se incluye una colección Postman para probar todos los endpoints del API.

## Notas

- Asegúrate de tener el servidor corriendo antes de probar la API.
- El proyecto usa base64 para almacenar avatares temporalmente.
- Validaciones y manejo de errores implementados en backend y frontend.

---

Gracias por usar este proyecto!

Y ofrezco una disculpa por tardar mas de la hora establecida, sin internet y al poco tiempo sin luz hasta esta hora, me dejo fuera de tiempo, espero no repercuta en el proceso de contratacion y en definitiva no volvera a pasar.

- PAFG -
