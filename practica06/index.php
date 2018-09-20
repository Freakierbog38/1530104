<?php
  require_once("db/database_utilities.php");
  require_once("session.php");

?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Practica 06 |  Ejercicio 1</title>
    <link rel="stylesheet" href="./css/foundation.css" />
    <script src="./js/vendor/modernizr.js"></script>
  </head>
  <body>
    <?php require_once('header.php'); ?>

    <div class="row">

      <div class="large-9 columns">

        <h3>Ejercicio 1</h3>
        <div class="section-container tabs" data-section>

          <section class="section">

            <div class="content" data-slug="panel1">

              <div class="row">
                
              <table>
                <thead>
                  <th>
                    Usuarios
                  </th>
                  <th>
                    Tipos
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                    Accesos
                  </th>
                  <th>
                    Usuarios Activos
                  </th>
                  <th>
                    Usuarios Inactivos
                  </th>
                </thead>
                <tr>
                  <td>
                    <?php echo(count_users())?>
                  </td>
                  <td>
                    <?php echo(count_types())?>
                  </td>
                  <td>
                    <?php echo(count_status())?>
                  </td>
                  <td>
                    <?php echo(count_access())?>
                  </td>
                  <td>
                    <?php echo(count_active())?>
                  </td>
                  <td>
                    <?php echo(count_inactive())?>
                  </td>
                </tr>
              </table>
         	  </div>

          <?php 
          //Nombre de las tablas
          $tables=["status","user","user_log","user_type"];
          //Columnas de las tablas
          $cols=[["id","name"],["id","email","password","status_id","user_type_id"],["id","date_logged_in","user_id"],["id","name"]];
          //NUmero de tablas
          $count=0;

          foreach($tables as $t){
            $r = selectAllFromTable($t);  
            echo("Tabla: ".$t."<br>");
          
          if($t == "user"){
            echo('<td><a href="./add2.php" class="button radius tiny success">Agregar nuevo registro</a></td>');
          }
          ?>
            <table>
              <thead>
                <?php 
                  //Se imprime la cabecera de las tablas
                  for($i=0; $i<count($cols[$count]); $i++){
                    echo("<th>".$cols[$count][$i]."</th>");
                  }
                  $c = $r->rowCount();
                ?>
              </thead>
              <tbody>
                <?php
                  //Se imprimen las filas y columnas
                  for($i=0; $i<$c;$i++){
                    $d=$r->fetch(PDO::FETCH_ASSOC);
                    echo("<tr>");
                    for($j=0; $j<count($cols[$count]); $j++){
                      echo ("<script>console.log( '" . $cols[$count][$j] . "' );</script>");
                      echo("<td>".$d[$cols[$count][$j]]."</td>");
                    }
                    if($t == "user"){
                    ?>
                      <?//Se generan dos botones, que redireccionan a acutalizaar y eliminar respectivamente."?>
                      <td><a href="./update2.php?id=<?php echo($d['id']); ?>" class="button radius tiny warning">Modificar</a></td>
                      <td><a href="./delete2.php?id=<?php echo($d['id']); ?>" class="button radius tiny alert" onClick="wait();">Eliminar</a></td>
                    <?php
                    }
                    echo("</tr>");
                  }
                ?>
              </tbody>
            </table>
          <?php
          $count++;
          }
          ?>

            </div>
          
          </section>
        
        </div>
      
      </div>
    
    </div>

    <?php require_once('footer.php'); ?>
  
  </body>
</html>
