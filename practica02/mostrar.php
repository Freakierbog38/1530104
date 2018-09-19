<?php 
	
	function getPDO(){//Una instancia de PDO necesaria para la conexión con la Base de Datos
        $host = '127.0.0.1'; //El host
        $dbname = 'formulario'; //El nombre de la base de datos
        $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");// Habilitar el utf8 
        $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3307", 'root', 'usbw', $dbOtp); //Se crea la instancia
        return $pdoObj;// Y se regresa
    }

	$db = getPDO();  // Objeto PDO para conectarse (hacer las operaciones) a la base de datos

	// Crear statement (instrucción) para ejecución a BD. Pernite parametrizar datos de la consulta
	$stmt = $db->prepare('SELECT * FROM usuarios');

	// Se ejecuta el statement
	$stmt->execute();

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title> Práctica 02</title>
 </head>
 <body>
 	<div>
 		<center><h1> Práctica 2</h1></center>

        <a href="agregar.html"> Agregar registro <a/>

 		<table>
 			<thead>
 				<tr>
 					<th>Nombre</th> <th>Apellido</th> <th>Género</th>
 				</tr>
 			</thead>
 			<tbody>
 			
 <?php // Hasta que stmt se le asigne NULL, NULL lo interpreta como un false y se sale del while ?>
 <?php while($r = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
 			<tr>
 				<td style="border: 1px solid black;"> <?= $r['nombre'] ?> </td>
                <td style="border: 1px solid black;"> <?= $r['apellido'] ?> </td>
                <td style="border: 1px solid black;"> <?= $r['genero'] ?> </td>
				<td style="border: 1px solid black;"><a href="editarF.php?id=<?=$r['id'];?>">Editar</a></td>
                <td style="border: 1px solid black;"><a href="borrar.php?id=<?=$r['id'];?>">Borrar</a></td>
 			</tr>
 
 <?php } ?>

 			</tbody>
 		</table>

 	</div>
 </body>
 </html>