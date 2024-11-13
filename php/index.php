<?php
session_start();

// Si ya está autenticado, redirigir al dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');  // Redirige al dashboard dentro de la misma carpeta
    exit();
}

// Lógica para el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Leer los usuarios desde el archivo JSON
    $users = json_decode(file_get_contents('../json/users.json'), true); // Ruta ajustada para acceder a data

    // Verificar si el usuario existe y si la contraseña es correcta
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            // Inicio de sesión exitoso
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: dashboard.php');  // Redirige al dashboard dentro de la misma carpeta
            exit();
        }
    }

    // Si no se encuentra el usuario o la contraseña es incorrecta
    $error = 'Usuario o contraseña incorrectos';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Formulario de Ingreso</h2>
    <form method="POST" action="index.php">  <!-- Sin 'php/' ya que index.php está en la misma carpeta -->
        <div>
            <label for="username">Usuario</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>

    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>
