<?php
/* Smarty version 4.4.1, created on 2026-03-22 17:58:07
  from 'C:\xampp\htdocs\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\dwes04\plantillasvtv\borrar_pelicula_confirmacion_VTV.tpl.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_69c01f9f96d054_64222573',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1bf9a9aaf0147416fcd13d04ab14ba7d076e5126' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\\dwes04\\plantillasvtv\\borrar_pelicula_confirmacion_VTV.tpl.html',
      1 => 1774198635,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69c01f9f96d054_64222573 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<!--
    Autor: Vitaliy Tserkovnyuk Velichko
-->

<head> <!--Llamamiento de los estilos, fuentes, letras y título de los que se van a emplear en la página web-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DWES, Tarea 4">
    <meta name="author" content="Vitaliy Tserkovnyuk Velichko">

    <!-- Importación del archivo css  -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Resultado de proceso de borrado de película</title>
</head>

<body>
    <header>
        <h1>Author: Vitaliy Tserkovnyuk Velichko</h1>
    </header>
    <hr>
    <main>
        <h2>Confirmar borrado de película</h2>
        <?php if ((isset($_smarty_tpl->tpl_vars['mensajeError']->value))) {?>
            <h3><?php echo $_smarty_tpl->tpl_vars['mensajeError']->value;?>
</h3>
        <?php } else { ?>
            <h3><?php echo $_smarty_tpl->tpl_vars['mensajeExito']->value;?>
</h3>
        <?php }?>

        <hr><br>
        <a class="boton" href="index.php?accion=defecto">Volver a la lista de películas</a>
    </main>
</body>

</html><?php }
}
