# 🚗 Sitio Web de Venta de Autos – Autos Premium

Este proyecto es un ejemplo de un **sitio web de venta de autos** diseñado para mostrar buenas prácticas en la estructura de una página web y la conexión a base de datos desde un formulario.

## 📄 Características

- **Estructura completa de página web:** Header, body y footer.
- **Menú de navegación** con enlaces a Inicio, Contacto y Política de Privacidad.
- **Galería de autos destacados** con imágenes y descripción de cada modelo.
- **Formulario para agendar citas** de muestra de autos.
- **Conexión a base de datos MySQL** para almacenar las solicitudes de citas.
- **Diseño responsive básico** con HTML y CSS puro.

## 🛠️ Tecnologías utilizadas

- **Frontend:** HTML5, CSS3
- **Backend:** PHP
- **Base de datos:** MySQL

## 📂 Estructura del proyecto

venta_autos/
│
├── .vscode/
│   └── launch.json              # Configuración de VSCode (si quieres mantenerlo)
│
├── img/
│   ├── logo.png                 # Logo del sitio
│   └── catalogo/                # Todas las imágenes de autos
│       ├── auto1.jpg
│       ├── auto2.jpg
│       └── ... 
│
├── sql/
│   └── citas_db.sql             # Script para crear la base de datos y tabla
│
├── css/
│   └── estilos.css              # Estilos del sitio
│
├── php/
│   ├── conexion.php             # Conexión a la base de datos
│   ├── agendar_cita.php         # Inserción de citas en la base
│   └── ver_citas.php            # (opcional) ver citas desde admin
│
├── index.html                   # Página principal
├── contacto.html                # Página de contacto
├── politica.html                # Política de privacidad
└── README.md                    # Descripción del proyecto



## 🗃️ Base de datos

Crea la base de datos y tabla:

```sql
CREATE DATABASE autos_db;
USE autos_db;

CREATE TABLE citas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100),
  correo VARCHAR(100),
  fecha DATE
);
