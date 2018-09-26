<?php
include_once('bd/database_utilities.php');

if(isset($_POST['nombre'])){
  addCarrera($_POST['nombre']);
  header("location: index.php");
}
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
        <h3>Agregar Nueva Carrera</h3>
        <br>
        <div>
          <section>
            <div>
                <form method="POST" action="addCarrera.php">
                  <!-- Se crean el formulario que obtendrá la información para pasarla a la base de datos -->
                  <label for="nombre">Nombre de la carrera:</label>
                  <input type="text" name="nombre"><br>
                  <button type="submit" class="success">Guardar</button>
                </form>
            </div>
          </section>
        </div>
      </div>
    </div>
    </body>
</html>