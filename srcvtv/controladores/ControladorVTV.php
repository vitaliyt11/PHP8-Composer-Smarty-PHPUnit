<?php
/**
 * Controlador principal de la aplicación.
 * Gestiona el flujo de las vistas y la interacción con los modelos de datos.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

namespace Controladores;


use Smarty;
use Exception;
use \PDO;
use \VTV04\modulos;
use \DWES04SOL\servicios\DBResult;
use \Peticion\Peticion;


/**
 * Clase ControladorVTV.
 * Contiene los métodos estáticos que actúan como controladores para las distintas acciones de la aplicación.
 */
class ControladorVTV
{
    /**
     * Controlador por defecto para listar las películas.
     * Permite ordenar la lista basándose en criterios recibidos por POST o guardados en la sesión.
     * 
     * @param Peticion $p Objeto Peticion para capturar parámetros de la solicitud.
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param Smarty $smarty Objeto Smarty para la gestión y renderizado de plantillas.
     */
    public static function controladorDefecto($p, $pdo, $smarty)
    {
        //Definimos criterios validos para ordenar la lista de películas
        $criteriosValidos = ['titulo', 'anio', 'duracion'];
        $ordenValido = ['ascendente', 'descendente'];
        //Variables auxiliares
        $criterio = null;
        $orden = null;
        $mensajeError = null;

        //Se reciben datos vía POST
        if ($p->isPost()) {
            //Utilizamos la clase Peticion para comprobar si existen ambos parámetros
            if ($p->has('criterio', 'orden')) {
                $criterioPost = $p->getString('criterio');
                $ordenPost = $p->getString('orden');

                //Comprobamos que el orden recibido sea válido
                if (in_array($criterioPost, $criteriosValidos) && in_array($ordenPost, $ordenValido)) {
                    $criterio = $criterioPost;
                    $orden = $ordenPost;
                    //Guardamos en sesión la última búsqueda válida
                    $_SESSION['criterio_orden'] = $criterio;
                    $_SESSION['sentido_orden'] = $orden;
                }
            }
        } else {
            //En caso de no existir Post buscamos orden en sesión
            if (isset($_SESSION['criterio_orden']) && isset($_SESSION['sentido_orden'])) {
                $criterio = $_SESSION['criterio_orden'];
                $orden = $_SESSION['sentido_orden'];
            }
        }

        //Listamos los datos de las películas de la base de datos
        $resultadoPeliculas = \VTV04\modulos\Peliculas::listar($pdo);

        //Listamos los géneros para listar su ID con su respectivo nombre
        $resultadoGeneros = \VTV04\modulos\Generos::listar($pdo);
        $listaGeneros = [];
        if (is_array($resultadoGeneros)) {
            foreach ($resultadoGeneros as $genero) {
                $listaGeneros[$genero->getId()] = $genero->getNombre();
            }
        }
        $smarty->assign('generos', $listaGeneros);

        if ($resultadoPeliculas instanceof \DWES04SOL\servicios\DBResult) {
            //Si la consulta devuelve un error DBResult dejamos vacía la lista de películas
            $smarty->assign('peliculas', []);
        } else {
            //Si hay criterio y orden válido, ordenamos el array de objetos con usort
            if ($criterio && $orden) {
                usort($resultadoPeliculas, function ($a, $b) use ($criterio, $orden) {
                    $valA = $criterio === 'titulo' ? strtolower($a->getTitulo()) : ($criterio === 'anio' ? $a->getAnio() : $a->getDuracion());
                    $valB = $criterio === 'titulo' ? strtolower($b->getTitulo()) : ($criterio === 'anio' ? $b->getAnio() : $b->getDuracion());

                    if ($valA == $valB) return 0;
                    $comparacion = ($valA < $valB) ? -1 : 1;

                    return ($orden === 'ascendente') ? $comparacion : -$comparacion;
                });
            }
            //Asignamos lista de películas mediante Smarty para mostrarla en la plantilla
            $smarty->assign('peliculas', $resultadoPeliculas);
        }
        //Mostramos la plantilla en pantalla
        $smarty->display('lista_peliculas.tpl.html');
    }

    /**
     * Controlador para ir al formulario de añadir una nueva película.
     * Carga los géneros disponibles para mostrarlos en el formulario.
     * 
     * @param Peticion $p Objeto Peticion para capturar parámetros de la solicitud.
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param Smarty $smarty Objeto Smarty para la gestión de plantillas.
     */
    public static function controladorAñadirPelicula($p, $pdo, $smarty)
    {
        //Listamos los géneros para listar su ID con su respectivo nombre
        $resultadoGeneros = \VTV04\modulos\Generos::listar($pdo);
        $listaGeneros = [];
        if (is_array($resultadoGeneros)) {
            foreach ($resultadoGeneros as $genero) {
                $listaGeneros[$genero->getId()] = $genero->getNombre();
            }
        }
        $smarty->assign('generos', $listaGeneros);

        //Mostramos la plantilla en pantalla
        $smarty->display('nueva_pelicula_form_VTV.tpl.html');
    }

