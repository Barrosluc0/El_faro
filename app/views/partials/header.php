<?php
// Inicia sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Incluye el modelo de usuario para funcionalidades relacionadas
require_once __DIR__ . '/../../models/User.php';  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Faro</title>

    <!-- Estilos Bulma y Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./styles.css">

    <!-- Estilos personalizados para navbar -->
    <style>
        nav.navbar.is-primary,
        .navbar-menu {
            background-color:#2a3f54 !important; /* color de fondo azul oscuro */
        }
        .navbar-item,
        .navbar-burger {
            color: white !important; /* texto blanco */
        }
        .navbar-burger span {
            background-color: white !important; /* líneas blancas en hamburguesa */
        }
        .navbar-item:hover {
            background-color:#2a3f54 !important; /* fondo al pasar el mouse */
            color: white !important;
        }
    </style>
</head>
<body>

    <!-- Barra de aviso importante -->
    <div class="notification-bar">
        <strong><i class="fas fa-bolt"></i> ÚLTIMA HORA:</strong> Tormentas eléctricas afectarán la Región Metropolitana hoy por la tarde.
    </div>

    <!-- Header con logo, título y botón modo noche -->
    <div class="header-logo">
        <div class="logo-container">
            <img src="./img/faro.png" alt="Logo El Faro">
            <div class="header-title">
                <span>EL</span>
                <span>FARO</span>
            </div>
        </div>
        <button id="dark-mode-toggle" class="button is-dark is-medium" title="Activar Modo Noche">
            <span class="icon">
                <i id="dark-mode-icon" class="fas fa-moon"></i>
            </span>
        </button>
    </div>

    <!-- Navegación principal responsive -->
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
                <!-- Enlaces principales -->
                <a class="navbar-item has-text-white" href=".?page=home">Inicio</a>
                <a class="navbar-item has-text-white" href=".?page=deportes">Deportes</a>
                <a class="navbar-item has-text-white" href=".?page=negocios">Negocios</a>
                <a class="navbar-item has-text-white" href=".?page=contacto">Contacto</a>
            </div>

            <div class="navbar-end">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Muestra nombre del usuario logueado -->
                    <span class="navbar-item has-text-white"><?= htmlspecialchars($_SESSION['user']['nombre']) ?></span>
                    
                    <?php if (User::isAdmin($_SESSION['user']['correo'])): ?>
                        <!-- Enlace para admin a mensajes -->
                        <a class="navbar-item has-text-white" href="./?page=admin/contactos">
                            <span class="icon"><i class="fas fa-envelope"></i></span>
                            <span>Mensajes</span>
                        </a>
                    <?php endif; ?>

                    <!-- Cerrar sesión y botón para agregar noticia -->
                    <a class="navbar-item has-text-white" href="./?page=logout">Cerrar sesión</a>
                    <button id="toggle-form" class="button is-primary is-small mr-3 navbar-item">Nueva Noticia</button>
                <?php else: ?>
                    <!-- Enlaces para usuarios no logueados -->
                    <a class="navbar-item has-text-white" href=".?page=registro">Registrarse</a>
                    <a class="navbar-item has-text-white" href=".?page=login">Iniciar sesión</a>
                <?php endif; ?>

                <!-- Contador de artículos (fijo por ahora) -->
                <span id="contador-articulos" class="navbar-item has-text-white">Contador de artículos: 9</span>
            </div>
        </div>
    </nav>

    <!-- Barra con fecha y hora -->
    <div class="date-time-bar">
        <div id="fecha-hora"></div>
    </div>

    <!-- Formulario oculto para agregar nueva noticia -->
    <?php if (isset($_SESSION['user'])): ?>
    <div id="form-agregar" class="box is-hidden">
        <h2 class="subtitle">Agregar Noticia</h2>
        <div class="field"><input class="input" type="text" id="titulo-articulo" placeholder="Título"></div>
        <div class="field"><input class="input" type="text" id="categoria-articulo" placeholder="Categoría"></div>
        <div class="field"><input class="input" type="text" id="imagen-articulo" placeholder="URL de la imagen"></div>
        <div class="field"><textarea class="textarea" id="contenido-articulo" placeholder="Contenido"></textarea></div>
        <button class="button is-primary" onclick="agregarArticulo()">Publicar</button>
    </div>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Activar/desactivar menú hamburguesa en vista móvil
            const burger = document.querySelector('.navbar-burger');
            const menu = document.querySelector('#navbar-menu');
            burger.addEventListener('click', () => {
                burger.classList.toggle('is-active');
                menu.classList.toggle('is-active');
            });

            // Mostrar/ocultar formulario "Nueva Noticia"
            const toggleForm = document.getElementById("toggle-form");
            if (toggleForm) {
                toggleForm.addEventListener("click", () => {
                    const form = document.getElementById("form-agregar");
                    form.classList.toggle("is-hidden");
                    if (!form.classList.contains('is-hidden')) {
                        document.getElementById("titulo-articulo").focus();
                    }
                });
            }
        });
    </script>

    <!-- Script principal con funcionalidades extras -->
    <script src="./script.js"></script>
</body>
</html>
