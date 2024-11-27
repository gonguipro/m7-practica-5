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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproductor de música</title>
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/player.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" defer></script>
</head>
<body>
<div class="titulo">
        <h1>MUSIC APP</h1>
        <p>WEB APP PARA ESCUCHAR MUSICA Y RADIO</p>
    </div>

    <div class="menu">
        <a href="spotify.php">MUSICA</a>
        <a href="radio.php">RADIO</a>
    </div>

    <div id="main">
        <div id="player" class="hidden">
            <!-- Fondo dinámico -->
            <div id="background" style="background-image: url('');"></div> 
            <img id="cover" src="" alt="Portada de la canción">
            <h2 id="title"></h2>
            <h3 id="artist"></h3>
            <div id="controls">
                <button id="prev" class="control-btn">◀◀</button>
                <button id="play" class="control-btn">▶</button>
                <button id="next" class="control-btn">▶▶</button>
            </div>
            <input type="range" id="seekbar" value="0" min="0" step="0.1">
        </div>

        <div class="display-music">
            <h2>ELIGE UNA CANCION</h2>
            <button class="song" data-src="../audio/Art Blakey & the Jazz Messengers - Moanin'.mp3" style="background-image: url('../img/musica/moanin.jpg');" data-artist="Art Blakey & the Jazz Messengers" >Moanin'</button>
            <button class="song" data-src="../audio/Heroes (2017 Remaster).mp3" style="background-image: url('../img/musica/heroes.jpg');" data-artist="David Bowie">Heroes</button>
            <button class="song" data-src="../audio/Marvin Gaye - What's Going On.mp3" style="background-image: url('../img/musica/wgo.jpg');" data-artist="Marvin Gaye">What's Going On</button>
            <button class="song" data-src="../audio/Money For Nothing.mp3" style="background-image: url('../img/musica/Moneyfornothing2.jpg');" data-artist="Dire Straits">Money For Nothing</button>
            <button class="song" data-src="../audio/The Thrill Is Gone.mp3" style="background-image: url('../img/musica/ttig.jpg');" data-artist="B.B. King">The Thrill Is Gone</button>
        </div>
    </div>
    <div id="equalizer" class="hidden">
        <h2>ECUALIZADOR</h2>
        <div id="equalizer-bars">
            <div class="equalizer-bar" id="bar-0"></div>
            <div class="equalizer-bar" id="bar-1"></div>
            <div class="equalizer-bar" id="bar-2"></div>
            <div class="equalizer-bar" id="bar-3"></div>
            <div class="equalizer-bar" id="bar-4"></div>
            <div class="equalizer-bar" id="bar-5"></div>
            <div class="equalizer-bar" id="bar-6"></div>
            <div class="equalizer-bar" id="bar-7"></div>
        </div>
        <div id="volume-control">
            <label for="volume">Volumen:</label>
            <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
            <button id="mute-btn">🔊</button>
        </div>
    </div>

    <a href="menu_usuario.php">Volver al menu</a>
</body>
</html>