<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el estado de ánimo seleccionado
    $mood = $_POST['mood'];
    
    // Definir las recomendaciones de música por estado de ánimo
    $recommendations = [
        "Feliz" => '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/7iK8PXO48WeuP03g8YR51W?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>',
        "Triste" => '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/4q3ewBCX7sLwd24euuV69X?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>',
        "Energético" => '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/1mcTU81TzQhprhouKaTkpq?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>',
        "Relajado" => '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/2CCgb0KApjfQDuTppovpf8?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>',
        "Inspirado" => '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/2O8vbr4RYPpk6MRA4fio7u?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>',
        "Estresado" => '<iframe style="border-radius:12px" src="https://open.spotify.com/embed/artist/3lY9Fxceu60W1rbon7PkuF?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>',
    ];

    // Verificar si el estado de ánimo existe en las recomendaciones
    if (array_key_exists($mood, $recommendations)) {
        echo "<h2>Recomendación para estado de ánimo: $mood</h2>";
        echo $recommendations[$mood];  // Mostrar el iframe correspondiente
    } else {
        echo "<p>Por favor, selecciona un estado de ánimo válido.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recomendaciones Musicales</title>
</head>
<body>
    <h2>¿Cómo te sientes hoy?</h2>
    
    <!-- Formulario para seleccionar el estado de ánimo -->
    <form method="POST" action="">
        <label for="mood">Selecciona tu estado de ánimo:</label>
        <select name="mood" id="mood" required>
            <option value="Feliz">Feliz</option>
            <option value="Triste">Triste</option>
            <option value="Energético">Energético</option>
            <option value="Relajado">Relajado</option>
            <option value="Inspirado">Inspirado</option>
            <option value="Estresado">Estresado</option>
        </select>
        <button type="submit">Ver recomendación</button>
    </form>

    <br><br>
    <!--Enlace para volver a atras al menu-->
    <a href="menu_usuario.php">Volver al menu</a>
    <!-- Enlace para cerrar sesión -->
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
