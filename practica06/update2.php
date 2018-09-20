<?php
include_once('db/database_utilities.php');

$id = isset( $_GET['id'] ) ? $_GET['id'] : '';  //Se revisa que el id del usuario se encuentre mediante el metodo get.
$r = searchUser($id); //Se realiza una busqueda en la base de datos donde se obtienen los atributos del registro con el id ingresado.

//Se revisa que todos las variables de los campos , se encuentren definidas, para posteriormente realizar la actualizacion y al final se
//realiza un redireccionado a la pagina principal.
if(isset($_POST['correo']) && isset($_POST['password']) && 
    isset($_POST['status']) && isset($_POST['tipo'])){
  updateUser($id,$_POST['correo'],$_POST['password'],$_POST['status'],$_POST['tipo']);//Llamada al metodo para la acción en base de datos
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
        <h3>Modificar Usuario</h3>
        <br>
        <div class="section-container tabs" data-section>
          <section class="section">
            <div class="content" data-slug="panel1">
                <form method="POST" action="update2.php?id=<?php echo($id)?>">
                  <!-- Se usa el registro buscando anteriormente para rellenar los campos con los valores
                      existentes, así el usuario no tiene que recordarlos y volverlos a llenar-->
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" value="<?php echo($r['email'])?>"><br>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" value="<?php echo($r['password'])?>"><br>
                    <label for="status">Estatus:</label>
                    <select name="status">
                        <?php 
                        $s = selectAllFromTable("status");
                        foreach($s as $dato){
                        ?>
                        <option value="<?php echo($dato['id']) ?>" <?php if($r['status_id'] == $dato['id']) echo('selected="selected"') ?>><?php echo($dato['name']) ?></option>
                        <?php } ?>
                    </select> <br><br>
                    <label for="tipo">Tipo:</label>
                    <select name="tipo">
                        <?php 
                        $s = selectAllFromTable("user_type");
                        foreach($s as $dato){
                        ?>
                        <option value="<?php echo($dato['id']) ?>" <?php if($r['user_type_id'] == $dato['id']) echo('selected="selected"') ?>><?php echo($dato['name']) ?></option>
                        <?php } ?>
                    </select>

                  <button type="submit" class="success">Actualizar</button>
                </form>
            </div>
          </section>
        </div>
      </div>
    </div>
     
    <?php require_once('footer.php'); ?>