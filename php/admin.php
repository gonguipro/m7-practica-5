<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Leer los usuarios desde el archivo JSON
$users = json_decode(file_get_contents('../data/user.json'), true);

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
        header('Location: admin.php');
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
        header('Location: admin.php');
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center text-primary mb-4">Bienvenido, Administrador</h2>
        <div class="text-end mb-3">
            <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Crear nuevo usuario</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="admin.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Nombre de usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select name="role" id="role" class="form-select">
                            <option value="user">Usuario</option>
                            <option value="admin">Administrador</option>
                        </select>
                    </div>
                    <button type="submit" name="create_user" class="btn btn-success">Crear usuario</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Lista de usuarios</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['role'] ?></td>
                                <td>
                                    <form method="POST" action="admin.php" style="display:inline;">
                                        <button type="submit" name="delete_user" value="<?= $user['id'] ?>" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
