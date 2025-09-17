<?php
// Usar SQLite en archivo para persistencia real
$db = new PDO('sqlite:citas_temp.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear la tabla de citas
$db->exec("CREATE TABLE IF NOT EXISTS citas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    correo TEXT NOT NULL,
    fecha TEXT NOT NULL,
    hora TEXT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
)");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Citas Agendadas | Autos Premium</title>
  <link rel="stylesheet" href="estilos.css" />
<style>
    .tabla-citas {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 1.5em;
      background: rgba(255,255,255,0.97);
      border-radius: 1em;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,212,255,0.07);
    }
    .tabla-citas th, .tabla-citas td {
      padding: 12px 8px;
      border-bottom: 1px solid #00d4ff33;
      text-align: center;
      font-size: 1.08em;
    }
    .tabla-citas th {
      background: linear-gradient(90deg, #00d4ff 60%, #0a1428 100%);
      color: #fff;
      font-weight: 600;
      letter-spacing: 1px;
      border: none;
    }
    .tabla-citas tr:last-child td {
      border-bottom: none;
    }
    .tabla-citas tr:hover {
      background: #f0faff;
    }
    .citas-container {
      max-width: 700px;
      margin: 3em auto 2em auto;
      background: rgba(255,255,255,0.97);
      border-radius: 2em;
      box-shadow: 0 8px 32px rgba(0,212,255,0.15), 0 1.5px 8px rgba(0,0,0,0.07);
      padding: 2.5em 2em 2em 2em;
      position: relative;
      z-index: 2;
      border: 1.5px solid #00d4ff33;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .citas-container h2 {
      margin-top: 0;
      color: #0a1428;
      font-size: 1.3em;
      margin-bottom: 1.2em;
    }
    .no-citas {
      color: #888;
      text-align: center;
      margin: 2em 0;
    }
    .btn-cta {
      display: inline-block;
      margin-top: 1em;
      padding: 0.7em 2em;
      background: linear-gradient(90deg, #00d4ff 60%, #0a1428 100%);
      color: #fff;
      border: none;
      border-radius: 2em;
      font-size: 1.1em;
      font-weight: bold;
      letter-spacing: 1px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      cursor: pointer;
      text-decoration: none;
      transition: background 0.2s;
    }
    .btn-cta:hover {
      background: linear-gradient(90deg, #0a1428 60%, #00d4ff 100%);
    }
    @media (max-width: 800px) {
      .citas-container { padding: 1.2em 0.7em 1em 0.7em; }
      .tabla-citas th, .tabla-citas td { font-size: 0.98em; padding: 8px 4px; }
    }
  </style>
</head>
<body>
  <header class="header-principal">
    <div class="header-top">
      <img src="img/logo.png" alt="Logo Autos Premium" class="logo" style="width:120px;height:auto;max-width:100%;" />
      <div class="header-desc">
        <h1>Autos Premium</h1>
        <p class="slogan">Donde el lujo y la tecnología se encuentran en el camino</p>
      </div>
      <form class="busqueda" action="#" method="get">
        <input type="search" name="q" placeholder="Buscar autos, marcas, modelos..." />
        <button type="submit">🔍</button>
      </form>
    </div>
    <nav class="menu-nav">
      <ul>
        <li><a href="index.html">Inicio</a></li>
        <li><a href="#productos">Catálogo</a></li>
        <li><a href="#servicios">Servicios</a></li>
        <li><a href="#blog">Blog</a></li>
        <li><a href="contacto.html">Contacto</a></li>
        <li><a href="politica.html">Privacidad</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="citas-container">
      <h2>Citas registradas</h2>
      <?php
      $result = $db->query("SELECT * FROM citas ORDER BY id DESC");
      if ($result->rowCount() > 0) {
        echo '<table class="tabla-citas">';
        echo '<tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Fecha</th><th>Hora</th><th>Registro</th></tr>';
        foreach ($result as $row) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($row['id']) . '</td>';
          echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
          echo '<td>' . htmlspecialchars($row['correo']) . '</td>';
          echo '<td>' . htmlspecialchars($row['fecha']) . '</td>';
          echo '<td>' . htmlspecialchars($row['hora']) . '</td>';
          echo '<td>' . htmlspecialchars($row['fecha_registro']) . '</td>';
          echo '</tr>';
        }
        echo '</table>';
      } else {
        echo '<div class="no-citas">No hay citas registradas.</div>';
      }
      ?>
      <div style="text-align:center;">
        <a href="index.html" class="btn-cta">Volver al inicio</a>
      </div>
    </section>
  </main>
  <footer class="footer-principal">
    <div class="footer-links">
      <a href="index.html">Inicio</a> |
      <a href="#productos">Catálogo</a> |
      <a href="#servicios">Servicios</a> |
      <a href="#blog">Blog</a> |
      <a href="contacto.html">Contacto</a> |
      <a href="politica.html">Privacidad</a>
    </div>
    <div class="footer-contacto">
      <p>Contacto: info@autospremium.com | Tel: 800-123-4567</p>
      <div class="footer-redes">
        <a href="#" title="Instagram">Instagram</a> |
        <a href="#" title="Facebook">Facebook</a> |
        <a href="#" title="X">X</a>
      </div>
    </div>
    <p>&copy; 2025 Autos Premium. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