    /**
     * Controlador para validar datos del formulario y guardar la película en la base de datos.
     * 
     * @param Peticion $p Objeto Peticion con los datos del formulario (POST).
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param Smarty $smarty Objeto Smarty para mostrar los mensajes de éxito o error.
     */
    public static function controladorGuardarPelicula($p, $pdo, $smarty)
    {
        //Se reciben datos vía POST
        if ($p->isPost()) {
            //Variables auxiliares
            $erroresFormulario = [];
            //Hacemos lista de ID existentes de género para validar género del formulario
            $resultadoGeneros = \VTV04\modulos\Generos::listar($pdo);
            foreach ($resultadoGeneros as $genero) {
                $generosValidos[] = $genero->getId();
            }
            //Validamos cada campo del formulario utilizando la clase Peticion
            try {
                $titulo = $p->getString('titulo');
                if (empty($titulo)) {
                    $erroresFormulario[] = "El título es obligatorio y no puede estar vacío.";
                } elseif (strlen($titulo) > 60) {
                    $erroresFormulario[] = "El título no puede tener más de 60 caracteres.";
                }
            } catch (Exception $e) {
                $erroresFormulario[] = "El título es obligatorio y debe ser una cadena de texto.";
            }
            try {
                $anio = $p->getInt('anio');
                if ($anio < 1965 || $anio > date("Y")) {
                    $erroresFormulario[] = "El año tiene que estar comprendido entre 1965 y el año actual.";
                }
            } catch (Exception $e) {
                $erroresFormulario[] = "El año es obligatorio y debe ser un número entero.";
            }
            try {
                $duracion = $p->getInt('duracion');
                if ($duracion <= 0 || $duracion > 500) {
                    $erroresFormulario[] = "La duración tiene que ser mayor de 0 y menor o igual a 500.";
                }
            } catch (Exception $e) {
                $erroresFormulario[] = "La duración es obligatoria y debe ser un número entero.";
            }
            try {
                $genero = $p->getInt('genero');
                if (!in_array($genero, $generosValidos)) {
                    $erroresFormulario[] = "El género seleccionado no es válido.";
                }
            } catch (Exception $e) {
                $erroresFormulario[] = "El género es obligatorio y debe ser un número entero.";
            }
            try {
                $argumento = $p->getString('argumento');
                if (empty($argumento)) {
                    $erroresFormulario[] = "El argumento es obligatorio y no puede estar vacío.";
                }
            } catch (Exception $e) {
                $erroresFormulario[] = "El argumento es obligatorio y debe ser una cadena de texto.";
            }
            try {
                $direccion = $p->getString('direccion');
                if (empty($direccion)) {
                    $erroresFormulario[] = "La dirección es obligatoria y no puede estar vacía.";
                } elseif (strlen($direccion) > 100) {
                    $erroresFormulario[] = "La dirección no puede tener más de 100 caracteres.";
                }
            } catch (Exception $e) {
                $erroresFormulario[] = "La dirección es obligatoria y debe ser una cadena de texto.";
            }
            if (count($erroresFormulario) === 0) {
                //Si no existen errores guardamos la nueva película
                //Creamos un nuevo objeto película con los datos recibidos del formulario
                $pelicula = new \VTV04\modulos\Pelicula();
                $pelicula->setTitulo($titulo);
                $pelicula->setAnio($anio);
                $pelicula->setDuracion($duracion);
                $pelicula->setGenero($genero);
                $pelicula->setArgumento($argumento);
                $pelicula->setDireccion($direccion);
                //Ejecutamos función para guardar película en la base de datos
                $resultadoGuardar = $pelicula->guardar($pdo);
                //Comprobamos el resultado del guardado de la película
                if (!($resultadoGuardar instanceof DBResult)) {
                    $smarty->assign('mensajeExito', "La película '{$titulo}' se ha guardado con el ID:'{$pelicula->getId()}'.");
                } else {
                    $erroresFormulario[] = "Ocurrió un error al guardar en la base de datos.";
                    $smarty->assign('erroresFormulario', $erroresFormulario);
                }
            } else {
                //Si existe errores de validación de información los asignamos a Smarty para mostrarlos en la plantilla
                $smarty->assign('erroresFormulario', $erroresFormulario);
            }
        }
        //Mostramos la plantilla
        $smarty->display('nueva_pelicula_guardar_VTV.tpl.html');
    }

