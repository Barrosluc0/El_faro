<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $conexion = new PDO(
        'mysql:host=localhost;dbname=el_faro',
        'root',
        ''  // Contraseña vacía
    );
    echo "¡Conexión exitosa!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}