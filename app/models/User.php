<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Clase User - Maneja autenticación y operaciones de usuarios
 */
class User {
    /**
     * Autentica un usuario
     * @param string $email Correo electrónico
     * @param string $password Contraseña
     * @return array|false Datos del usuario o false si falla
     */
    public static function authenticate($email, $password) {
        try {
            $stmt = Database::executeQuery(
                "CALL sp_authenticate_user(?)",
                [$email]
            );
            $user = $stmt->fetch();
            
            return ($user && password_verify($password, $user['contrasena'])) 
                ? $user 
                : false;
        } catch (Exception $e) {
            error_log("Error en autenticación: ".$e->getMessage());
            return false;
        }
    }

    /**
     * Verifica si un usuario es administrador
     * @param string $email Correo electrónico
     * @return bool
     */
    public static function isAdmin($email) {
        try {
            $stmt = Database::executeQuery(
                "CALL sp_check_admin_status(?)",
                [$email]
            );
            $result = $stmt->fetch();
            return !empty($result) && $result['es_admin'] == 1;
        } catch (Exception $e) {
            error_log("Error verificando admin: ".$e->getMessage());
            return false;
        }
    }

    /**
     * Registra un nuevo usuario
     * @param string $name Nombre completo
     * @param string $email Correo electrónico
     * @param string $password Contraseña sin hash
     * @return bool Resultado de la operación
     */
    public static function register($name, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            return Database::executeQuery(
                "CALL sp_register_user(?, ?, ?)",
                [
                    htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                    $email,
                    $hashedPassword
                ]
            )->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Error en registro: ".$e->getMessage());
            return false;
        }
    }

    /**
     * Busca un usuario por email
     * @param string $email Correo electrónico
     * @return array|false Datos del usuario o false si no existe
     */
    public static function find($email) {
        try {
            $stmt = Database::executeQuery(
                "CALL sp_find_user_by_email(?)",
                [$email]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log("Error buscando usuario: ".$e->getMessage());
            return false;
        }
    }
}