    /**
     * Controlador para mostrar un error cuando se intenta acceder por GET a una ruta que exige POST.
     * 
     * @param Smarty $smarty Objeto Smarty para mostrar el mensaje de error.
     */
    public static function controladorErrorFormaEnvioFormulario($smarty)
    {
        $mensajeError = "Error: Al procesar la petición vuelva a intentarlo de nuevo.";
        $smarty->assign('mensajeError', $mensajeError);
        $smarty->display('error_formulario_envio_VTV.tpl.html');
    }

    /**
     * Controlador para cargar la vista de confirmación para borrar una película.
     * 
     * @param Peticion $p Objeto Peticion para recuperar el ID de la película a borrar.
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param Smarty $smarty Objeto Smarty para renderizar la plantilla.
     */
    public static function borrar_pelicula_form_VTV($p, $pdo, $smarty)
    {
        //Variables auxiliares
        $mensajeError = null;
        $pelicula = null;
        //Se reciben datos vía POST
        if ($p->isPost()) {
            if ($p->has('id')) {
                try {
                    //Comprobamos que el ID es un INT
                    $id = $p->getInt('id');

                    //Ejecutamos función para rescatar la película en la base de datos
                    $resultadoRescatar = \VTV04\modulos\Pelicula::rescatar($pdo, $id);
                    //Comprobamos el resultado de rescatar de la película
                    if (!($resultadoRescatar instanceof DBResult)) {
                        //Instanciamos la película con el ID para borrar
                        $pelicula = $resultadoRescatar;
                    } else {
                        $mensajeError = "Ocurrió un error al rescatar la película de la base de datos.";
                    }
                } catch (Exception $e) {
                    $mensajeError = "Error al intentar borrar la película.";
                }
            }
        }
        if ($mensajeError) {
            $smarty->assign('mensajeError', $mensajeError);
        } else {
            $smarty->assign('pelicula', $pelicula);
            //Listamos los géneros para listar su ID con su respectivo nombre
            $resultadoGeneros = \VTV04\modulos\Generos::listar($pdo);
            $listaGeneros = [];
            if (is_array($resultadoGeneros)) {
                foreach ($resultadoGeneros as $genero) {
                    $listaGeneros[$genero->getId()] = $genero->getNombre();
                }
            }
            $smarty->assign('generos', $listaGeneros);
        }
        //Mostramos plantilla con resultado del proceso
        $smarty->display('borrar_pelicula_form_VTV.tpl.html');
    }

    /**
     * Controlador para confirmar y ejecutar el borrado de una película en la base de datos.
     * 
     * @param Peticion $p Objeto Peticion que contiene el ID y la confirmación.
     * @param PDO $pdo Objeto PDO con la conexión a la base de datos.
     * @param Smarty $smarty Objeto Smarty para mostrar el resultado de la operación.
     */
    public static function borrar_pelicula_confirmacion_VTV($p, $pdo, $smarty)
    {
        //Variables auxiliares
        $mensajeError = null;
        $resultadoBorrado = null;
        $mensajeExito = null;
        //Se reciben datos vía POST
        if ($p->isPost()) {
            if ($p->has('confirmacion')) {
                if ($p->has('id')) {
                    try {
                        //Comprobamos que el ID es un INT
                        $id = $p->getInt('id');
                        //Ejecutamos función para rescatar la película en la base de datos
                        $resultadoRescatar = \VTV04\modulos\Pelicula::rescatar($pdo, $id);
                        //Comprobamos el resultado de rescatar de la película
                        if (!($resultadoRescatar instanceof DBResult)) {
                            //Instanciamos la película con el ID para borrar
                            $pelicula = $resultadoRescatar;
                            $resultadoBorrado = \VTV04\modulos\Pelicula::borrar($pdo, $id);
                            if (!($resultadoBorrado instanceof DBResult)) {
                                $mensajeExito = "La película se ha borrado correctamente.";
                            } else {
                                $mensajeError = "Ocurrió un error al intentar borrar la película de la base de datos.";
                            }
                        } else {
                            $mensajeError = "Ocurrió un error al rescatar la película de la base de datos.";
                        }
                    } catch (Exception $e) {
                        $mensajeError = "Error al validar el ID de la película.";
                    }
                }
            } else {
                $mensajeError = "Error al intentar borrar la película. No se ha recibido confirmación de borrado.";
            }
        } else {
            $mensajeError = "No existe información para borrar la película.";
        }
        if ($mensajeError) {
            $smarty->assign('mensajeError', $mensajeError);
        } else {
            $smarty->assign('mensajeExito', $mensajeExito);
        }        
        //Mostramos plantilla con resultado del proceso
        $smarty->display('borrar_pelicula_confirmacion_VTV.tpl.html');
    }
}
