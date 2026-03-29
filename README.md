# PHP8-Composer-Smarty-PHPUnit
Aplicación web para gestión de filmoteca (CRUD) con PHP, Smarty y MySQL. Proyecto para la asignatura de Desarrollo Web en Entorno Servidor.
# Proyecto Filmoteca DWES04

Este proyecto es una aplicación web para la gestión de una filmoteca, desarrollada como parte de la Tarea 04 para el módulo de Desarrollo Web en Entorno Servidor (DWES). La aplicación permite listar, añadir, y borrar películas de una base de datos.

## Características

*   **Listado de Películas**: Visualiza la lista completa de películas almacenadas en la base de datos.
*   **Ordenar Registros**: Permite ordenar el listado por título, año o duración.
*   **Añadir Películas**: Formulario para añadir nuevas películas al catálogo.
*   **Borrar Películas**: Funcionalidad para eliminar películas existentes.
*   **Gestión de Géneros**: Las películas se clasifican por géneros predefinidos.

## Tecnologías Utilizadas

*   **Backend**: PHP 8
*   **Base de Datos**: MySQL / MariaDB
*   **Motor de Plantillas**: Smarty
*   **Gestor de Dependencias**: Composer
*   **Pruebas Unitarias**: PHPUnit

## Instrucciones para el Despliegue en XAMPP

Sigue estos pasos para instalar y ejecutar el proyecto en un entorno de desarrollo local con XAMPP.

### Prerrequisitos

1.  **XAMPP**: Asegúrate de tener [XAMPP](https://www.apachefriends.org/es/index.html) instalado (incluye Apache, MariaDB y PHP).
2.  **Composer**: Necesitas [Composer](https://getcomposer.org/) para instalar las dependencias del proyecto.
3.  **Git**: Para clonar el repositorio (opcional, también puedes descargar el ZIP).

### Pasos

**1. Iniciar Servidores de XAMPP**

Abre el panel de control de XAMPP e inicia los módulos de **Apache** and **MySQL**.

**2. Crear la Base de Datos**

*   Accede a phpMyAdmin desde tu navegador (normalmente en `http://localhost/phpmyadmin`).
*   Crea una nueva base de datos. Puedes llamarla `filmoteca_dwes`.
*   Selecciona la base de datos recién creada y ve a la pestaña **"SQL"**.
*   Abre el archivo `configuracion_base_datos.txt` del proyecto, copia todo su contenido y pégalo en el cuadro de texto de la pestaña SQL.
*   Haz clic en **"Continuar"** (o "Go"). Esto creará las tablas `generos` y `peliculas` y las llenará con datos de ejemplo.

**3. Clonar y Configurar el Proyecto**

*   Navega hasta el directorio `htdocs` de tu instalación de XAMPP (ej: `C:/xampp/htdocs`).
*   Clona el repositorio o descomprime el proyecto en una carpeta. Por ejemplo:
    ```bash
    git clone <URL_DEL_REPOSITORIO> PHP-Composer-Smarty-PHPUnit
    ```
*   Navega dentro de la carpeta del proyecto:
    ```bash
    cd PHP-Composer-Smarty-PHPUnit
    ```

**4. Instalar Dependencias de PHP**

*   Ejecuta Composer para que instale las librerías necesarias (Smarty, PHPUnit, etc.):
    ```bash
    composer install
    ```

**5. Configurar la Conexión a la Base de Datos**

*   Abre el archivo `conf/db-config.php` con un editor de código.
*   Modifica los valores de las constantes para que coincidan con la configuración de tu base de datos creada en el paso 2.

    ```php
    <?php
    /**
     * Fichero de configuración de acceso a la base de datos.
     */

    // Nombre de la base de datos
    define('DB_NAME', 'filmoteca_dwes'); 
    
    // Usuario de la base de datos
    define('DB_USER', 'root');
    
    // Contraseña del usuario
    define('DB_PASSWORD', ''); // Por defecto en XAMPP es vacía
    
    // Host
    define('DB_HOST', 'localhost'); 
    
    // DSN (Data Source Name)
    define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8');
    ?>
    ```

**6. Acceder a la Aplicación**

*   Abre tu navegador web y accede a la URL correspondiente a la carpeta del proyecto. Por ejemplo:
    `http://localhost/PHP-Composer-Smarty-PHPUnit/`

Con esto, la aplicación estara funcionando correctamente en tu entorno XAMPP.

## Estructura del Proyecto

*   `conf/`: Ficheros de configuración (ej. conexión a la BD).
*   `css/`: Hojas de estilo.
*   `plantillasvtv/`: Plantillas de Smarty (`.tpl.html`).
*   `script/`: Clases de utilidad (ej. `Peticion.php`).
*   `srcvtv/`: Código fuente principal de la aplicación (controladores, modelos/módulos).
*   `tests/`: Pruebas unitarias de PHPUnit.
*   `vendor/`: Dependencias de Composer.
*   `tmp/`: Directorios para la caché y plantillas compiladas de Smarty.
*   `index.php`: Punto de entrada único de la aplicación (Front Controller).
*   `composer.json`: Define las dependencias y la configuración del proyecto.
