<?php
session_start(); // Inicia la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigir al inicio de sesión
    header("Location: index.php"); // Redirige a la página de login
    exit(); // Detiene la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio App</title>
    <link rel="stylesheet" href="../css/radio.css">
    <script src="../js/radio.js" defer></script>
</head>
<body>
    <div class="titulo">
        <h1>RADIO APP</h1>
        <p>ESCUCHA TUS ESTACIONES FAVORITAS</p>
    </div>

    <div class="menu">
        <a href="spotify.php">MUSICA</a>
        <a href="radio.php">RADIO</a>
    </div>

    <div id="main">
        <div id="player" class="hidden">
            <!-- Fondo dinámico -->
            <div id="background" style="background-image: url('');"></div>
            <img id="cover" src="" alt="Portada de la emisora">
            <h2 id="title"></h2>
            <h3 id="artist"></h3>
            <div id="controls">
                <button id="prev" class="control-btn">◀◀</button>
                <button id="play" class="control-btn">▶</button>
                <button id="next" class="control-btn">▶▶</button>
            </div>
            <input type="range" id="seekbar" value="0" min="0" step="0.1">
        </div>

        <div class="display-radio">
            <h2>ELIGE UNA RADIO</h2>
            <button class="station" data-src="https://23623.live.streamtheworld.com/LOS40_DANCE_SC" style="background-image: url('../img/radio/radio.jpg');" data-name="Los 40 Dance">Los 40 Dance</button>
            <button class="station" data-src="https://us-b4-p-e-cg11-audio.cdn.mdstrm.com/live-audio-aw/65afe4a0357cec56667ac739?aid=65afe021932b88086588cb4c&pid=eCpvrk22VYKVPujdU9WYBrqVRyLAbqKJ&sid=uua35KcpPYHOQTit8z3hCgY5fk1bQBsZ&uid=wUrLc416fzhXe3xbXk5igaxfeoQ4AOLX&es=us-b4-p-e-cg11-audio.cdn.mdstrm.com&ote=1731258623198&ot=K9z5x3AgT9-E0GIYzuMSkA&proto=https&pz=us&cP=128000&awCollectionId=65afe021932b88086588cb4c&liveId=65afe4a0357cec56667ac739&listenerId=wUrLc416fzhXe3xbXk5igaxfeoQ4AOLX" style="background-image: url('../img/radio/radio.jpg');" data-name="Flaix FM">Flaix FM</button>
            <button class="station" data-src="https://25543.live.streamtheworld.com/RAC_1_SC" style="background-image: url('../img/radio/radio.jpg');" data-name="RAC 1">RAC 1</button>
            <button class="station" data-src="https://rockfm-cope-rrcast.flumotion.com/cope/rockfm-low.mp3" style="background-image: url('../img/radio/radio.jpg');" data-name="Rock FM">Rock FM</button>
            <button class="station" data-src="https://25653.live.streamtheworld.com/CADENASER_SC" style="background-image: url('../img/radio/radio.jpg');" data-name="SER">SER</button>
            
        </div>
    </div>
    <a href="menu_usuario.php">Volver al menú</a>
</body>
</html>
