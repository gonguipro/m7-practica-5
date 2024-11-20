<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Leer los usuarios desde el archivo JSON
$users = json_decode(file_get_contents('../data/user.json'), true); // Ruta ajustada

// Lógica para eliminar usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];
    $users = array_filter($users, function ($user) use ($user_id) {
        return $user['id'] != $user_id;
    });

    // Guardar los cambios en el archivo JSON
    if (file_put_contents('../data/user.json', json_encode(array_values($users), JSON_PRETTY_PRINT)) === false) {
        echo "Error al eliminar el usuario.";
    } else {
        header('Location: admin.php');  // Redirigir después de eliminar el usuario
        exit();
    }
}

// Lógica para crear nuevos usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $id = count($users) + 1;
 
    // Agregar el nuevo usuario al array
    $users[] = [
        'id' => $id,
        'username' => $username,
        'password' => $password,
        'role' => $role
    ];

    // Guardar los cambios en el archivo JSON
    if (file_put_contents('../data/user.json', json_encode($users, JSON_PRETTY_PRINT)) === false) {
        echo "Error al guardar el usuario.";
    } else {
        header('Location: admin.php');  // Redirigir después de crear un nuevo usuario
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestión de Usuarios</title>
</head>
<body>
    <h2>Bienvenido, Administrador</h2>
    <a href="logout.php">Cerrar sesión</a>

    <h3>Crear nuevo usuario</h3>
    <form method="POST" action="admin.php">
        <input type="text" name="username" placeholder="Nombre de usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <select name="role">
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
        </select>
        <button type="submit" name="create_user">Crear usuario</button>
    </form>

    <h3>Lista de usuarios</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <form method="POST" action="admin.php" style="display:inline;">
                        <button type="submit" name="delete_user" value="<?= $user['id'] ?>">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
