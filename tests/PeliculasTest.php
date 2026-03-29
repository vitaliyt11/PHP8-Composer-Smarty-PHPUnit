<?php
require_once __DIR__ . '/../conf/db-config.php';

use PHPUnit\Framework\TestCase;
use VTV04\modulos\Peliculas;


class PeliculasTest extends TestCase
{

    public function testListarPeliculas()
    {
        $pdo = new PDO(
            DB_DSN,
            DB_USER,
            DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );

        $resultado = Peliculas::listar($pdo);
        $this->assertTrue(is_array($resultado) || $resultado instanceof \DWES04SOL\servicios\DBResult, "El resultado tiene que ser un array o una instancia de DBResult.");
    }

    public function testExistePeliculas()
    {
        $pdo = new PDO(
            DB_DSN,
            DB_USER,
            DB_PASSWORD,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );

        $resultado = Peliculas::existe($pdo, 2);
        if ($resultado === 1) {
            $this->assertEquals(1, $resultado, "Tiene que devolver 1 si existe la película en la DB.");
        } else {
            $this->assertTrue($resultado instanceof \DWES04SOL\servicios\DBResult, "Si existe algún error DBResult devuelta.");
        }
    }
}
