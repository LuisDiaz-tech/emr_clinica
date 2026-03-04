#EMR Clínica - Sistema de Gestión de Citas Médicas

Mini aplicación desarrollada en PHP 8 + PostgreSQL bajo arquitectura MVC con PSR-4, que permite gestionar pacientes, médicos y citas médicas con control de roles.

Este proyecto fue desarrollado como prueba técnica para desarrollador.

---

# Tecnologías utilizadas

- PHP 8
- PostgreSQL
- Composer (PSR-4 Autoload)
- PDO
- HTML básico
- Git / GitHub

---

# Arquitectura del proyecto

Se implementa una arquitectura MVC simple.

---

# Funcionalidades implementadas

## Autenticación

- Login de usuarios
- Manejo de sesiones
- Control de acceso por rol

Roles del sistema:

| Rol           | Permisos                     |
| ------------- | ---------------------------- |
| Administrador | gestiona usuarios y reportes |
| Recepcionista | gestiona pacientes y agenda  |
| Médico        | ve sus citas y cambia estado |

---

# Gestión de Pacientes

CRUD completo:

- Crear paciente
- Listar pacientes
- Buscar por nombre o documento
- Editar paciente
- Eliminar paciente

# Gestión de Médicos

CRUD completo:

- Crear médico
- Listar médicos
- Editar médico
- Eliminar médico

# Gestión de Médicos

CRUD completo:

- Crear médico
- Listar médicos
- Editar médico
- Eliminar médico

Reglas implementadas:

No se permiten citas en fechas pasadas

No se permite agendar dos citas al mismo médico en el mismo horario

# Panel del Médico

El médico puede:

- Ver solo sus citas

# Indicador de Cumplimiento

Reporte para administradores que calcula:

- Total de citas programadas
- Total de citas atendidas
- Total de citas no asistidas
- Porcentaje de cumplimiento

# Instalación del proyecto

1. Clonar repositorio
   https://github.com/LuisDiaz-tech/emr_clinica.git

2. Instalar dependencias
   composer install

3. Crear base de datos
   Ejecutar: database/schema.sql

4. Configurar conexión
   Editar: config/Database.php

5. Ejecutar proyecto
   Abrir en navegador:
   http://localhost/emr_clinica/public

Autor
Felipe Díaz
https://github.com/LuisDiaz-tech
