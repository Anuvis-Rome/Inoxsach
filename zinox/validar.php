<?php
// validar.php
session_start();

// Credenciales
$usuario_valido = "usuario1";
$contrasena_valida = "contraseña123";

// Verifica las credenciales
if ($_POST['usuario'] === $usuario_valido && $_POST['contrasena'] === $contrasena_valida) {
    $_SESSION['usuario'] = $usuario_valido; // Guarda el usuario en la sesión
    header("Location: index.php"); // Redirige al sistema principal
    exit;
} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='login.php';</script>";
}
?>
