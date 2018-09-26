<?php
	define('DB_HOST', '127.0.0.1');
	define('DB_DATABASE', 'examen1');
	define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    
	function getPDO(){
        $host = DB_HOST;
        $dbname = DB_DATABASE;
        $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");
        $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3306", DB_USER, DB_PASSWORD, $dbOtp);
        return $pdoObj;
    }

	function addCarrera($nombre){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("INSERT INTO carrera (nombre) VALUES (:nombre)");
		$stmt->bindParam(':nombre', $nombre);
		$stmt->execute();
    }
    
	function addTutor($nombre,$carrera){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("INSERT INTO tutor (nombre,carrera) VALUES (:nombre,:carrera)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':carrera', $carrera);
		$stmt->execute();
    }

    function addAlumno($id,$nombre,$carrera,$tutor){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("INSERT INTO alumno (matricula,nombre,carrera,tutor) VALUES (:matricula,:nombre,:carrera,:tutor)");
        $stmt->bindParam(':matricula', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':carrera', $carrera);
        $stmt->bindParam(':tutor', $tutor);
		$stmt->execute();
    }

    function selectAllFromTable($tabla){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM ".$tabla);
        $stmt->execute();
        return $stmt;
    }
?>