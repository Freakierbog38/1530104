<?php

function getPDO(){//Una instancia de PDO necesaria para la conexión con la Base de Datos
    $host = '127.0.0.1'; //Dirección de host
    $dbname = 'formulario'; //El nombre de la base de datos
    $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");// Habilitar el utf8 
    $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3307", 'root', 'usbw', $dbOtp); //Se crea la instancia
    return $pdoObj;// Y se regresa
}

$id = filter_input(INPUT_GET, 'id');//Recibe el id del registro que se va a eliminar

$db = getPDO();
$sqlCmd = "DELETE FROM usuarios WHERE id = :id"; //Se prepara el comando para eliminar
$stmt = $db->prepare($sqlCmd);
$stmt->bindParam(':id', $id);//Se reemplaza ":id" por el valor real
$stmt->execute();// Y se ejecuta

echo "Registro eliminado.";

header('Location: mostrar.php');

?>