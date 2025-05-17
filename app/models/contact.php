<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Clase Contact - Maneja operaciones con mensajes de contacto
 */
class Contact {
    /**
     * Obtiene todos los mensajes (para admin)
     * @return array Mensajes ordenados por fecha
     */
    public static function getAllMessages() {
        try {
            // Usando procedimiento almacenado
            $stmt = Database::executeQuery("CALL sp_get_all_contact_messages()");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Fallback a consulta directa
            error_log("Error obteniendo mensajes: ".$e->getMessage());
            $stmt = Database::executeQuery(
                "SELECT * FROM contactos ORDER BY fecha_envio DESC"
            );
            return $stmt->fetchAll();
        }
    }

    /**
     * Guarda un nuevo mensaje de contacto
     * @param string $name Nombre del remitente
     * @param string $email Correo electrónico
     * @param string $message Mensaje
     * @return bool Resultado de la operación
     */
    public static function save($name, $email, $message) {
        try {
            // Validación básica
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException("Email inválido");
            }

            $stmt = Database::executeQuery(
                "CALL sp_insert_contact_message(?, ?, ?)",
                [
                    htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                    $email,
                    htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
                ]
            );
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Error guardando mensaje: ".$e->getMessage());
            return false;
        }
    }
}