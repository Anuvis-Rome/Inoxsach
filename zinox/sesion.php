<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "mysql123";
$database = "inoxsach";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}// Asegúrate de que este archivo conecte a tu base de datos.

if (isset($_POST['correoE']) && isset($_POST['contraE'])) {
    // Función para sanitizar los datos de entrada
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $correoE = validate($_POST['correoE']);
    $contraE = validate($_POST['contraE']);

    if (empty($correoE)) {
        header("Location: InicioS.php?error=El correo es requerido");
        exit();
    } elseif (empty($contraE)) {
        header("Location: InicioS.php?error=La contraseña es requerida");
        exit();
    } else {
        // Consulta segura con sentencias preparadas
        $sql = "SELECT * FROM empleado WHERE correoE = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $correoE);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                // Verificar la contraseña
                if ($row['contraE'] === $contraE) {
                    // Guardar los datos necesarios en la sesión
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['correoE'] = $row['correoE'];
                    $_SESSION['contraE'] = $row['contraE'];

                    // Redirigir al HTML dinámico
                    header("Location: Proy.php");
                    exit();
                } else {
                    header("Location: InicioS.php?error=Correo o contraseña incorrectos");
                    exit();
                }
            } else {
                header("Location: InicioS.php?error=Correo o contraseña incorrectos");
                exit();
            }
        } else {
            header("Location: InicioS.php?error=Error en la consulta");
            exit();
        }
    }
} else {
    header("Location: InicioS.php");
    exit();
}
?>
