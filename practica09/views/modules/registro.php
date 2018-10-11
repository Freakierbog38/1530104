<h1> REGISTRO DE ALUMNO</h1>

<form method="POST" enctype="multipart/form-data">

    <label for="matriculaRegistro">Matrícula:</label><br>
    <input type="text" placeholder="Matricula" name="matriculaRegistro" required>

    <br><br>

    <label for="nombreRegistro">Nombre:</label><br>
    <input type="text" placeholder="Nombre" name="nombreRegistro" required>

    <br><br>

    <label for="carreraRegistro">Carrera:</label><br>
    <select name="carreraRegistro">
        <?php $respuesta = Datos::mostrarUsuariosModel("carrera");
        foreach($respuesta as $dato){ ?>
        <option value=<?php echo($dato["id"]); ?>> <?php echo($dato["nombre"]);} ?></option>
    </select>

    <br><br>

    <label for="academicaRegistro">Situación Academica: </label><br>
    <select name="academicaRegistro">
            <option value="Regular"> Regular </option>
            <option value="Especial"> Especial </option>
    </select>

    <br><br>

    <label for="emailRegistro">Correo:</label>
    <input type="email" placeholder="ejemplo@correo.com" name="emailRegistro" required>

    <br><br>

    <label for="tutorRegistro">Tutor:</label><br>
    <select name="tutorRegistro">
        <?php $respuesta = Datos::mostrarUsuariosModel("tutor");
        foreach($respuesta as $dato){?>
        <option value=<?php echo($dato["id"]); ?>> <?php echo($dato["nombre"]);} ?></option>
    </select>

    <br><br>

    <label for="imagenRegistro">Imagen de perfil:</label>
    <input type="file" name="imagenRegistro" accept="image/jpeg, image/png">

    <input type="submit" value="Enviar">

</form>

<?php

    //Enviar los datos al controlador mcvcontroler (es la clase principal de controller.php)
    $registro = new MvcController();

    //se invoca la funcion registrousuariocontroller de la clase mvccontroller;
    $registro -> registroAlumnoController();

    if(isset($_GET["action"])){
        if($_GET["action"] == "ok"){
            echo "Registro Exitoso";
        }
    }

?>