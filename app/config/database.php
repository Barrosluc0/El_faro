<?php
/**
 * Clase Database - Maneja una única conexión PDO (Singleton) y consultas seguras.
 */
class Database {
    private static $instance = null;   // Instancia única de Database
    private $pdo;                      // Objeto PDO para la conexión

    private function __construct() {
        try {
            // Configuración de conexión
            $host = 'localhost';
            $dbname = 'el_faro';
            $username = 'root';
            $password = '';
            $charset = 'utf8mb4';

            // Crear el objeto PDO con opciones de seguridad
            $this->pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=$charset",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,       // Lanza excepciones en errores
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Devuelve resultados como arreglos asociativos
                    PDO::ATTR_EMULATE_PREPARES => false                // Desactiva emulación de prepares para mayor seguridad
                ]
            );
        } catch (PDOException $e) {
            // Registrar error y lanzar excepción genérica para no exponer detalles
            error_log("[".date('Y-m-d H:i:s')."] Error de conexión: " . $e->getMessage() . "\n", 3, __DIR__ . '/../../logs/db_errors.log');
            throw new Exception("Error al conectar con la base de datos");
        }
    }

    /**
     * Devuelve la instancia PDO única (crear si no existe).
     * @return PDO
     */
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }

    /**
     * Ejecuta una consulta preparada con parámetros.
     * @param string $sql    Consulta SQL con marcadores
     * @param array  $params Valores a vincular en la consulta
     * @return PDOStatement
     * @throws Exception si falla la ejecución
     */
    public static function executeQuery($sql, $params = []) {
        try {
            $stmt = self::getInstance()->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            // Registrar y lanzar excepción genérica
            error_log("[".date('Y-m-d H:i:s')."] Error en query: $sql - " . $e->getMessage() . "\n", 3, __DIR__ . '/../../logs/query_errors.log');
            throw new Exception("Error en operación de base de datos");
        }
    }
}
