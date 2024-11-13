<?php
session_start();
session_unset();   // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión

// Limpiar caché del navegador
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

// Redirigir al inicio de sesión
header('Location: index.php');
exit();
?>
