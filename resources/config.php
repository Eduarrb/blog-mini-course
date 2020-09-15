<?php
    ob_start();

    session_start();

    // DEFINICION DE CONSTANTES
    // DS = \
    defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

    defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");
    defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

    // C:\xampp\htdocs\curso_php_mini\resources\ --> __DIR__

    // CONEXION CON LA BASE DE DATOS
    defined("DB_HOST") ? null : define("DB_HOST", "localhost");
    defined("DB_USER") ? null : define("DB_USER", "root");
    defined("DB_PASS") ? null : define("DB_PASS", "");
    defined("DB_NAME") ? null : define("DB_NAME", "blog_mini");
    
    $conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($conexion, "utf8");
    // $name = "edu";

    // if($conexion){
    //     echo "estamos conectados";
    // }

    require_once("funciones.php");

?>