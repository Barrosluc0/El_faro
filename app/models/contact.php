<?php
require_once __DIR__ . '/../config/database.php';

class Contact {
    /* Obtiene todos los mensajes para el panel admin */
    public static function getAllMessages() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM contactos ORDER BY fecha_envio DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Guarda un nuevo mensaje */
    public static function save($name, $email, $message) {
        $db = Database::getConnection();
        $stmt = $db->prepare("
            INSERT INTO contactos (nombre, correo, mensaje)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$name, $email, $message]);
    }
}
?>