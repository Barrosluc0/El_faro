<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Faro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <!-- Barra de avisos -->
    <div class="notification-bar">
        <strong><i class="fas fa-bolt"></i> ÚLTIMA HORA:</strong> Tormentas eléctricas afectarán la Región Metropolitana hoy por la tarde.
    </div>

    <!-- Header y Navbar -->
    <div class="header-logo">
        <img src="./img/faro.png" alt="Logo El Faro">
        <div class="header-title">
            <span>EL</span>
            <span>FARO</span>
        </div>
    </div>

    <nav class="navbar">
        <div class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href=".?page=home">Inicio</a>
                <a class="navbar-item" href=".?page=deportes">Deportes</a>
                <a class="navbar-item" href=".?page=negocios">Negocios</a>
            </div>
            <div class="navbar-end">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="navbar-item"><?= $_SESSION['user']['name'] ?></span>
                <?php else: ?>
                    <a class="navbar-item" href=".?page=registro">Registrarse</a>
                    <a class="navbar-item" href=".?page=login">Iniciar sesión</a>
                <?php endif; ?>
                <button id="toggle-form" class="button is-primary is-small mr-3">
                    Nueva Noticia
                </button>
                <span id="contador-articulos" class="contador-texto">Contador de artículos: 9</span>
            </div>
        </div>
    </nav>

    <!-- Fecha y hora -->
    <div class="date-time-bar">
        <div id="fecha-hora"></div>
    </div>

    <!-- Formulario desplegable -->
    <div id="form-agregar" class="box is-hidden">
        <h2 class="subtitle">Agregar Noticia</h2>
        <div class="field">
            <input class="input" type="text" id="titulo-articulo" placeholder="Título">
        </div>
        <div class="field">
            <input class="input" type="text" id="categoria-articulo" placeholder="Categoría">
        </div>
        <div class="field">
            <input class="input" type="text" id="imagen-articulo" placeholder="URL de la imagen">
        </div>
        <div class="field">
            <textarea class="textarea" id="contenido-articulo" placeholder="Contenido"></textarea>
        </div>
        <button class="button is-primary" onclick="agregarArticulo()">Publicar</button>
    </div>