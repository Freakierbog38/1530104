<?php
include_once('db/database_utilities.php');

//Se revisa que las variables nombre y email se esten recibiendo mediante el metodo POST para despues continuar
//con la insercion de los valores ingresados en la base de datos, para finalmente redireccionar al inicio
if(isset($_POST['correo']) && isset($_POST['password']) && 
    isset($_POST['status']) && isset($_POST['tipo'])){
  addUser($_POST['correo'],$_POST['password'],$_POST['status'],$_POST['tipo']);//Llamada al metodo para la acción en base de datos
  header("location: index.php");
}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Curso PHP |  Bienvenidos</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <?php require_once('header.php'); ?>

    <div class="row">
 
      <div class="large-9 columns">
        <h3>Agregar Nuevo Usuario</h3>
        <br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
                <form method="POST" action="add2.php">
                  <!-- Se crean el formulario que obtendrá la información para pasarla a la base de datos -->
                  <label for="correo">Correo:</label>
                    <input type="email" name="correo"><br>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password"><br>
                    <label for="status">Estatus:</label>
                    <select name="status">
                        <?php 
                        $s = selectAllFromTable("status");
                        foreach($s as $dato){
                        ?>
                        <option value="<?php echo($dato['id']) ?>"> <?php echo($dato['name']) ?> </option>
                        <?php } ?>
                    </select> <br><br>
                    <label for="tipo">Tipo:</label>
                    <select name="tipo">
                        <?php 
                        $s = selectAllFromTable("user_type");
                        foreach($s as $dato){
                        ?>
                        <option value="<?php echo($dato['id']) ?>"> <?php echo($dato['name']) ?> </option>
                        <?php } ?>
                    </select>
                  <button type="submit" class="success">Guardar</button>
                </form>
            </div>
          </section>
        </div>
      </div>
    </div>
     
    <?php require_once('footer.php'); ?>