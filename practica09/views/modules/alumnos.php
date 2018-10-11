<h1>PÁGINA DE ALUMNOS</h1>

<?php

//Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
$usuarios = new MvcController();


echo("<center><a href=index.php?action=registro> <button> Agregar un alumno </button> </a></center>");
//se invoca la funcion muestraUsuariocontroller de la clase mvccontroller;
$usuarios -> muestraAlumnosController();

?>