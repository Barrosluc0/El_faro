<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("Datos de registro: " . print_r($_POST, true));

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

            error_log("Intentando registrar usuario: $email");

            try {
                $success = User::register($name, $email, $password);

                if ($success) {
                    error_log("Usuario registrado exitosamente");
                    $user = User::find($email);

                    if ($user && is_array($user) && isset($user['nombre'])) {
                        session_start();
                        $_SESSION['user'] = $user;
                        header("Location: " . BASE_URL . "/?page=home");
                        exit();
                    } else {
                        error_log("Error: el usuario no tiene datos válidos");
                        header("Location: " . BASE_URL . "/?page=login&error=1");
                        exit();
                    }
                } else {
                    error_log("Error al registrar usuario");
                    header("Location: " . BASE_URL . "/?page=register&error=1");
                    exit();
                }
            } catch (PDOException $e) {
                error_log("Error en registro: " . $e->getMessage());
                die("Error al registrar. Revisa los logs.");
            }
        }
    }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log("Datos de login: " . print_r($_POST, true));

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $user = User::authenticate($email, $password);

            if ($user && is_array($user) && isset($user['nombre'])) {
                error_log("Autenticación exitosa para: $email");
                session_start();
                $_SESSION['user'] = $user;
                header("Location: " . BASE_URL . "/?page=home");
                exit();
            } else {
                error_log("Error en credenciales para: $email");
                header("Location: " . BASE_URL . "/?page=login&error=1");
                exit();
            }
        }
    }

    public static function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    header("Location: ./?page=home");
    exit();
}
    
}
