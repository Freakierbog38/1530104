<h1>PÁGINA DE USUARIOS</h1>

<?php

//Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
$usuarios = new MvcController();

if(isset($_GET["action"])){
    //Checa si una sesión ha sido iniciada
    if($_SESSION){
        echo "Mostrando Usuarios...";
        //se invoca la funcion muestraUsuariocontroller de la clase mvccontroller;
        $usuarios -> muestraUsuarioController();
    }
    //Si no muestra ese texto
    else
        echo("Necesitas ingresar primero.");
}

?>