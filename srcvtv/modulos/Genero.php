<?php
/**
 * Clase Genero.
 * Representa la entidad de un género cinematográfico.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

namespace VTV04\modulos;

/**
 * Clase Genero.
 * Extiende la funcionalidad básica de EntidadIdentificableVTV para representar un género.
 */
class Genero extends EntidadIdentificableVTV {
    /**
     * Nombre del género cinematográfico.
     * @var string
     */
    private $nombre;

    /**
     * Obtiene el nombre del género.
     * 
     * @return string El nombre del género.
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Establece el nombre del género.
     * 
     * @param string $nombre El nuevo nombre a asignar al género.
     */
    public function setNombre($nombre){        
        $this->nombre = $nombre;
    }
   
}