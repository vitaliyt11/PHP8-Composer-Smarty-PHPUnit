<?php
require_once __DIR__ . '/../conf/db-config.php';
use PHPUnit\Framework\TestCase;
use VTV04\modulos\Pelicula;


class PeliculaTest extends TestCase {

    public function testSetYGet() {
        //Preparamos datos de prueba
        $peliculaSet = new Pelicula();
        $tituloPrueba = "Prueba";
        $direccionPrueba = "Prueba";
        $generoPrueba = "1";
        $anioPrueba = "2026";
        $duracionPrueba = "123";
        $argumentoPrueba = "Prueba";
        
        //Ejecutamos los Setters
        $peliculaSet->setTitulo($tituloPrueba);
        $peliculaSet->setDireccion($direccionPrueba);
        $peliculaSet->setGenero($generoPrueba); 
        $peliculaSet->setAnio($anioPrueba);
        $peliculaSet->setDuracion($duracionPrueba);
        $peliculaSet->setArgumento($argumentoPrueba);

        //Comprobamos el resultado con los Getters
        //assertEquals comprueba que el primer parámetro sea igual al segundo
        $this->assertEquals($tituloPrueba, $peliculaSet->getTitulo(), "El título devuelto debería coincidir con el asignado.");
        $this->assertEquals($direccionPrueba, $peliculaSet->getDireccion(), "La dirección devuelta debería coincidir con la asignada.");
        $this->assertEquals($generoPrueba, $peliculaSet->getGenero(), "El género devuelto debería coincidir con el asignado.");
        $this->assertEquals($anioPrueba, $peliculaSet->getAnio(), "El año devuelto debería coincidir con el asignado.");
        $this->assertEquals($duracionPrueba, $peliculaSet->getDuracion(), "La duración devuelta debería coincidir con la asignada.");
        $this->assertEquals($argumentoPrueba, $peliculaSet->getArgumento(), "El argumento devuelto debería coincidir con el asignado.");
    }

    public function testGuardarRescatarBorrar() {
        $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        //Preparamos datos de prueba
        $pelicula = new Pelicula();
        $tituloPrueba = "Prueba";
        $direccionPrueba = "Prueba";
        $generoPrueba = "1";
        $anioPrueba = "2026";
        $duracionPrueba = "123";
        $argumentoPrueba = "Prueba";
        //Ejecutamos los Setters
        $pelicula->setTitulo($tituloPrueba);
        $pelicula->setDireccion($direccionPrueba);
        $pelicula->setGenero($generoPrueba); 
        $pelicula->setAnio($anioPrueba);
        $pelicula->setDuracion($duracionPrueba);
        $pelicula->setArgumento($argumentoPrueba);
        //Guardamos la película en la base de datos
        $resultadoGuardar = $pelicula->guardar($pdo);
        //Comprobamos que se ha guardado correctamente (debería devolver true)
        $this->assertEquals(1, $resultadoGuardar, "El método debería devolver 1 si se ha guardado correctamente.");
        //Probamos rescatar una película que sabemos que existe con id=5
        $peliculaRescatar = Pelicula::rescatar($pdo, $pelicula->getId());    
        //Comprobamos que devuelve un objeto Pelicula con el mismo ID
        $this->assertEquals($pelicula->getId(), $peliculaRescatar->getId(), "El ID de la película rescatada debería ser 5.");
        //Probamos borrar una película que sabemos que existe con id=5
        $resultadoBorrar = Pelicula::borrar($pdo, $pelicula->getId());    
        //Comprobamos que devuelve true al borrar correctamente
        $this->assertEquals(1, $resultadoBorrar, "El método debería devolver 1.");
    }

}