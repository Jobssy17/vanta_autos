<?php
$host = "localhost";
$user = "root";
$pass = 'p4s$w0rd';
$db = "autos_premium";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>