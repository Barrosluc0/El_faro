<?php
/**
 * Clase Database - Maneja conexiones PDO seguras usando Singleton
 */
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        try {
            // Configuración en variables separadas para mayor seguridad
            $host = 'localhost';
            $dbname = 'el_faro';
            $username = 'root';
            $password = '';
            $charset = 'utf8mb4';
            
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=$charset",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false // Usar prepares nativos
                ]
            );
        } catch (PDOException $e) {
            error_log("[".date('Y-m-d H:i:s')."] Error de conexión: ".$e->getMessage()."\n", 3, __DIR__.'/../../logs/db_errors.log');
            throw new Exception("Error al conectar con la base de datos");
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }

    /**
     * Ejecuta consultas preparadas de forma segura
     * @param string $sql Consulta SQL con placeholders
     * @param array $params Parámetros para binding
     * @return PDOStatement
     */
    public static function executeQuery($sql, $params = []) {
        try {
            $stmt = self::getInstance()->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("[".date('Y-m-d H:i:s')."] Error en query: $sql - ".$e->getMessage()."\n", 3, __DIR__.'/../../logs/query_errors.log');
            throw new Exception("Error en operación de base de datos");
        }
    }
}