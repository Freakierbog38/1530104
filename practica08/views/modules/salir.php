<h1>Haz salido.</h1>

<?php
    //Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
    $ingreso = new MvcController();

    //se invoca la funcion ingresoUsuariocontroller de la clase mvccontroller;
    $ingreso -> salirUsuarioController();
?>