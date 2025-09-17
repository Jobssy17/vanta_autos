<?php
// Usar SQLite en archivo para persistencia real
$db = new PDO('sqlite:citas_temp.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear la tabla de citas en el archivo si no existe
$db->exec("CREATE TABLE IF NOT EXISTS citas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    correo TEXT NOT NULL,
    fecha TEXT NOT NULL,
    hora TEXT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
)");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// Insertar la cita en el archivo (persistente)
$stmt = $db->prepare("INSERT INTO citas (nombre, correo, fecha, hora) VALUES (?, ?, ?, ?)");
$stmt->execute([$nombre, $correo, $fecha, $hora]);

// Mostrar todas las citas guardadas
echo '<h2>Citas registradas:</h2>';
$result = $db->query("SELECT * FROM citas ORDER BY id DESC");
echo '<table border="1" cellpadding="6" style="margin-bottom:2em;"><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Fecha</th><th>Hora</th><th>Registro</th></tr>';
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

// Enviar correo de confirmación
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../index_/PHP/vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jm7996613@gmail.com';
    $mail->Password = 'ehzs tfur zffj ichh';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('jm7996613@gmail.com', 'Autos Premium');
    $mail->addAddress($correo, $nombre);
    $mail->addAddress('jm7996613@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Confirmación de cita para muestra de auto - Autos Premium';
    $mail->Body = '
    <div style="max-width:500px;margin:30px auto;padding:30px 30px 20px 30px;background:#fff;border-radius:18px;box-shadow:0 4px 24px #00d4ff22;font-family:Segoe UI,Arial,sans-serif;">
      <div style="text-align:center;margin-bottom:20px;">
        <a href="https://ibb.co/MyphV2tV"><img src="https://i.ibb.co/MyphV2tV/logo.png" alt="logo" border="0"></a>
        <h1 style="color:#00d4ff;margin:10px 0 0 0;font-size:2em;letter-spacing:1px;">Autos Premium</h1>
        <p style="color:#222;font-size:1.1em;margin:0;">Donde el lujo y la tecnología se encuentran en el camino</p>
      </div>
      <hr style="border:0;border-top:1px solid #eee;margin:20px 0;">
      <h2 style="color:#222;text-align:center;margin-bottom:18px;">¡Gracias por agendar tu cita!</h2>
      <p style="font-size:1.1em;color:#333;">Hola <strong>' . htmlspecialchars($nombre) . '</strong>,<br>
      Hemos recibido tu solicitud para agendar una cita de muestra de auto. Pronto uno de nuestros asesores se pondrá en contacto contigo para confirmar los detalles.</p>
      <div style="background:#f7faff;border-radius:10px;padding:18px 20px;margin:18px 0 24px 0;">
        <p style="margin:0 0 8px 0;"><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</p>
        <p style="margin:0 0 8px 0;"><strong>Correo:</strong> ' . htmlspecialchars($correo) . '</p>
        <p style="margin:0 0 8px 0;"><strong>Fecha de la cita:</strong> ' . htmlspecialchars($fecha) . '</p>
        <p style="margin:0;"><strong>Hora de la cita:</strong> ' . htmlspecialchars($hora) . '</p>
      </div>
      <p style="color:#555;font-size:0.98em;">Si tienes dudas, contáctanos:<br>
      <strong>Email:</strong> info@autospremium.com<br>
      <strong>Teléfono:</strong> 800-123-4567</p>
      <hr style="border:0;border-top:1px solid #eee;margin:24px 0 10px 0;">
      <p style="text-align:center;color:#aaa;font-size:0.95em;">&copy; 2025 Autos Premium. Todos los derechos reservados.</p>
    </div>';

    $mail->send();
    echo "Cita agendada con éxito. Se ha enviado un correo de confirmación.";
} catch (Exception $e) {
    echo "Cita registrada, pero error al enviar el correo: {$mail->ErrorInfo}";
}
?>