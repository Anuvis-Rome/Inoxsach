<?php
$servername = "localhost";
$username = "root";
$password = "mysql123";
$database = "inoxsach";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
