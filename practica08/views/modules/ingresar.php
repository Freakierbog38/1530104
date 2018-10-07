<h1>PÁGINA DE INGRESO DE USUARIO</h1>

<form method="POST">

    <input type="text" placeholder="usuario" name="usuarioIngreso" required>

    <input type="password" placeholder="contraseña" name="passwordIngreso" required>

    <input type="submit" value="Enviar">

</form>

<?php
    //Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
    $ingreso = new MvcController();

    //se invoca la funcion ingresoUsuariocontroller de la clase mvccontroller;
    $ingreso -> ingresoUsuarioController();

?>