<h1>PÁGINA PARA EDITAR USUARIO</h1>

<?php
    $r = Datos::unUsuarioModel("usuario", $_GET["user"]);
?>

<form method="POST">

    <input type="text" value="<?php echo $r['nombre']?>" name="usuarioCambio" required>

    <input type="email" value="<?php echo $r['correo']?>" name="emailCambio" required>

    <input type="submit" value="Enviar">

</form>

<?php

//Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
$registro = new MvcController();

//se invoca la funcion cambioUsuariocontroller de la clase mvccontroller;
$registro -> cambioUsuarioController($r["id"]);

?>