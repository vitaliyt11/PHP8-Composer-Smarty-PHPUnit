<?php
/* Smarty version 4.4.1, created on 2026-03-22 17:57:20
  from 'C:\xampp\htdocs\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\dwes04\plantillasvtv\borrar_pelicula_form_VTV.tpl.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_69c01f70145b33_67820260',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '498190560267943816523e35546d0099460cfb1d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\\dwes04\\plantillasvtv\\borrar_pelicula_form_VTV.tpl.html',
      1 => 1774196947,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69c01f70145b33_67820260 (Smarty_Internal_Template $_smarty_tpl) {
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
    <title>Formulario para confirmar borrado de película</title>
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
        <p><strong>Título:</strong> <?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getTitulo();?>
</p> 
        <p><strong>Dirección:</strong> <?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getDireccion();?>
</p>
        <p><strong>Año:</strong> <?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getAnio();?>
</p> 
        <p><strong>Género:</strong> <?php echo $_smarty_tpl->tpl_vars['generos']->value[$_smarty_tpl->tpl_vars['pelicula']->value->getGenero()];?>
</p> 
        <p><strong>Duración:</strong> <?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getDuracion();?>
 minutos</p> 
        <p><strong>Argumento:</strong> <?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getArgumento();?>
</p>  
            <form action="index.php" method="POST">
                <input type="checkbox" name="confirmacion" id="confirmacion">
                <label for="confirmacion">Marca la casilla para confirmar el borrado</label><br>
                <input type="hidden" name="accion" value="borrar_pelicula_confirmacion_VTV">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getId();?>
">
                <br><input class="boton" type="submit" value="Confirmar borrado">
            </form>
        <?php }?>
        <hr><br>
        <a class="boton" href="index.php?accion=defecto">Volver a la lista de películas</a>

    </main>
</body>

</html><?php }
}
