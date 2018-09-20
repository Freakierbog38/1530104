<?php
require_once("session.php");
?>
<div class="row">
  <div class="large-3 columns">
    <h2><?=$_SESSION['usuario_email']?></h2>
  </div>
  <div class="large-9 columns">
    <ul class="right button-group">
      <li><a href="./index.php" class="button">Ejercicio 1</a></li>
      <li><a href="./sistema_equipos.php" class="button">Ejercicio 2</a></li>
      <li><a href="./login.php" class="button radius tiny alert">Cerrar sesión</a></li>
    </ul>
  </div>
</div>