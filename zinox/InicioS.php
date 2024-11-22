<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        body {
            background-image: url('fondo.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        form {
            text-align: center;
            background-color: rgba(255, 164, 164, 0.9);
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        input, button {
            width: 100%;
            height: 45px;
            margin-bottom: 20px;
            font-size: 16px;
            padding: 0 10px;
        }

        button {
            background-color: #ff6b6b;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff4d4d;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form action="sesion.php" method="POST">
        <img src="tpm2.png" alt="Logo" width="150" height="120">
        <h2>Inicio de Sesión</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
        <label for="Usu">Usuario</label>
        <input type="text" name="Usu" id="Usu" placeholder="Correo electrónico" required>

        <label for="Contra">Clave</label>
        <input type="password" name="Contra" id="Contra" placeholder="Contraseña" required>

        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
