<?php

function getPDO(){//Una instancia de PDO necesaria para la conexión con la Base de Datos
    $host = '127.0.0.1'; //El host
    $dbname = 'formulario'; //El nombre de la base de datos
    $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");// Habilitar el utf8 
    $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3307", 'root', 'usbw', $dbOtp); //Se crea la instancia
    return $pdoObj;// Y se regresa
}

$nombre = filter_input(INPUT_POST, 'nombre');// Se extrae del html que fue llamado el elemento con el nombre 'nombre'
$apellido = filter_input(INPUT_POST, 'apellido');// 'apellido'
$genero = filter_input(INPUT_POST, 'genero'); // y también el elemento con el nombre 'genero'

// Otra forma de obtener la información con el método POST
//$nombre = $_POST['nombre'];
//$apellido = $_POST['apellido'];
//$genero = $_POST['genero'];

if ($nombre === NULL || $nombre == false || $nombre === '' ||
    $apellido === NULL || $apellido == false || $apellido === '' ||
    $genero === NULL || $genero == false || $genero === '') { //Se valida que no esten vacias
		header('Location: ../Practica2/');
		exit();
}

//Se prepara la inserción a la tabla usuarios
$db = getPDO();
$stmt = $db->prepare('INSERT INTO usuarios (nombre, apellido, genero) VALUES (:nombre, :apellido, :genero)');
$stmt->bindParam(':nombre', $nombre);//Se reemplaza ':nombre' con el valor de la variable nombre usando bindParam
$stmt->bindParam(':apellido', $apellido); //Lo mismo para los siguientes campos
$stmt->bindParam(':genero', $genero);
$stmt->execute();// y se ejecuta

echo "Insercion exitosa";

header('Location: mostrar.php');

?>