<?php
/**
 * Clase abstracta EntidadIdentificableVTV.
 * Proporciona la estructura básica para las entidades con un identificador.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

namespace VTV04\modulos;

/**
 * Clase abstracta EntidadIdentificableVTV.
 * Sirve como clase base para todas las entidades del modelo que requieren un identificador único (ID).
 */
abstract class EntidadIdentificableVTV {
    /**
     * Identificador único de la entidad.
     * @var int|null
     */
    protected ?int $id=null;

    /**
     * Obtiene el identificador de la entidad.
     * 
     * @return int|null El ID de la entidad o null si no ha sido asignado.
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Establece el identificador de la entidad.
     * 
     * @param int $id El nuevo identificador a asignar.
     */
    protected function setId($id){        
        $this->id = $id;
    }
   
}