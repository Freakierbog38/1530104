<h1>PÁGINA PARA EDITAR USUARIO</h1>

<?php
    $r = Datos::unAlumnoModel("alumno", $_GET["user"]);
?>

<form method="POST" enctype="multipart/form-data">

    <center><img src=<?php echo("img/". $r["foto"]); ?> height=200 width=200></center> <br>
    <label for="imagenEditar">Cambiar imagen de perfil:</label>
    <input type="file" name="imagenEditar" accept="image/jpeg, image/png">

    <label for="matriculaEditar">Matrícula:</label><br>
    <input type="text" value=<?php echo($r["matricula"]) ?> name="matriculaEditar" readonly="readonly">

    <br><br>

    <label for="nombreEditar">Nombre:</label><br>
    <input type="text" value=<?php echo($r["nombre"]) ?> name="nombreEditar" required>

    <br><br>

    <label for="carreraEditar">Carrera:</label><br>
    <select name="carreraEditar">
        <?php $respuesta = Datos::mostrarUsuariosModel("carrera");
        foreach($respuesta as $dato){ ?>
        <option value=<?php echo($dato["id"]); ?> <?php if($dato["id"]==$r["carrera"]) echo("selected"); ?>> <?php echo($dato["nombre"]);} ?></option>
    </select>

    <br><br>

    <label for="academicaEditar">Situación Academica: </label><br>
    <select name="academicaEditar">
            <option value="Regular" <?php if($r["academica"]== "Regular") echo("selected"); ?> > Regular </option>
            <option value="Especial" <?php if($r["academica"]== "Especial") echo("selected"); ?> > Especial </option>
    </select>

    <br><br>

    <label for="emailEditar">Correo:</label>
    <input type="email" value=<?php echo($r["email"]) ?> name="emailEditar" required>

    <br><br>

    <label for="tutorEditar">Tutor:</label><br>
    <select name="tutorEditar">
        <?php $respuesta = Datos::mostrarUsuariosModel("tutor");
        foreach($respuesta as $dato){?>
        <option value=<?php echo($dato["id"]); ?><?php if($dato["id"]==$r["tutor"]) echo("selected"); ?> > <?php echo($dato["nombre"]);} ?></option>
    </select>

    <input type="submit" value="Enviar">

</form>

<?php

//Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
$registro = new MvcController();

//se invoca la funcion cambioUsuariocontroller de la clase mvccontroller;
$registro -> cambioAlumnoController();

?>