<?php
/**
 * Interfaz IListableVTV.
 * Define los métodos obligatorios para las clases que permiten listar datos o comprobar existencias.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

namespace VTV04\modulos;

use \DWES04SOL\servicios\DBResult;
use \PDO;


interface IListableVTV {
    /**
     * Método para listar registros de la base de datos.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @return DBResult|array Array con los datos listados o enumeración DBResult en caso de error/vacío.
     */
    public static function listar(PDO $pdo): DBResult | array;

    /**
     * Método para comprobar si existe un registro por su ID en la base de datos.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param int $id Identificador del registro a comprobar.
     * @return DBResult|int Devuelve 1 si existe, 0 si no existe, o DBResult en caso de error.
     */
    public static function existe(PDO $pdo, int $id): DBResult | int;

};

?>