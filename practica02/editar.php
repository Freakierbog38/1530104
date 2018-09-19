<?php

function getPDO(){//Una instancia de PDO necesaria para la conexión con la Base de Datos
    $host = '127.0.0.1'; //Dirección de host
    $dbname = 'formulario'; //El nombre de la base de datos
    $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");// Habilitar el utf8 
    $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3307", 'root', 'usbw', $dbOtp); //Se crea la instancia
    return $pdoObj;// Y se regresa
}

$nombre = filter_input(INPUT_POST, 'nombre');// Se extrae del html que fue llamado el elemento con el nombre 'nombre'
$apellido = filter_input(INPUT_POST, 'apellido');// 'apellido'
$genero = filter_input(INPUT_POST, 'genero'); // y también el elemento con el nombre 'genero'

$id = filter_input(INPUT_GET, 'id');//Recibe el id del registro que se va a eliminar

$db = getPDO();
$sqlCmd = "UPDATE usuarios SET nombre= :nombre, apellido= :apellido, genero= :genero  WHERE id = :id"; //Se prepara el comando para eliminar
$stmt = $db->prepare($sqlCmd);
$stmt->bindParam(':id', $id);//Se reemplaza ":id" por el valor real
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':apellido', $apellido);
$stmt->bindParam(':genero', $genero);
$stmt->execute();// Y se ejecuta

echo "Registro editado.";

header('Location: mostrar.php');

?>