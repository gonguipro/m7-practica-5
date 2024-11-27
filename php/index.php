<?php
session_start();

// Si ya está autenticado, redirigir según el rol
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        header('Location: admin.php');
        exit();
    } else {
        header('Location: menu_usuario.php');
        exit();
    }
}

// Lógica para el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Leer los usuarios desde el archivo JSON
    $users = json_decode(file_get_contents('../data/user.json'), true); // Ruta ajustada

    // Verificar si el usuario existe y si la contraseña es correcta
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            // Inicio de sesión exitoso
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirigir dependiendo del rol
            if ($_SESSION['role'] === 'admin') {
                header('Location: admin.php');
            } else {
                header('Location: menu_usuario.php');
            }
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
            <div class="card-header bg-primary text-white text-center">
                <h3>Iniciar Sesión</h3>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Ingresa tu usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
