<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Clase User - Contiene métodos para autenticación y gestión de usuarios.
 */
class User {
    /**
     * Autentica a un usuario comparando contraseña con hash guardado.
     * @param string $email    Correo electrónico
     * @param string $password Contraseña en texto plano
     * @return array|false     Datos del usuario o false si no coincide
     */
    public static function authenticate($email, $password) {
        try {
            // Llamar al procedimiento que devuelve datos del usuario por email
            $stmt = Database::executeQuery(
                "CALL sp_authenticate_user(?)",
                [$email]
            );
            $user = $stmt->fetch();

            // Verificar que exista el usuario y que la contraseña concuerde
            return ($user && password_verify($password, $user['contrasena']))
                ? $user
                : false;
        } catch (Exception $e) {
            error_log("Error en autenticación: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Verifica si el usuario con el correo indicado es administrador.
     * @param string $email Correo electrónico
     * @return bool         Verdadero si es admin, falso en otro caso
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
            error_log("Error verificando admin: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Registra un nuevo usuario con nombre, correo y contraseña hasheada.
     * @param string $name     Nombre completo
     * @param string $email    Correo electrónico
     * @param string $password Contraseña ya hasheada
     * @return bool            Verdadero si se insertó correctamente
     */
    public static function register($name, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            // Llamar al procedimiento para insertar usuario
            return Database::executeQuery(
                "CALL sp_register_user(?, ?, ?)",
                [
                    htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                    $email,
                    $hashedPassword
                ]
            )->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Error en registro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Busca un usuario por su correo electrónico.
     * @param string $email Correo electrónico
     * @return array|false  Datos del usuario o false si no existe
     */
    public static function find($email) {
        try {
            $stmt = Database::executeQuery(
                "CALL sp_find_user_by_email(?)",
                [$email]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log("Error buscando usuario: " . $e->getMessage());
            return false;
        }
    }
}

