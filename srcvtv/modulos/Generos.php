<?php
/**
 * Clase Generos.
 * Gestiona el listado y comprobación de existencia de los géneros en la base de datos.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

namespace VTV04\modulos;

use \PDO;
use \PDOException;
use \DWES04SOL\servicios\DBResult;

/**
 * Clase Generos.
 * Implementa la interfaz IListableVTV para gestionar el listado y comprobación de existencia de los géneros en la base de datos.
 */
class Generos implements IListableVTV {

    /**
     * Función para listar todos los géneros que existen en la base de datos.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @return DBResult|array Array de objetos Genero con los datos extraídos o enumeración DBResult en caso de error/vacío.
     */
    public static function listar(PDO $pdo): DBResult | array{
        $sql = "SELECT id, nombre FROM generos";
        $resultadoSQL = false;
        $resultado = [];
        
        try {
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute()) {
                if (preg_match('/^\s*SELECT\s/i', $sql)){
                    //Guardamos la información extraida con el select en la clase Género
                    $resultadoSQL = $stmt->fetchAll(PDO::FETCH_CLASS, 'VTV04\\modulos\\Genero');
                }
            }
        //En caso de error fatal al trabajar con la base de datos lo capturamos 
        } catch (PDOException $ex) {
            $resultadoSQL = DBResult::VTV_DB_EXCEPTION;
        }
        //Comprobamos el resultado de la consulta para asignar la salida adecuada
        if ($resultadoSQL === false) {
            $resultado = DBResult::VTV_DB_OPNOTFULFILLED; // Falló la ejecución pero no dio excepción
        } elseif (empty($resultadoSQL)) {
            $resultado = DBResult::VTV_DB_EMPTYRESULT; // La consulta fue un éxito, pero no devolvió filas (no existen géneros)
        } elseif ($resultadoSQL === DBResult::VTV_DB_EXCEPTION) {
            //Devolvemos el error de DBResult
            $resultado = $resultadoSQL;
        } else {
            //Devolvemos la instancia de la clase Género con los datos extraidos de la BD
            $resultado = $resultadoSQL;
        }        

        return $resultado;
    }

    /**
     * Función para comprobar si existe un género mediante su ID en la base de datos.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param int $id Identificador del género a comprobar.
     * @return DBResult|int Devuelve 1 si existe, 0 si no existe, o DBResult en caso de error.
     */
    public static function existe(PDO $pdo, int $id): DBResult | int{
        //Definimos el SQL para rescatar el ID        
        $sql = "SELECT nombre FROM generos WHERE id=:id";
        //Variables auxiliares
        $resultado = false;
        $resultadoSQL = false;

        try {
            //Preparamos el SQL
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('id',$id);
            if ($stmt->execute()) {
                if (preg_match('/^\s*SELECT\s/i', $sql)){
                    //Guardamos la información extraida con el select en un buckle bidimensional               
                    $resultadoSQL = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }
                }
            
        //En caso de error fatal al trabajar con la base de datos lo capturamos
        } catch (PDOException $ex) {
            $resultadoSQL = (DBResult::VTV_DB_EXCEPTION->value);
        }

        // Evaluamos el contenido del array devuelto por fetchAll
        if ($resultadoSQL === false) {
            $resultado = (DBResult::VTV_DB_OPNOTFULFILLED->value); // Falló la ejecución pero no dio excepción
        } elseif (empty($resultadoSQL)) {
            $resultado = 0; // La consulta fue un éxito, pero no devolvió filas (no existe género)
        } elseif($resultadoSQL === DBResult::VTV_DB_EXCEPTION) {
            //Devolvemos el error de DBResult
            $resultado = $resultadoSQL;
        } else {
            $resultado = 1; // Devuelve el 1 debido a que existe el género
        }
        return $resultado;
    }
}