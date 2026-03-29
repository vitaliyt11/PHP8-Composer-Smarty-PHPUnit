<?php
/**
 * Punto de entrada de la aplicación
 * Gestiona las peticiones, inicializa variables de sesión, base de datos y Smarty.
 *
 * @author Vitaliy Tserkovnyuk Velichko
 */

session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/conf/db-config.php';


use \VTV04\modulos\Generos;
use VTV04\modulos\Pelicula;
use VTV04\modulos\Peliculas;
use \Controladores\ControladorVTV;
use \Peticion\Peticion;

/**
 * Inicialización de la conexión a la base de datos.
 * 
 * @var PDO $pdo Objeto para interactuar con la base de datos.
 */
try {
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD, 
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    die('No se puede conectar con la base de datos. Revisar el archivo ./conf/db-config.php.');
}

/**
 * Comprobación de carga de la librería Smarty.
 */
if (!class_exists('Smarty')){
    die("No se ha encontrado Smarty. Este proyecto usa composer, por lo que es necesario ejecutar 'composer install'");
}

/**
 * Configuración e inicialización del motor de plantillas Smarty.
 * 
 * @var Smarty $smarty Instancia para el renderizado de vistas.
 */
$smarty = new Smarty();
$smarty->setTemplateDir('./plantillasvtv');
$smarty->setCompileDir('./tmp/compiled_templates');
$smarty->setCacheDir('./tmp/smarty_cache');

/**
 * Captura y saneamiento de los parámetros recibidos por HTTP.
 * 
 * @var Peticion $p Objeto para procesar GET y POST.
 */
$p = new Peticion();

/**
 * Acción solicitada por el usuario.
 * 
 * @var string $accion Identificador de la acción a ejecutar.
 */
$accion = $p->has('accion') ? $p->getString('accion') : 'defecto';

/**
 * Enrutador principal.
 * Evalúa la acción solicitada y deriva la petición al método correspondiente del Controlador.
 */
switch ($accion) {
    case 'nueva_pelicula_form_VTV':
        ControladorVTV::controladorAñadirPelicula($p, $pdo, $smarty);
        break;
    case 'nueva_pelicula_guardar_VTV':
        //Comprobamos si la petición HTTP es POST
        if ($p->isPost()) {
            ControladorVTV::controladorGuardarPelicula($p, $pdo, $smarty);
        } else {
            //Si se intenta acceder por GET mediante la URL, mostramos el error
            ControladorVTV::controladorErrorFormaEnvioFormulario($smarty);
        }
        break;
    case 'borrar_pelicula_form_VTV':
        //Comprobamos si la petición HTTP es POST
        if ($p->isPost()) {
            //Procedemos a cargar el controlador para formulario de borrado de película
            ControladorVTV::borrar_pelicula_form_VTV($p, $pdo, $smarty);
        } else {
            //Si se intenta acceder por GET mediante la URL, mostramos el error
            ControladorVTV::controladorErrorFormaEnvioFormulario($smarty);
        }
        break;
    case 'borrar_pelicula_confirmacion_VTV':
        //Comprobamos si la petición HTTP es POST
        if ($p->isPost()) {
            //Procedemos a cargar el controlador para formulario de borrado de película
            ControladorVTV::borrar_pelicula_confirmacion_VTV($p, $pdo, $smarty);
        } else {
            //Si se intenta acceder por GET mediante la URL, mostramos el error
            ControladorVTV::controladorErrorFormaEnvioFormulario($smarty);
        }
        break;        
    case 'defecto':
    default:
        ControladorVTV::controladorDefecto($p, $pdo, $smarty);
        break;
}
?>