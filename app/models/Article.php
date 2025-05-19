<?php
require_once __DIR__ . '/../config/database.php';

class Article {
    /**
     * Obtiene las 3 últimas noticias generales (Nacional, Ciencia, Espectáculos).
     * @return array Arreglo de noticias
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
            WHERE a.categoria_id IN (1, 2, 3)
            ORDER BY a.fecha_creacion DESC
            LIMIT 3
        ";
        $stmt = Database::executeQuery($sql);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene noticias deportivas (Fútbol, Tenis, Fútbol Femenino).
     * @return array Arreglo de noticias
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
            WHERE a.categoria_id IN (4, 5, 6)
            ORDER BY a.fecha_creacion DESC
        ";
        $stmt = Database::executeQuery($sql);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene noticias de negocios (Mercados, Comercio, Minería).
     * @return array Arreglo de noticias
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
            WHERE a.categoria_id IN (7, 8, 9)
            ORDER BY a.fecha_creacion DESC
        ";
        $stmt = Database::executeQuery($sql);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene noticias de negocios usando parámetros vinculados (más seguro).
     * @return array Arreglo de noticias
     */
    public static function getBusinessNewsSecure() {
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
            WHERE a.categoria_id IN (?, ?, ?)
            ORDER BY a.fecha_creacion DESC
        ";
        // Vincula las categorías 7, 8 y 9
        $stmt = Database::executeQuery($sql, [7, 8, 9]);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene noticias de negocios mediante un procedimiento almacenado.
     * @return array Arreglo de noticias
     */
    public static function getBusinessNewsSP() {
        $stmt = Database::executeQuery("CALL sp_get_business_news()");
        return $stmt->fetchAll();
    }
}
