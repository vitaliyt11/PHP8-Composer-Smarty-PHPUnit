<?php
require_once __DIR__ . '/../conf/db-config.php';
use PHPUnit\Framework\TestCase;
use VTV04\modulos\Genero;


class GeneroTest extends TestCase {

    public function testSetyGet(){
        $genero = new Genero();
        $nombrePrueba = "Prueba";
        $genero->setNombre($nombrePrueba);
        $this->assertEquals($nombrePrueba, $genero->getNombre(), "El nombre devuelto debería coincidir con el de prueba.");
    }

}