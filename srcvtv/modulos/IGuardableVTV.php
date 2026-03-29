<?php
/**
 * Interfaz IGuardableVTV.
 * Define los métodos obligatorios para las clases que interactúan con la base de datos.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

namespace VTV04\modulos;

use \DWES04SOL\servicios\DBResult;
use \VTV04\modulos\EntidadIdentificableVTV;
use \PDO;

interface IGuardableVTV {
    /**
     * Método para guardar la información del objeto en la base de datos.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @return DBResult|int Número de filas afectadas por la operación o DBResult en caso de error.
     */
    public function guardar(PDO $pdo): DBResult | int;

    /**
     * Método para rescatar la información de un registro de la base de datos.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param int $id Identificador del registro a rescatar.
     * @return DBResult|EntidadIdentificableVTV El objeto instanciado con los datos o DBResult en caso de error.
     */
    public static function rescatar(PDO $pdo, int $id): DBResult | EntidadIdentificableVTV; 

    /**
     * Método para borrar un registro de la base de datos.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param int $id Identificador del registro a borrar.
     * @return DBResult|int Número de filas afectadas por el borrado o DBResult en caso de error.
     */
    public static function borrar(PDO $pdo, int $id): DBResult | int;
};

?>