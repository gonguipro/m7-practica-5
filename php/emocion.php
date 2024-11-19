<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomendador de Canciones</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <a href="logout.php">Cerrar Sesión</a>
    </header>
    <main>
        <form id="moodForm" method="POST" action="recom.php">
            <label for="mood">Selecciona tu estado de ánimo:</label>
            <select id="mood" name="mood" required>
                <option value="">--Seleccionar--</option>
                <option value="Feliz">Feliz</option>
                <option value="Triste">Triste</option>
                <option value="Energético">Energético</option>
                <option value="Relajado">Relajado</option>
                <option value="Inspirado">Inspirado</option>
                <option value="Estresado">Estresado</option>
            </select>
            <button type="submit">Obtener Recomendación</button>
        </form>
        <div id="recommendation"></div>
    </main>
    <script src="func.js"></script>
</body>
</html>
