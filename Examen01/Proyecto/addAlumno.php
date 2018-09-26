<?php
include_once('bd/database_utilities.php');

if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['carrera']) && isset($_POST['tutor'])){
  addAlumno($_POST['id'],$_POST['nombre'],$_POST['carrera'],$_POST['tutor']);
  header("location: index.php");
}

$r=selectAllFromTable('carrera');
$t=selectAllFromTable('tutor');
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Examen 1</title>
  </head>
  <body>

    <div>
 
      <div>
        <h3>Agregar Nuevo Alumno</h3>
        <br>
        <div>
          <section>
            <div >
                <form method="POST" action="addAlumno.php">
                  <label for="id">ID:</label>
                  <input type="text" name="id"><br>
                  <label for="nombre">Nombre:</label>
                  <input type="text" name="nombre"><br>
                  <label for="carrera">Carrera:</label>
                  <select name="carrera">
                    <option value="-1"> Seleccione.. </option>
                    <?php
                    while($dato = $r->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo($dato['id']) ?>"> <?php echo($dato['nombre']) ?> </option>
                    <?php } ?>
                  </select>
                  <label for="tutor">Tutor:</label>
                  <select name="tutor">
                    <option value="-1"> Seleccione.. </option>
                    <?php
                    while($dato = $t->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <option value="<?php echo($dato['id']) ?>"> <?php echo($dato['nombre']) ?> </option>
                    <?php } ?>
                  </select>
                  <button type="submit" class="success">Guardar</button>
                </form>
            </div>
          </section>
        </div>
      </div>
    </div>
    </body>
</html>