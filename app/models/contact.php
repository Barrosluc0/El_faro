<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Clase Contact - Maneja operaciones relacionadas con mensajes de contacto.
 */
class Contact {
    /**
     * Retorna todos los mensajes de contacto (para la vista de administrador).
     * @return array Arreglo de mensajes
     */
    public static function getAllMessages() {
        try {
            // Intentar obtener mensajes vía procedimiento almacenado
            $stmt = Database::executeQuery("CALL sp_get_all_contact_messages()");
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Si falla el almacenado, hacer consulta directa como respaldo
            error_log("Error obteniendo mensajes: " . $e->getMessage());
            $stmt = Database::executeQuery(
                "SELECT * FROM contactos ORDER BY fecha_envio DESC"
            );
            return $stmt->fetchAll();
        }
    }

    /**
     * Guarda un nuevo mensaje de contacto en la base de datos.
     * @param string $name    Nombre del remitente
     * @param string $email   Correo electrónico del remitente
     * @param string $message Texto del mensaje
     * @return bool           Verdadero si se insertó correctamente
     */
    public static function save($name, $email, $message) {
        try {
            // Validar formato de correo
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException("Email inválido");
            }
            // Llamar al procedimiento almacenado con datos sanitizados
            $stmt = Database::executeQuery(
                "CALL sp_insert_contact_message(?, ?, ?)",
                [
                    htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                    $email,
                    htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
                ]
            );
            // Verificar que se haya afectado al menos una fila
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Error guardando mensaje: " . $e->getMessage());
            return false;
        }
    }
}
