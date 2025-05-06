<?php
require_once __DIR__ . '/../models/Contact.php';

class ContactController {
    /* Método para mostrar TODOS los mensajes (admin) */
    public static function listMessages() {
        // Verificar si está logueado (corrección aquí)
        if (!isset($_SESSION['user'])) { 
            header("Location: " . BASE_URL . "/?page=login");
            exit;
        }
    
        if (!User::isAdmin($_SESSION['user']['correo'])) {
            header("Location: " . BASE_URL . "/?page=home&error=unauthorized");
            exit;
        }
    
        $messages = Contact::getAllMessages();
        include __DIR__ . '/../views/admin/contactos.php';
    }    

    /* Método para guardar mensajes (formulario público) */
    public static function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Contact::save(
                $_POST['name'],
                $_POST['email'],
                $_POST['message']
            );
            header("Location: " . BASE_URL . "?contact_success=1");
        }
    }
    
}
?>