<?php
/* Smarty version 4.4.1, created on 2026-03-22 15:06:56
  from 'C:\xampp\htdocs\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\dwes04\plantillasvtv\nueva_pelicula_form_VTV.tpl.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_69bff780ead568_16956973',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '49f1505f95b5fe9f0b9163720aaef430b652c7a6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\\dwes04\\plantillasvtv\\nueva_pelicula_form_VTV.tpl.html',
      1 => 1774188414,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69bff780ead568_16956973 (Smarty_Internal_Template $_smarty_tpl) {
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
    <title>Formulario para guardar nueva película</title>
</head>

<body>
    <header>
        <h1>Author: Vitaliy Tserkovnyuk Velichko</h1>
    </header>
    <hr>
    <main>
        <h2>Crear nueva película</h2>

        <!-- Formulario para añadir película -->
        <form action="index.php" method="POST">
            <input type="hidden" name="accion" value="nueva_pelicula_guardar_VTV">
            <label for="titulo">Título de la película:</label><br>
            <input type="text" id="titulo" name="titulo">
            <br>
            <label for="direccion">Dirección:</label><br>
            <input type="text" id="direccion" name="direccion">
            <br>
            <label for="anio">Año de la película:</label><br>
            <input type="text" id="anio" name="anio">
            <br>
            <label for="genero">Género de la película:</label><br>
                <input type="radio" id="genero" name="genero" value="9999">
                <label for="9999">Genero no existente (9999)</label> <br>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['generos']->value, 'nombre', false, 'id');
$_smarty_tpl->tpl_vars['nombre']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['nombre']->value) {
$_smarty_tpl->tpl_vars['nombre']->do_else = false;
?>
                <input type="radio" id="genero" name="genero" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
                <label for="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</label><br>  
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <br>
            <label for="duracion">Duración de la película (minutos):</label><br>
            <input type="text" id="duracion" name="duracion">
            <br>
            <label for="argumento">Argumento de la película:</label><br>
            <textarea id="argumento" name="argumento" rows="4" cols="50"></textarea>
            <br>
            <input class="boton" type="submit" value="Crear nueva película">
        </form>
    </main>
</body>

</html><?php }
}
