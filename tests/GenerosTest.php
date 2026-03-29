<?php
require_once __DIR__ . '/../conf/db-config.php';
use PHPUnit\Framework\TestCase;
use VTV04\modulos\Generos;


class GenerosTest extends TestCase {

    public function testListarGeneros() {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        $resultado = Generos::listar($pdo);
        $this->assertTrue(is_array($resultado) || $resultado instanceof \DWES04SOL\servicios\DBResult, "El resultado tiene que ser un array o una instancia de DBResult.");
    }

    public function testExisteGeneros() {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        $resultado = Generos::existe($pdo, 1);
        if ($resultado === 1) {
            $this->assertEquals(1, $resultado, "Tiene que devolver 1 si existe el género en la DB.");
        } else {
            $this->assertTrue($resultado instanceof \DWES04SOL\servicios\DBResult, "Si existe algún error DBResult devuelta.");
        }
    }

}