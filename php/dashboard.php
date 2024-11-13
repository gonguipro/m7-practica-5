<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}
?>
<h1>Bienvenido, <?php echo $_SESSION["username"]; ?></h1>
<p>Acceso al panel de administración.</p>
<a href="logout.php">Cerrar sesión</a>
