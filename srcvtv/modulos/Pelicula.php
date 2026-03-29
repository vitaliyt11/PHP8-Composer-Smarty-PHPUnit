<?php
/**
 * Clase Pelicula.
 * Representa la entidad de una película.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

namespace VTV04\modulos;

use \PDO;
use \PDOException;
use \DWES04SOL\servicios\DBResult;

/**
 * Clase Pelicula.
 * Extiende la funcionalidad básica de EntidadIdentificableVTV e implementa IGuardableVTV para representar una película y gestionarla.
 */
class Pelicula extends EntidadIdentificableVTV implements IGuardableVTV {
    
    /**
     * Título de la película.
     * @var string|null
     */
    private $titulo = null;
    
    /**
     * Año de estreno de la película.
     * @var int|null
     */
    private $anio = null;
    
    /**
     * ID del género al que pertenece la película.
     * @var int|null
     */
    private $genero = null;
    
    /**
     * Dirección de la película.
     * @var string|null
     */
    private $direccion = null;
    
    /**
     * Duración de la película en minutos.
     * @var int|null
     */
    private $duracion = null;
    
    /**
     * Argumento de la película.
     * @var string|null
     */
    private $argumento = null;

    /**
     * Obtiene el título de la película.
     * 
     * @return string|null El título de la película.
     */
    public function getTitulo(){
        return $this->titulo;
    }

    /**
     * Obtiene el año de la película.
     * 
     * @return int|null El año de la película.
     */
    public function getAnio(){
        return $this->anio;
    }

    /**
     * Obtiene el ID del género de la película.
     * 
     * @return int|null El ID del género.
     */
    public function getGenero(){
        return $this->genero;
    }

    /**
     * Obtiene la dirección de la película.
     * 
     * @return string|null La dirección de la película.
     */
    public function getDireccion(){
        return $this->direccion;
    }

    /**
     * Obtiene la duración de la película.
     * 
     * @return int|null La duración en minutos.
     */
    public function getDuracion(){
        return $this->duracion;
    }

    /**
     * Obtiene el argumento de la película.
     * 
     * @return string|null El argumento de la película.
     */
    public function getArgumento(){
        return $this->argumento;
    }

    /**
     * Establece el título de la película.
     * 
     * @param string $titulo El nuevo título a asignar.
     */
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    /**
     * Establece el año de la película.
     * 
     * @param int $anio El nuevo año a asignar.
     */
    public function setAnio($anio){
        $this->anio = $anio;
    }

    /**
     * Establece el género de la película.
     * 
     * @param int $genero El nuevo ID del género a asignar.
     */
    public function setGenero($genero){
        $this->genero = $genero;
    }

    /**
     * Establece la dirección de la película.
     * 
     * @param string $direccion Asigna la dirección.
     */
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    /**
     * Establece la duración de la película.
     * 
     * @param int $duracion La nueva duración en minutos a asignar.
     */
    public function setDuracion($duracion){
        $this->duracion = $duracion;
    }

    /**
     * Establece el argumento de la película.
     * 
     * @param string $argumento El nuevo argumento a asignar.
     */
    public function setArgumento($argumento){
        $this->argumento = $argumento;
    }

