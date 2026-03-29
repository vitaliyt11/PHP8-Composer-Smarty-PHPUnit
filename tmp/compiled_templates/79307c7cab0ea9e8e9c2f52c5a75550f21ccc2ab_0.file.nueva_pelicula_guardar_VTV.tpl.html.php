<?php
/* Smarty version 4.4.1, created on 2026-03-22 16:44:36
  from 'C:\xampp\htdocs\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\dwes04\plantillasvtv\nueva_pelicula_guardar_VTV.tpl.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.4.1',
  'unifunc' => 'content_69c00e6419bd53_41375720',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '79307c7cab0ea9e8e9c2f52c5a75550f21ccc2ab' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Tserkovnyuk_Velichko_Vitaliy_DWES04_Tarea\\dwes04\\plantillasvtv\\nueva_pelicula_guardar_VTV.tpl.html',
      1 => 1774193296,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69c00e6419bd53_41375720 (Smarty_Internal_Template $_smarty_tpl) {
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
    <title>Resultado de proceso de guardar película</title>
</head>

<body>
    <header>
        <h1>Author: Vitaliy Tserkovnyuk Velichko</h1>
    </header>
    <hr>
    <main>
        <h2>Resultado proceso de guardar película</h2>

        <?php if ((isset($_smarty_tpl->tpl_vars['erroresFormulario']->value))) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['erroresFormulario']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
                <h4><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</h4>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>  
        <?php } else { ?>
            <h2><?php echo $_smarty_tpl->tpl_vars['mensajeExito']->value;?>
</h2>
        <?php }?>

        <a class="boton" href="index.php?accion=defecto">Volver a la lista de películas</a>
        <a class="boton" href="index.php?accion=nueva_pelicula_form_VTV">Volver al formulario para añadir nueva pelicula</a>
    </main>
</body>

</html><?php }
}
