<?php
// admin.php (ejemplo para crear usuario)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ruta del archivo JSON
    $filePath = '../json/user.json';

    // Leer el contenido actual de user.json
    if (file_exists($filePath)) {
        $users = json_decode(file_get_contents($filePath), true);
    } else {
        $users = [];
    }

    // Generar el ID para el nuevo usuario
    $newUserId = count($users) + 1;

    // Crear un nuevo usuario con contraseña encriptada
    $newUser = [
        "id" => $newUserId,
        "username" => $username,
        "password" => password_hash($password, PASSWORD_DEFAULT), // Encriptar la contraseña
        "role" => "user"
    ];

    // Agregar el nuevo usuario al array de usuarios
    $users[] = $newUser;

    // Guardar el array actualizado en user.json
    file_put_contents($filePath, json_encode($users, JSON_PRETTY_PRINT));

    echo "Usuario creado exitosamente.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
</head>
<body>
    <h2>Crear Usuario</h2>
    <form method="POST" action="admin.php">
        <div>
            <label for="username">Usuario</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Crear Usuario</button>
    </form>
</body>
</html>
