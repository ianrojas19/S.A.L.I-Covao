# SALI - Sistema de Administración de Llaves

Este repositorio contiene el código fuente de **SALI**, un sistema de gestión de llaves y control de accesos, diseñado para instituciones educativas (principalmente **COVAO**).  
El sistema está dividido en módulos de **administradores** y **profesores**, cada uno con funcionalidades específicas para garantizar un control eficiente y organizado.

---

## 📌 Módulos de Administradores

### 🔹 Registro de Actividad
El **panel de Actividad** permite consultar y visualizar todos los registros relacionados con el uso de llaves, incluyendo:
- Retiros
- Devoluciones
- Solicitudes realizadas por los profesores  

Provee un historial detallado que facilita el **seguimiento y control del uso de llaves** dentro de la institución.

---

### 🔹 Panel de Llaves
Desde este panel, el administrador puede:
- Visualizar todas las llaves registradas.
- Consultar el estado actual de cada llave.
- Revisar la razón de su uso y el responsable.  

Esta sección facilita la **gestión y control del acceso** a los espacios físicos.

---

### 🔹 Perfiles
El **panel de Perfiles** muestra todos los usuarios registrados en el sistema:
- Administradores
- Profesores  

Funciones principales:
- Consultar información detallada de cada perfil.
- Crear nuevos perfiles.
- Asignar especialidad y horario a profesores.  

De esta forma se facilita la **gestión completa y organizada del personal docente**.

---

### 🔹 Solicitudes
En esta sección el administrador puede:
- Revisar solicitudes de registro y solicitudes de llaves.
- Aceptar o denegar solicitudes.
- Acceder a la información detallada asociada.  

---

### 🔹 Gestión General
Funciones disponibles:
- Listado completo de todas las llaves registradas.
- Crear, actualizar o eliminar llaves.
- Gestión de **especialidades** y **subáreas** (crear, editar o eliminar).  

Garantiza una organización precisa y actualizada de los recursos.

---

### 🔹 Opciones
Sección que incluye:
- Cambio de contraseña.
- Cierre de sesión.
- Consulta de manuales de usuario (administrador y profesor).
- Revisión de actualizaciones.
- Botón para visualizar el código de retiro de llaves.

---

## 📌 Módulos de Profesores

### 🔹 Actividad
El **panel de Actividad** permite al profesor visualizar el historial de:
- Solicitudes realizadas.
- Retiros y devoluciones de llaves.  

---

### 🔹 Panel de Llaves
El profesor puede:
- Visualizar el estado actual de las llaves.
- Revisar la razón de uso.
- Confirmar la persona que porta la llave en cada momento.  

---

### 🔹 Solicitudes
Sección donde los profesores pueden:
- Realizar solicitudes de llaves.
- Consultar el estado de sus solicitudes.  

---

### 🔹 Opciones
Incluye:
- Cambio de contraseña (confirmación por e-mail).
- Cierre de sesión.
- Acceso a manual de usuario para profesores.
- Visualización del código de retiro de llaves.

---

## 🗄️ Base de Datos y Dominio Web

La **base de datos incluida en este repositorio** solo contiene información **funcional** para el correcto servicio de SALI.  
Toda la infraestructura real fue hospedada por **Aurosoft Solutions**.  

### Condiciones:
- La **base de datos completa** puede ser adquirida por **₡50,000** (colones costarricenses), coordinando previamente al correo:  
  📧 soporte@aurosoftsl.com  
- El dominio web **salicovao.com** y **ayuda.salicovao.com** también puede ser transferido por **₡10,000** a la institución correspondiente.

---

## ⚙️ Condiciones Funcionales Existentes

- El sistema originalmente usaba un **correo electrónico proporcionado por el antiguo proveedor de TI**.  
- Actualmente, para que el **correo SMTP funcione**, se requiere contratar un **nuevo proveedor de servicios de correo**.  

### Acceso inicial al sistema:
- Usuario: `admin@covao.ed.cr`  
- Contraseña: `19101910`  

⚠️ **Recomendación:** estas credenciales deben ser **reemplazadas inmediatamente** por motivos de seguridad.

---

## 📦 Instalación y Versiones

- El sistema se debe instalar en un servidor Apacha HTTP, con PHP 8.3, que posea una base de datos MySQL 8.4 en adelante.

- La instalación dependerá del **equipo informático** que gestione el servidor donde se desplegará **SALI**.  

### Versión 2
La versión actualizada de SALI incluye:
- Todos los cambios solicitados en **agosto 2025** por parte del COVAO diurno y módulos extra de seguridad.  
- Dominio propio.  
- Sitio Web de Ayuda y Capacitaciones.
- Base de datos con la información completa.  
- Soporte para servicio web y correo electrónico.  
- **Soporte técnico completo**.  

Para adquirir la versión 2, comunicarse al correo:  
📧 soporte@aurosoftsl.com  

---

## 🏷️ Créditos
Desarrollado y hospedado por **Aurosoft Solutions**.
