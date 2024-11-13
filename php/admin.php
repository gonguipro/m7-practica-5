<?php

session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: php/index.php');
    exit();
}

//Leer los usuarios desde el archivo JSON
$users = json_decode(file_get_contents('data/users.json'), true);

//logica para eliminar usuarios
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])){
    $user_id = $_POST['delete_user'];
    $users = array_filter($users, function ($user) use ($user_id){
        return $user['id'] != $user_id;
    });

    file_put_contents('data/users.json', json_encode(array_values($users), JSON_PRETTY_PRINT));
    header('Location: php/admin.php');  // Redirigir después de eliminar el usuario
    exit();
}

// Lógica para crear nuevos usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];
    $id = count($users) + 1;

    $users[] = ['id' => $id, 'username' => $username, 'password' => $password, 'role' => $role];
    file_put_contents('data/users.json', json_encode($users, JSON_PRETTY_PRINT));
    header('Location: php/admin.php');  // Redirigir después de crear un nuevo usuario
    exit();
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
    <a href="php/index.php">Cerrar sesión</a>

    <h3>Crear nuevo usuario</h3>
    <form method="POST" action="php/admin.php">
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
                    <form method="POST" action="php/admin.php" style="display:inline;">
                        <button type="submit" name="delete_user" value="<?= $user['id'] ?>">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>