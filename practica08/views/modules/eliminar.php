<h1>PÁGINA DE ELIMINAR USUARIO</h1>

<form method="POST">

    <a>Necesita volver a ingresar su contraseña para eliminar un registro</a>

    <input type="password" placeholder="contraseña" name="passwordEliminar" required>

    <input type="submit" value="Enviar">

</form>

<?php
    if(isset($_POST["passwordEliminar"])){
        //Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
        $eliminar = new MvcController();
        //Compara si la contraseña es correcta, con la extraída en session
        if($_SESSION["usuario_password"]==$_POST["passwordEliminar"]){
            //Llama el método eliminarUsuarioController de la clase MvcController
            $eliminar-> eliminarUsuarioController($_GET["user"]); //Y manada el id del usuario a eliminar
        }else{
            header("Location: index.php?action=usuarios");
        }
    }
?>