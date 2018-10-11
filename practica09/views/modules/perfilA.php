<h1>PERFIL</h1>
<?php
    $r = Datos::unAlumnoModel("alumno", $_GET["user"]);
?>
<div align="center">
    <img src=<?php echo("img/". $r["foto"]); ?> height=200 width=200> <br>
    <h4>Matrícula: <?php echo($r["matricula"]); ?> </h4>
    <h4>Nombre: <?php echo($r["nombre"]); ?> </h4>
    <h4>Correo: <?php echo($r["email"]); ?> </h4>
    <?php $datos = Datos::mostrarUsuariosModel("carrera");
    foreach($datos as $d){ ?>
    <h4>Carrera: <?php if($d["id"]==$r["carrera"]) echo($d["nombre"]); ?> </h4>
    <?php } ?>
    <h4>Situación Académica: <?php echo($r["academica"]); ?></h4>
    <?php $datos = Datos::mostrarUsuariosModel("tutor");
    foreach($datos as $d){ ?>
    <h4>Carrera: <?php if($d["id"]==$r["tutor"]) echo($d["nombre"]); ?> </h4>
    <?php } ?>
</div>