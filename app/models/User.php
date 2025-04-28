<?php
class User {
    public static function register($name, $email, $password) {
        $_SESSION['users'][] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        return true;
    }

    public static function find($email) {
        foreach ($_SESSION['users'] ?? [] as $user) {
            if ($user['email'] === $email) return $user;
        }
        return null;
    }
}
?>