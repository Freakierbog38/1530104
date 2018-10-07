<?php
    // El index que muestra al usuaria la salida de las vistas y a traves de él enviaremos las distintas
    // acciones del usuario al controlador

    // Mostrará la plantilla al usuario(template.php) la cual se alojará en view
    require_once "controllers/controller.php";

    // Invocamos el modelo que se utilizará en todos los archivos
    require_once "models/model.php";

    // Para poder ver el template, o plantilla, se hace una petición a un controlador
    // Creamos el objeto: 
    $mvc = new MvcController();

    // Muestra la función "plantilla" que se encuentra en controllers/controller
    $mvc -> plantilla();

?>