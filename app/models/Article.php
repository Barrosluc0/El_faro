<?php
require_once __DIR__ . '/../config/database.php';

class Article {
    public static function getGeneralNews() {
        $db = Database::getConnection();
        $stmt = $db->query("
            SELECT 
                a.id,
                a.titulo AS title,
                a.contenido AS content,
                a.resumen AS excerpt,
                a.imagen AS image,
                c.nombre AS category
            FROM articulos a
            JOIN categorias c ON a.categoria_id = c.id
            WHERE a.categoria_id IN (1, 2, 3)  -- Nacional, Ciencia, Espectáculos
            ORDER BY a.fecha_creacion DESC
            LIMIT 3
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSportsNews() {
        $db = Database::getConnection();
        $stmt = $db->query("
            SELECT 
                a.id,
                a.titulo AS title,
                a.contenido AS content,
                a.resumen AS excerpt,
                a.imagen AS image,
                c.nombre AS category
            FROM articulos a
            JOIN categorias c ON a.categoria_id = c.id
            WHERE a.categoria_id IN (4, 5, 6)  -- Fútbol, Tenis, Fútbol Femenino
            ORDER BY a.fecha_creacion DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getBusinessNews() {
        $db = Database::getConnection();
        $stmt = $db->query("
            SELECT 
                a.id,
                a.titulo AS title,
                a.contenido AS content,
                a.resumen AS excerpt,
                a.imagen AS image,
                c.nombre AS category
            FROM articulos a
            JOIN categorias c ON a.categoria_id = c.id
            WHERE a.categoria_id IN (7, 8, 9)  -- Mercados, Comercio, Minería
            ORDER BY a.fecha_creacion DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>