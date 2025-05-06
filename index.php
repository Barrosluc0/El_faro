<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
define('BASE_URL', 'http://localhost/El_faro');

// Autocarga de modelos
spl_autoload_register(function($className) {
    $modelPath = "app/models/$className.php";
    if (file_exists($modelPath)) {
        require_once $modelPath;
    }
});

// Cargar controladores
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/ContactController.php';

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
    case 'registro':
        require 'app/views/auth/register.php';
        break;
    case 'login':
        require 'app/views/auth/login.php';
        break;
    case 'contacto':
        require 'app/views/contacto/formulario.php';
        break;

    // Procesar formularios
    case 'register_submit':
        AuthController::register();
        break;
    case 'login_submit':
        AuthController::login();
        break;
    case 'contact_submit':
        ContactController::submit();
        break;

    // Panel de administración (privado)
    case 'admin/contactos':
        ContactController::listMessages();
        break;

    case 'logout':
        AuthController::logout();
        break;
        
    default:
        header("HTTP/1.0 404 Not Found");
        echo "Página no encontrada";
        break;
}
