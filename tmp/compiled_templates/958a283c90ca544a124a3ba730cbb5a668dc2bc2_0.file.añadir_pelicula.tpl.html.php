<?php
/* Smarty version 4.4.1, created on 2026-03-22 13:47:37
  from 'C:\xampp\htdocs\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\dwes04\plantillasvtv\añadir_pelicula.tpl.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_69bfe4e99f7e31_94002878',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '958a283c90ca544a124a3ba730cbb5a668dc2bc2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\\dwes04\\plantillasvtv\\añadir_pelicula.tpl.html',
      1 => 1774183655,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69bfe4e99f7e31_94002878 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<!--
    Autor: Vitaliy Tserkovnyuk Velichko
-->

<head> <!--Llamamiento de los estilos, fuentes, letras y título de los que se van a emplear en la página web-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DIW, Tarea 4">
    <meta name="author" content="Vitaliy Tserkovnyuk Velichko">

    <!-- Importación del archivo css  -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Listado de Películas</title>
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
            <input type="hidden" name="accion" value="añadirPelicula">
            
            
                <label for="titulo">Título:</label><br>
                <input type="text" id="titulo" name="titulo" required>
            
            <br>
            
                <label for="anio">Año:</label><br>
                <input type="number" id="anio" name="anio" min="1901" required>
            
            <br>
            
                <label for="genero">Género:</label><br>
                <select id="genero" name="genero" required>
                    <option value="">Selecciona un género...</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['generos']->value, 'nombre', false, 'id');
$_smarty_tpl->tpl_vars['nombre']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['nombre']->value) {
$_smarty_tpl->tpl_vars['nombre']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            
            <br>
            
                <label for="direccion">Dirección:</label><br>
                <input type="text" id="direccion" name="direccion" required>
            
            <br>
            
                <label for="duracion">Duración (minutos):</label><br>
                <input type="number" id="duracion" name="duracion" min="1" max="499" required>
           
            <br>
            
                <label for="argumento">Argumento:</label><br>
                <textarea id="argumento" name="argumento" rows="4" cols="50" required></textarea>
            
            <br>
            
                <input class="boton" type="submit" value="Guardar Película">
                
            
        </form>
    </main>
</body>

</html><?php }
}
