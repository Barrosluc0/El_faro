<?php
class AuthController {
    private static $users = [];

    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];
            self::$users[] = $user;
            $_SESSION['user'] = $user;
            header("Location: " . BASE_URL . "?page=home");
        }
    }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            foreach (self::$users as $user) {
                if ($user['email'] === $email) {
                    $_SESSION['user'] = $user;
                    header("Location: " . BASE_URL . "?page=home");
                    return;
                }
            }
            echo "Credenciales incorrectas";
        }
    }
}
?>