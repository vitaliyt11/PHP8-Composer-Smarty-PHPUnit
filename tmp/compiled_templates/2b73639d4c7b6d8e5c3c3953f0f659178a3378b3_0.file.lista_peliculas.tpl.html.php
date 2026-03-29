<?php
/* Smarty version 4.4.1, created on 2026-03-22 17:14:04
  from 'C:\xampp\htdocs\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\dwes04\plantillasvtv\lista_peliculas.tpl.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_69c0154c1784d5_80807249',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b73639d4c7b6d8e5c3c3953f0f659178a3378b3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\\dwes04\\plantillasvtv\\lista_peliculas.tpl.html',
      1 => 1774195941,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69c0154c1784d5_80807249 (Smarty_Internal_Template $_smarty_tpl) {
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
    <title>Listado de Películas</title>
</head>

<body>
    <header>
        <h1>Author: Vitaliy Tserkovnyuk Velichko</h1>
    </header>
    <hr>
    <main>
        <h2>Lista de películas</h2>

        <a class="boton" href="index.php?accion=nueva_pelicula_form_VTV">Ir a formulario para añadir nueva pelicula</a>

        <form action="index.php" method="POST">
            <label for="criterio">Ordenar por:</label>
            <select name="criterio" id="criterio">
                <option value="titulo">Título</option>
                <option value="anio">Año</option>
                <option value="duracion">Duración</option>
            </select>
            <select name="orden" id="orden">
                <option value="ascendente">Ascendente</option>
                <option value="descendente">Descendente</option>
            </select>
            <input class="boton" type="submit" value="Ordenar">
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Año</th>
                <th>Género</th>
                <th>Dirección</th>
                <th>Duración</th>
                <th>Argumento</th>
                <th>Acciones</th>
            </tr>

            <!-- Recorrer el array de objetos $peliculas -->
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['peliculas']->value, 'pelicula');
$_smarty_tpl->tpl_vars['pelicula']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pelicula']->value) {
$_smarty_tpl->tpl_vars['pelicula']->do_else = false;
?>
            <tr>
                <!-- Como son objetos, usamos -> y llamamos a sus getters -->
                <td><?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getId();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getTitulo();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getAnio();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['generos']->value[$_smarty_tpl->tpl_vars['pelicula']->value->getGenero()];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getDireccion();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getDuracion();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getArgumento();?>
</td>
                <td>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="accion" value="borrar_pelicula_form_VTV">
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['pelicula']->value->getId();?>
">
                        <input class="boton" type="submit" value="Borrar">
                    </form>
                </td>
            </tr>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
    </main>
</body>

</html><?php }
}
