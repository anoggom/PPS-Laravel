# 🎬 Peliculapp

<p align="left">
  <img src="https://img.shields.io/badge/STATUS-EN%20DESARROLLO-green?style=for-the-badge" alt="Status">
  <img src="https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/JWT-Authentication-black?style=for-the-badge&logo=json-web-tokens" alt="JWT">
</p>

> Es una aplicación que permite buscar información relacionada con peliculas y sus respectivos directores. Esta construida con **Laravel** y **Blade**, ademas de estar protegida mediante autenticación **JWT**.

---

## 📑 Índice
*   [🛠️ Requisitos](#requisitos)
*   [🚀 Instalación](#instalación)
*   [⚙️ Configuración (.env)](#configuración-env)
*   [🔐 Autenticación JWT](#autenticación-jwt)
*   [🧭 Endpoints](#endpoints)
*   [🗄️ Base de datos](#base-de-datos)

---

## 🛠️ Requisitos

| Recurso | Versión / Detalle |
| :--- | :--- |
| **PHP** | 8.1+ |
| **Composer** | Última versión estable |
| **Base de datos** | MySQL o MariaDB |
| **Extensiones PHP** | `openssl`, `pdo`, `mbstring`|
| **Seguridad** | `JWT_SECRET` configurado en `.env` |

---

## 🚀 Instalación

Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

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

5. 
  - **Iniciar en modo producción:**
    ```bash
    php artisan serve
    ```
  - **Iniciar en modo desarrollo:**
    ```bash
    composer run dev
    ```
> 📍 El servidor en modo desarrollo estará disponible en: `http://127.0.0.1:8000`

---

## ⚙️ Configuración (.env)

Asegúrate de ajustar los siguientes valores en tu archivo de configuración:
```env
APP_NAME=PPS-Laravel
APP_URL=[http://127.0.0.1:8000](http://127.0.0.1:8000)

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_bd
DB_USERNAME=usuario
DB_PASSWORD=contraseña

JWT_SECRET=tu_clave_generada
```

---

## 🔐 Autenticación JWT

### 🆕 Registro de Usuario
**Endpoint:** `POST /api/auth/register`

```json
{
  "name": "Usuario",
  "email": "usuario@ejemplo.com",
  "password": "password",
  "password_confirmation": "password"
}
```

### 🔑 Inicio de Sesión
**Endpoint:** `POST /api/auth/login`

```json
{
  "email": "usuario@ejemplo.com",
  "password": "password"
}
```

**Respuesta Exitosa:**
```json
{
  "message": "Login OK",
  "access_token": "eyJ0eXAiOiJKV1Qi...",
  "token_type": "bearer",
  "expires_in": 3600
}
```

### 🔄 Gestión de Sesión
*   **Obtener Perfil:** `GET /api/auth/me` (Requiere `Authorization: Bearer TU_TOKEN`)
*   **Refrescar Token:** `POST /api/auth/refresh`
*   **Cerrar Sesión:** `POST /api/auth/logout`

---

## 🧭 Endpoints

### 👤 Auth (`/api/auth`)
| Método | Ruta | Descripción | Auth |
| :--- | :--- | :--- | :---: |
| `POST` | `/login` | Iniciar sesión | ✗ |
| `POST` | `/register` | Registrar usuario | ✗ |
| `POST` | `/logout` | Cerrar sesión | ✓ |
| `POST` | `/refresh` | Refrescar token | ✓ |
| `GET` | `/me` | Datos del usuario | ✓ |


### 🎬 Recursos (`/api`)
| Método | Ruta | Descripción | Auth |
| :--- | :--- | :--- | :---: |
| `GET` | `/directors` | Listar directores | ✓ |
| `GET` | `/directors/{id}` | Ver director específico | ✓ |
| `GET` | `/films` | Listar películas | ✓ |
| `GET` | `/films/{id}` | Ver película específica | ✓ |


---

## 🗄️ Base de Datos

### 🏢 Tabla `directors`
| Columna | Tipo |
| :--- | :--- |
| `id` | bigint (PK) |
| `name` | varchar |
| `surname` | varchar |
| `birthdate` | date |
| `created_at` / `updated_at` | timestamp |


### 🎞️ Tabla `films`
| Columna | Tipo |
| :--- | :--- |
| `id` | bigint (PK) |
| `title` | varchar |
| `released_date` | year |
| `sinopsis` | varchar |
| `duration` | integer |
| `gendre` | varchar |
| `director_id` | bigint (FK) |
| `created_at` / `updated_at` | timestamp |


### 👥 Tabla `users`
| Columna | Tipo |
| :--- | :--- |
| `id` | bigint (PK) |
| `name` | varchar |
| `email` | varchar |
| `password` | varchar |
| `rember_token` | varchar |
| `email_verified_at` | timestamp |
| `created_at` / `updated_at` | timestamp |
