<?php

function getPDO(){//Una instancia de PDO necesaria para la conexión con la Base de Datos
    $host = '127.0.0.1'; //Dirección de host
    $dbname = 'formulario'; //El nombre de la base de datos
    $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");// Habilitar el utf8 
    $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3307", 'root', 'usbw', $dbOtp); //Se crea la instancia
    return $pdoObj;// Y se regresa
}

$id = filter_input(INPUT_GET, 'id');//Recibe el id del registro que se va a editar
$db = getPDO();
$sqlCmd = "SELECT * FROM usuarios WHERE id = :id"; //Se prepara el comando para editar
$stmt = $db->prepare($sqlCmd);
$stmt->bindParam(':id', $id);//Se reemplaza ":id" por el valor real
$stmt->execute();// Y se ejecuta

$r = $stmt->fetch(PDO::FETCH_ASSOC)

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Práctica 02</title>
</head>
<body>
    <div>

        <h3>Practica 02</h3>

        <fieldset>
            <form method="POST" action="editar.php?id=<?=$r['id'];?>">
            <label for="txtNombre">Nombre:</label>
            <input id="txtNombre" name="nombre" type="text" value="<?= $r['nombre'] ?>">
            <br>
            <label for="txtApellido">Apellido:</label>
            <input id="txtApellido" name="apellido" type="text" value= "<?= $r['apellido'] ?>">
            <br>
            <label for="genero">Genero:</label>
            <select name="genero">    
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
            <br>
            <input type="submit" value="Registrar">
            </form> 
        </fieldset>
        
    </div>
</body>
</html>