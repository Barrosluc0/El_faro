<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    /**
     * Registra un nuevo usuario cuando se envía el formulario POST.
     */
    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer y sanear datos del formulario
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

            try {
                // Intentar crear el usuario en la base de datos
                $success = User::register($name, $email, $password);

                if ($success) {
                    // Si se creó con éxito, buscar datos del usuario y abrir sesión
                    $user = User::find($email);
                    if ($user && isset($user['nombre'])) {
                        session_start();
                        $_SESSION['user'] = $user;
                        header("Location: " . BASE_URL . "/?page=home");
                        exit();
                    } else {
                        // Si los datos del usuario no son válidos, redirigir al login con error
                        header("Location: " . BASE_URL . "/?page=login&error=1");
                        exit();
                    }
                } else {
                    // Si falla el registro, redirigir a la página de registro con error
                    header("Location: " . BASE_URL . "/?page=register&error=1");
                    exit();
                }
            } catch (PDOException $e) {
                // En caso de excepción PDO, registrar y detener ejecución
                error_log("Error en registro: " . $e->getMessage());
                die("Error al registrar. Revisa los logs.");
            }
        }
    }

    /**
     * Autentica un usuario cuando se envía el formulario de login por POST.
     */
    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer y sanear credenciales
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Intentar autenticar con el modelo User
            $user = User::authenticate($email, $password);

            if ($user && isset($user['nombre'])) {
                // Si las credenciales son válidas, iniciar sesión y redirigir a home
                session_start();
                $_SESSION['user'] = $user;
                header("Location: " . BASE_URL . "/?page=home");
                exit();
            } else {
                // Si las credenciales fallan, redirigir a login con error
                header("Location: " . BASE_URL . "/?page=login&error=1");
                exit();
            }
        }
    }

    /**
     * Cierra la sesión del usuario actual y borra las cookies de sesión.
     */
    public static function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Vaciar arreglo de sesión
        $_SESSION = [];

        // Borrar cookie de sesión si existe
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destruir sesión y redirigir a home
        session_destroy();
        header("Location: ./?page=home");
        exit();
    }
}
