# 🚀 User Registration - Clean Architecture & DDD

Este proyecto es un desarrollo de un registro de usuarios, construida siguiendo **Clean Architecture** y **Domain-Driven Design (DDD)**.\
Usa **PHP 8, Doctrine ORM, MySQL y Nginx en Docker** para su ejecución.

---

## 📌 **Requisitos previos**

Asegúrate de tener instalados los siguientes programas en tu máquina antes de ejecutar el proyecto:

- [Docker](https://docs.docker.com/get-docker/) (Última versión)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Make](https://www.gnu.org/software/make/) (Opcional pero recomendado)
- **Puertos requeridos (deben estar liberados)**:
  - `8080` → Para acceder a la API (Nginx)
  - `3307` → Para la base de datos MySQL dentro de Docker
  - `9000` → PHP-FPM

---

## 🚀 **Instalación y ejecución**

### **1️⃣ Clonar el repositorio**

```bash
git clone https://github.com/cesars1687/technical_test_user
cd technical_test_user
```

### **2️⃣ Levantar los servicios con Docker**

```bash
make init
```

O manualmente:

```bash
cd docker
docker compose up -d --build
```

📌 **Esto iniciará los contenedores de PHP 8, MySQL y Nginx en Docker.**

---


## 🧪 **Ejecución de pruebas**

El proyecto incluye pruebas unitarias y de integración usando **PHPUnit**.

### **Ejecutar todas las pruebas**

```bash
make test
```

### **Ejecutar solo pruebas unitarias**

```bash
make unit
```

### **Ejecutar solo pruebas de integración**

```bash
make integration
```

---

## 📬 **Uso de la API**

### **Registrar un usuario**

📌 **Endpoint:** `POST /users`\
📌 **URL:** `http://localhost:8080/users`

🔹 **Ejemplo de solicitud en JSON:**

```json
{
    "name": "César Herbozo",
    "email": "cesarhm1687@gmail.com",
    "password": "StrongPass123!"
}
```

🔹 **Respuesta esperada:**

```json
{
    "message": "User registered successfully"
}
```

⚠️ **Si intentas registrar el mismo correo dos veces, obtendrás:**

```json
{
    "error": "The email is already in use."
}
```

---

## 🛑 **Apagar y limpiar los contenedores**

Si deseas detener los servicios, ejecuta:

```bash
make stop
```

O manualmente:

```bash
cd docker
docker compose down
```

---

## 🏗 **Estructura del proyecto**

```
├── src/
│   ├── Application/        # Casos de uso (Use Cases)
│   ├── Domain/             # Entidades, Value Objects y Excepciones
│   ├── Infrastructure/     # Persistencia con Doctrine ORM
│   ├── Presentation/       # Controladores y puntos de entrada HTTP
│   └── bootstrap.php       # Configuración de Doctrine ORM
│
├── tests/                  
│   ├── Unit/               # Pruebas unitarias
│   ├── Integration/        # Pruebas de integración
│   ├── bootstrap.php       # Configuración de PHPUnit
│
├── docker/                 
│   ├── docker-compose.yml  # Orquestación de contenedores
│   ├── nginx/              # Configuración de Nginx
│   ├── php/                # Configuración de PHP-FPM
│   ├── mysql/              # Configuración de MySQL
│
├── Makefile                # Atajos para ejecutar comandos
├── composer.json           # Dependencias PHP
├── README.md               # Documentación
```