    /**
     * Método para guardar la película en la base de datos.
     * Realiza un INSERT si la película no tiene ID (es nueva), o un UPDATE si ya lo tiene.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @return DBResult|int Número de filas afectadas o enumeración DBResult en caso de error.
     */
    public function guardar(PDO $pdo): DBResult | int {
        //Variable auxiliar
        $resultado = 0;
        $resultadoSQL = false;
        //Comprobamos si existe la película mediante su ID
        if ($this->id === null) {
            // INSERT: nueva película
            $sql = "INSERT INTO peliculas (titulo, genero, direccion, duracion, argumento, anio) 
                    VALUES (:titulo, :genero, :direccion, :duracion, :argumento, :anio)";
        } else {
            // UPDATE: película existente
            $sql = "UPDATE peliculas SET titulo=:titulo, genero=:genero, direccion=:direccion, 
                    duracion=:duracion, argumento=:argumento, anio=:anio WHERE id=:id";
        }
        
        try {
            //Preparamos el SQL y vinculamos los parámetros
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':titulo', $this->titulo);
            $stmt->bindValue(':genero', $this->genero);
            $stmt->bindValue(':direccion', $this->direccion);
            $stmt->bindValue(':duracion', $this->duracion);
            $stmt->bindValue(':argumento', $this->argumento);
            $stmt->bindValue(':anio', $this->anio);
            //Si existe el ID lo vinculamos para el UPDATE
            if ($this->id !== null) {
                $stmt->bindValue(':id', $this->id);
            }
            //Ejecutamos el SQL
            if ($stmt->execute()) {
                if ($this->id === null) {
                    // Para INSERT, obtener el ID autogenerado
                    $this->setId($pdo->lastInsertId());
                }
                $resultadoSQL = $stmt->rowCount();
            } 
        //En caso de error fatal al trabajar con la base de datos lo capturamos 
        } catch (PDOException $ex) {
            $resultadoSQL = DBResult::VTV_DB_EXCEPTION;
        }
        //Comprobamos el resultado de la consulta para asignar la salida adecuada
        if ($resultadoSQL === false) {
            $resultado = DBResult::VTV_DB_OPNOTFULFILLED; // Falló la ejecución pero no dio excepción
        } elseif (empty($resultadoSQL)) {
            $resultado = DBResult::VTV_DB_EMPTYRESULT; // La consulta fue un éxito, pero no devolvió filas (no existe película)
        } elseif ($resultadoSQL === DBResult::VTV_DB_EXCEPTION) {
            //Devolvemos el error de DBResult
            $resultado = $resultadoSQL;
        } else {
            //Devolvemos la instancia de la clase Pelicula con los datos extraidos de la BD
            $resultado = $resultadoSQL;
        }
        return $resultado;
    }

    /**
     * Método para rescatar la información de una película de la base de datos mediante su ID.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param int $id Identificador de la película a rescatar.
     * @return DBResult|EntidadIdentificableVTV El objeto Pelicula instanciado o enumeración DBResult en caso de error/vacío.
     */
    public static function rescatar(PDO $pdo, int $id): DBResult | EntidadIdentificableVTV {
        //Definimos el SQL
        $sql = "SELECT * FROM peliculas WHERE id=:id";
        //Variables auxiliares
        $resultadoSQL = false;
        $resultado = [];
        //Ejecutamos el SQL
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('id',$id);
            if ($stmt->execute()) {
                if (preg_match('/^\s*SELECT\s/i', $sql)){
                    //Guardamos la información extraida con el select en la clase Pelicula 
                    $resultadoSQL = $stmt->fetchAll(PDO::FETCH_CLASS, 'VTV04\\modulos\\Pelicula');
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
            $resultado = DBResult::VTV_DB_EMPTYRESULT; // La consulta fue un éxito, pero no devolvió filas (no existe película)
        } elseif ($resultadoSQL === DBResult::VTV_DB_EXCEPTION) {
            //Devolvemos el error de DBResult
            $resultado = $resultadoSQL;
        } else {
            //Devolvemos la instancia de la clase Pelicula con los datos extraidos de la BD
            $resultado = $resultadoSQL[0];
        }
        return $resultado;
    }

    /**
     * Método para borrar una película de la base de datos mediante su ID.
     * 
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param int $id Identificador de la película a borrar.
     * @return DBResult|int Número de filas afectadas por el borrado o enumeración DBResult en caso de error.
     */
    public static function borrar(PDO $pdo, int $id): DBResult | int {
        //Definimos el SQL
        $sql = "DELETE FROM peliculas WHERE id=:id";
        //Variables auxiliares
        $resultadoSQL = false;
        $resultado = [];
        //Ejecutamos el SQL
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('id',$id);
            if ($stmt->execute()) {
                    //Contamos las filas afectadas por el DELETE
                    $resultadoSQL = $stmt->rowCount();
                }
        //En caso de error fatal al trabajar con la base de datos lo capturamos 
        } catch (PDOException $ex) {
            $resultadoSQL = DBResult::VTV_DB_EXCEPTION;
        }
        //Comprobamos el resultado de la consulta para asignar la salida adecuada
        if ($resultadoSQL === false) {
            $resultado = DBResult::VTV_DB_OPNOTFULFILLED; // Falló la ejecución pero no dio excepción
        } elseif (empty($resultadoSQL)) {
            $resultado = DBResult::VTV_DB_EMPTYRESULT; // La consulta fue un éxito, pero no devolvió filas (no existe película)
        } elseif ($resultadoSQL === DBResult::VTV_DB_EXCEPTION) {
            //Devolvemos el error de DBResult
            $resultado = $resultadoSQL;
        } else {
            $resultado = $resultadoSQL;
        }
        return $resultado;
    }

}

   
