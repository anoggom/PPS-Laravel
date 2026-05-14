# Peliculapp

<p align="left">
  <img src="https://img.shields.io/badge/STATUS-EN%20DESARROLLO-green?style=for-the-badge" alt="Status">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/JWT-Authentication-black?style=for-the-badge&logo=json-web-tokens" alt="JWT">
</p>

> Aplicación para buscar información sobre películas y sus directores. Construida con **Laravel** y **Blade**, protegida mediante autenticación **JWT**.

---

## Índice
* [Requisitos](#requisitos)
* [Instalación](#instalación)
* [Configuración (.env)](#configuración-env)
* [Autenticación JWT](#autenticación-jwt)
* [Endpoints](#endpoints)
* [Ejemplos de peticiones](#ejemplos-de-peticiones)
* [Base de datos](#base-de-datos)

---

## Requisitos

| Recurso | Versión / Detalle |
| :--- | :--- |
| **PHP** | 8.1+ |
| **Composer** | Última versión estable |
| **Base de datos** | MySQL o MariaDB |
| **Extensiones PHP** | `openssl`, `pdo`, `mbstring` |
| **Seguridad** | `JWT_SECRET` generado con `php artisan jwt:secret` |

---

## Instalación

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/anoggom/PPS-Laravel.git
   cd pps-laravel
   ```

2. **Instalar dependencias:**
   ```bash
   composer install
   ```

3. **Configurar el entorno y claves:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan jwt:secret
   ```

4. **Ejecutar migraciones:**
   ```bash
   php artisan migrate
   ```

5. **Iniciar el servidor:**
   - Producción:
     ```bash
     php artisan serve
     ```
   - Desarrollo:
     ```bash
     composer run dev
     ```

> El servidor estará disponible en `http://127.0.0.1:8000`.

---

## Configuración (.env)

Asegúrate de ajustar los valores en tu archivo `.env`:

```env
APP_NAME=PPS-Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=debug

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=peliculapp
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

JWT_SECRET=tu_clave_generada_con_php_artisan_jwt:secret
```

> `APP_KEY` y `JWT_SECRET` se generan automáticamente con `php artisan key:generate` y `php artisan jwt:secret` respectivamente.

---

## Autenticación JWT

La API usa **JWT (JSON Web Token)** para autenticar todas las rutas protegidas. El flujo es:

1. El usuario se **registra** (`POST /api/auth/register`) o **inicia sesión** (`POST /api/auth/login`).
2. El servidor devuelve un `access_token` (JWT).
3. El cliente debe incluir el token en el header `Authorization: Bearer <token>` en cada petición a rutas protegidas.
4. El token expira tras el tiempo configurado (por defecto 60 minutos). Se puede refrescar con `POST /api/auth/refresh`.

### Registro de Usuario
**Endpoint:** `POST /api/auth/register`

```json
{
  "name": "Usuario",
  "email": "usuario@ejemplo.com",
  "password": "password",
  "password_confirmation": "password"
}
```

**Respuesta exitosa (201):**
```json
{
  "message": "Usuario registrado correctamente"
}
```

### Inicio de Sesión
**Endpoint:** `POST /api/auth/login`

```json
{
  "email": "usuario@ejemplo.com",
  "password": "password"
}
```

**Respuesta exitosa (200):**
```json
{
  "access_token": "eyJ0eXAiOiJKV1Qi...",
  "token_type": "bearer",
  "expires_in": 3600,
  "status": 200,
}
```

### Gestión de Sesión
- **Obtener Perfil:** `GET /api/auth/me` (Requiere `Authorization: Bearer TU_TOKEN`)
- **Refrescar Token:** `POST /api/auth/refresh`
- **Cerrar Sesión:** `POST /api/auth/logout`

---

## Endpoints

### Auth (`/api/auth`)
| Método | Ruta | Descripción | Auth |
| :--- | :--- | :--- | :---: |
| `POST` | `/login` | Iniciar sesión | ✗ |
| `POST` | `/register` | Registrar usuario | ✗ |
| `POST` | `/logout` | Cerrar sesión | ✓ |
| `POST` | `/refresh` | Refrescar token | ✓ |
| `GET` | `/me` | Datos del usuario autenticado | ✓ |

### Directores (`/api/directors`)
| Método | Ruta | Descripción | Auth |
| :--- | :--- | :--- | :---: |
| `GET` | `/directors` | Listar directores (paginado) | ✓ |
| `POST` | `/directors` | Crear un director | ✓ |
| `GET` | `/directors/{id}` | Ver director (con películas) | ✓ |
| `PUT` / `PATCH` | `/directors/{id}` | Actualizar director | ✓ |
| `DELETE` | `/directors/{id}` | Eliminar director | ✓ |

### Películas (`/api/films`)
| Método | Ruta | Descripción | Auth |
| :--- | :--- | :--- | :---: |
| `GET` | `/films` | Listar películas (paginado) | ✓ |
| `POST` | `/films` | Crear una película | ✓ |
| `GET` | `/films/{id}` | Ver película (con director) | ✓ |
| `PUT` / `PATCH` | `/films/{id}` | Actualizar película | ✓ |
| `DELETE` | `/films/{id}` | Eliminar película | ✓ |

---

## Ejemplos de peticiones

Todas las rutas protegidas requieren el header:
```
Authorization: Bearer <access_token>
```

### Auth

**Registro**
```bash
curl -X POST http://127.0.0.1:8000/api/auth/register \
  -H "Content-Type: application/json" \
  -d '{"name": "Juan", "email": "juan@mail.com", "password": "12345678", "password_confirmation": "12345678"}'
```
```json
// 201 Created
{ "message": "Usuario registrado correctamente" }
```

**Login**
```bash
curl -X POST http://127.0.0.1:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email": "juan@mail.com", "password": "12345678"}'
```
```json
// 200 OK
{
  "access_token": "eyJ0eXAiOiJKV1Qi...",
  "token_type": "bearer",
  "expires_in": 3600
}
```

**Login incorrecto**
```json
// 401 Unauthorized
{ "error": "Email o contraseña incorrectos" }
```

**Perfil**
```bash
curl http://127.0.0.1:8000/api/auth/me \
  -H "Authorization: Bearer <token>"
```
```json
// 200 OK
{
  "id": 1,
  "name": "Juan",
  "email": "juan@mail.com",
  "email_verified_at": null,
  "created_at": "2026-05-14T12:00:00.000000Z",
  "updated_at": "2026-05-14T12:00:00.000000Z"
}
```

### Directores

**Listar directores**
```bash
curl http://127.0.0.1:8000/api/directors \
  -H "Authorization: Bearer <token>"
```
```json
// 200 OK
{
  "current_page": 1,
  "data": [ { "id": 1, "name": "Christopher", "surname": "Nolan", "birthdate": "1970-07-30" } ],
  "total": 1,
  "per_page": 15
}
```

**Crear director**
```bash
curl -X POST http://127.0.0.1:8000/api/directors \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"name": "Christopher", "surname": "Nolan", "birthdate": "1970-07-30"}'
```
```json
// 201 Created
{
  "id": 1,
  "name": "Christopher",
  "surname": "Nolan",
  "birthdate": "1970-07-30",
  "updated_at": "2026-05-14T12:00:00.000000Z",
  "created_at": "2026-05-14T12:00:00.000000Z"
}
```

**Ver director con películas**
```bash
curl http://127.0.0.1:8000/api/directors/1 \
  -H "Authorization: Bearer <token>"
```
```json
// 200 OK
{
  "id": 1,
  "name": "Christopher",
  "surname": "Nolan",
  "birthdate": "1970-07-30",
  "films": [ { "id": 1, "title": "Inception", "release_date": "2010-07-16", "gendre": "Ciencia ficción" } ]
}
```

**Actualizar director**
```bash
curl -X PUT http://127.0.0.1:8000/api/directors/1 \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"name": "Christopher", "surname": "Nolan", "birthdate": "1970-07-30"}'
```
```json
// 200 OK
{ "id": 1, "name": "Christopher", "surname": "Nolan", "birthdate": "1970-07-30" }
```

**Eliminar director**
```bash
curl -X DELETE http://127.0.0.1:8000/api/directors/1 \
  -H "Authorization: Bearer <token>"
```
```json
// 204 No Content
(sin contenido)
```

**Error: director no encontrado**
```json
// 404 Not Found
{ "error": "Director no encontrado." }
```

**Error: director con películas asociadas**
```json
// 409 Conflict
{ "error": "No se puede eliminar el director porque tiene películas asociadas." }
```

### Películas

**Listar películas**
```bash
curl http://127.0.0.1:8000/api/films \
  -H "Authorization: Bearer <token>"
```
```json
// 200 OK
{
  "current_page": 1,
  "data": [ { "id": 1, "title": "Inception", "release_date": "2010-07-16", "sinopsis": "...", "duration": 148, "gendre": "Ciencia ficción", "director_id": 1 } ],
  "total": 1,
  "per_page": 15
}
```

**Crear película**
```bash
curl -X POST http://127.0.0.1:8000/api/films \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"title": "Inception", "release_date": "2010-07-16", "sinopsis": "Un ladrón especializado en robar secretos del subconsciente.", "duration": 148, "gendre": "Ciencia ficción", "director_id": 1}'
```
```json
// 201 Created
{
  "id": 1,
  "title": "Inception",
  "release_date": "2010-07-16",
  "sinopsis": "Un ladrón especializado en robar secretos del subconsciente.",
  "duration": 148,
  "gendre": "Ciencia ficción",
  "director_id": 1,
  "updated_at": "2026-05-14T12:00:00.000000Z",
  "created_at": "2026-05-14T12:00:00.000000Z"
}
```

**Ver película con director**
```bash
curl http://127.0.0.1:8000/api/films/1 \
  -H "Authorization: Bearer <token>"
```
```json
// 200 OK
{
  "id": 1,
  "title": "Inception",
  "release_date": "2010-07-16",
  "sinopsis": "...",
  "duration": 148,
  "gendre": "Ciencia ficción",
  "director_id": 1,
  "director": { "id": 1, "name": "Christopher", "surname": "Nolan", "birthdate": "1970-07-30" }
}
```

**Actualizar película**
```bash
curl -X PUT http://127.0.0.1:8000/api/films/1 \
  -H "Authorization: Bearer <token>" \
  -H "Content-Type: application/json" \
  -d '{"title": "Inception", "duration": 148}'
```
```json
// 200 OK
{ "id": 1, "title": "Inception", "release_date": "2010-07-16", "sinopsis": "...", "duration": 148, "gendre": "Ciencia ficción", "director_id": 1 }
```

**Eliminar película**
```bash
curl -X DELETE http://127.0.0.1:8000/api/films/1 \
  -H "Authorization: Bearer <token>"
```
```json
// 204 No Content
(sin contenido)
```

**Error: película no encontrada**
```json
// 404 Not Found
{ "error": "Película no encontrada." }
```

**Error de validación**
```json
// 422 Unprocessable Content
{
  "message": "El título es obligatorio.",
  "errors": { "title": ["El título es obligatorio."] }
}
```

---

## Base de datos

### Tabla `users`
| Columna | Tipo |
| :--- | :--- |
| `id` | bigint (PK) |
| `name` | varchar |
| `email` | varchar (unique) |
| `email_verified_at` | timestamp (nullable) |
| `password` | varchar |
| `remember_token` | varchar (nullable) |
| `created_at` / `updated_at` | timestamp |

### Tabla `directors`
| Columna | Tipo |
| :--- | :--- |
| `id` | bigint (PK) |
| `name` | varchar |
| `surname` | varchar |
| `birthdate` | date |
| `created_at` / `updated_at` | timestamp |

### Tabla `films`
| Columna | Tipo |
| :--- | :--- |
| `id` | bigint (PK) |
| `title` | varchar |
| `release_date` | date |
| `sinopsis` | text |
| `duration` | integer (minutos) |
| `gendre` | varchar |
| `director_id` | bigint (FK → directors.id) |
| `created_at` / `updated_at` | timestamp |
