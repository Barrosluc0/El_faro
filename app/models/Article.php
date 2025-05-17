<?php
require_once __DIR__ . '/../config/database.php';

class Article {
    // ===== MÉTODOS ORIGINALES (que ya funcionaban) =====
    
    /**
     * Obtiene noticias generales (Método original preservado)
     */
    public static function getGeneralNews() {
        $sql = "
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
        ";
        
        $stmt = Database::executeQuery($sql);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene noticias deportivas (Método original preservado)
     */
    public static function getSportsNews() {
        $sql = "
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
        ";
        
        $stmt = Database::executeQuery($sql);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene noticias de negocios (Método original preservado)
     */
    public static function getBusinessNews() {
        $sql = "
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
        ";
        
        $stmt = Database::executeQuery($sql);
        return $stmt->fetchAll();
    }

    // ===== MEJORAS ADICIONALES (Nuevos métodos) =====
    
    /**
     * Versión con parámetros bindeados (Nueva opción)
     */
    public static function getBusinessNewsSecure() {
        $sql = "
            SELECT 
                a.id,
                a.titulo AS title,
                [...]
            WHERE a.categoria_id IN (?, ?, ?)
        ";
        
        $stmt = Database::executeQuery($sql, [7, 8, 9]);
        return $stmt->fetchAll();
    }

    /**
     * Versión con procedimiento almacenado (Nueva opción)
     */
    public static function getBusinessNewsSP() {
        $stmt = Database::executeQuery("CALL sp_get_business_news()");
        return $stmt->fetchAll();
    }
}