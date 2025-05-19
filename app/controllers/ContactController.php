<?php
require_once __DIR__ . '/../models/Contact.php';
require_once __DIR__ . '/../models/User.php'; // Para verificar si el usuario es admin

class ContactController {
    /**
     * Muestra todos los mensajes de contacto disponibles solo para administradores.
     */
    public static function listMessages() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/?page=login");
            exit;
        }

        // Verificar si el usuario autenticado es administrador
        if (!User::isAdmin($_SESSION['user']['correo'])) {
            header("Location: " . BASE_URL . "/?page=home&error=unauthorized");
            exit;
        }

        // Obtener todos los mensajes y cargar la vista correspondiente
        $messages = Contact::getAllMessages();
        include __DIR__ . '/../views/admin/contactos.php';
    }

    /**
     * Guarda un nuevo mensaje de contacto enviado desde el formulario público.
     */
    public static function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Llamar al modelo Contact para almacenar el mensaje
            Contact::save(
                $_POST['name'],
                $_POST['email'],
                $_POST['message']
            );
            // Redirigir indicando éxito en el envío
            header("Location: " . BASE_URL . "?contact_success=1");
        }
    }
}
?>
