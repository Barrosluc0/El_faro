<?php
require_once __DIR__ . '/../config/database.php';

class User {
    public static function authenticate($email, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // <-- Aquí está el cambio

        if ($user && password_verify($password, $user['contrasena'])) {
            return $user;
        }
        return false;
    }

    public static function isAdmin($email) {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare("SELECT es_admin FROM usuarios WHERE correo = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return ($user && isset($user['es_admin']) && $user['es_admin'] == 1);
            
        } catch (PDOException $e) {
            error_log("Error en isAdmin(): " . $e->getMessage());
            return false;
        }
    }

    public static function register($name, $email, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $password]);
    }

    public static function find($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // <-- También aquí
    }
}
?>
