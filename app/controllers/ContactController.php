<?php
class ContactController {
    private static $messages = [];

    public static function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'message' => trim($_POST['message']),
                'date' => date('Y-m-d H:i:s')
            ];
            self::$messages[] = $message;
            header("Location: " . BASE_URL . "?page=home&contact_success=1");
        }
    }
}
?>