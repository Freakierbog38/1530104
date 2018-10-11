
<?php
    //Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
    $eliminar = new MvcController();
    //Se guarda el alumno para borrar la imagen una vez eleminado el alumno
    $mat = Datos::unAlumnoModel("alumno", $_GET["user"]);
    $url = $mat["foto"];
    //Llama el método eliminarUsuarioController de la clase MvcController
    $eliminar-> eliminarAlumnoController($_GET["user"]); //Y manada el id del usuario a eliminar
    unlink("img/".$url);
    header("Location: index.php?action=usuarios");
?>