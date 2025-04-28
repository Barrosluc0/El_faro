<?php
session_start();
define('BASE_URL', 'http://localhost/El_faro');

// Autocarga de clases
spl_autoload_register(function($className) {
    require_once "app/models/$className.php";
});

// Manejo de rutas
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        require 'pages/index.php';
        break;
    case 'deportes':
        require 'pages/deportes.php';
        break;
    case 'negocios':
        require 'pages/negocios.php';
        break;
    case 'contacto':
        require 'app/views/contact.php';
        break;
    case 'registro':
        require 'app/views/auth/register.php';
        break;
    case 'login':
        require 'app/views/auth/login.php';
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada";
        break;
}
?>