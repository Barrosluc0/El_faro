<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../models/User.php';  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Faro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./styles.css">
        <style>
        /* Fondo azul uniforme para navbar y menú desplegable */
        nav.navbar.is-primary,
        .navbar-menu {
            background-color:#2a3f54 !important; /* azul intenso */
        }

        /* Color blanco para todos los links y textos dentro del navbar */
        .navbar-item,
        .navbar-burger {
            color: white !important;
        }

        /* Para que el ícono hamburguesa tenga líneas blancas */
        .navbar-burger span {
            background-color: white !important;
        }

        /* Hover de los links con fondo más oscuro */
        .navbar-item:hover {
            background-color:#2a3f54 !important;
            color: white !important;
        }
    </style>
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

    <!-- Navbar Responsive -->
    <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a role="button" class="navbar-burger has-text-white" aria-label="menu" aria-expanded="false" data-target="navbar-menu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbar-menu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item has-text-white" href=".?page=home">Inicio</a>
                <a class="navbar-item has-text-white" href=".?page=deportes">Deportes</a>
                <a class="navbar-item has-text-white" href=".?page=negocios">Negocios</a>
                <a class="navbar-item has-text-white" href=".?page=contacto">Contacto</a>
            </div>

            <div class="navbar-end">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="navbar-item has-text-white"><?= htmlspecialchars($_SESSION['user']['nombre']) ?></span>
                    
                    <?php if (User::isAdmin($_SESSION['user']['correo'])): ?>
                        <a class="navbar-item has-text-white" href="./?page=admin/contactos">
                            <span class="icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <span>Mensajes</span>
                        </a>
                    <?php endif; ?>

                    <a class="navbar-item has-text-white" href="./?page=logout">Cerrar sesión</a>
                    <button id="toggle-form" class="button is-primary is-small mr-3 navbar-item">Nueva Noticia</button>
                <?php else: ?>
                    <a class="navbar-item has-text-white" href=".?page=registro">Registrarse</a>
                    <a class="navbar-item has-text-white" href=".?page=login">Iniciar sesión</a>
                <?php endif; ?>

                <span id="contador-articulos" class="navbar-item has-text-white">Contador de artículos: 9</span>
            </div>
        </div>
    </nav>

    <!-- Fecha y hora -->
    <div class="date-time-bar">
        <div id="fecha-hora"></div>
    </div>

    <!-- Formulario desplegable -->
    <?php if (isset($_SESSION['user'])): ?>
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
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const burger = document.querySelector('.navbar-burger');
            const menu = document.querySelector('#navbar-menu');

            burger.addEventListener('click', () => {
                burger.classList.toggle('is-active');
                menu.classList.toggle('is-active');
            });
        });
    </script>
</body>
</html>
