<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header("Location: index.php");
    exit(); // Detener la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Usuario</title>
    <style>
        body {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh;
            margin: 0; 
            font-family: Arial, sans-serif; 
        }

        .content {
            text-align: center; 
        }

        .recom {
            text-decoration: none;
            font-size: 25px;
            color: blue;
            display: block; 
            margin-bottom: 10px; 
        }

        a:hover {
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <div class="content">
        <a class="recom" href="recom.php">Recomendación</a>
        <a class="recom" href="spotify.php">Reproductor de música</a>
        <br>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
