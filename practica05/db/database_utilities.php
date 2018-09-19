<?php
	require_once('database_credentials.php');

	//Se realiza la conexion a la base de datos, utilizando las constantes definidas en database_credentials.php
	function getPDO(){//Una instancia de PDO necesaria para la conexión con la Base de Datos
        $host = DB_HOST; //El host
        $dbname = DB_DATABASE; //El nombre de la base de datos
        $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");// Habilitar el utf8 
        $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3307", DB_USER, DB_PASSWORD, $dbOtp); //Se crea la instancia
        return $pdoObj;// Y se regresa
    }

	//Funcion que permite agregar un nuevo usuario a la base de datos, requiere nombre y correo.
	function add($id,$nombre,$posicion,$carrera,$correo,$tipo){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("INSERT INTO sport_team (id,nombre,posicion,carrera,email,id_type) 
								VALUES (:id,:nombre,:posicion,:carrera,:correo,:id_type)");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':posicion', $posicion);
		$stmt->bindParam(':carrera', $carrera);
		$stmt->bindParam(':correo', $correo);
		$stmt->bindParam(':id_type', $tipo);
		$stmt->execute();
	}

	//Funcion que permite actualizar los atributos de un usuario existente, requiere nombre, correo y su id.
	function update($id,$nombre,$posicion,$carrera,$correo,$tipo,$idAc){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("UPDATE sport_team SET id=:id,nombre=:nombre,posicion=:posicion,carrera=:carrera,email=:email,id_type=:tipo where id=:idAc");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':nombre', $nombre);
		$stmt->bindParam(':posicion', $posicion);
		$stmt->bindParam(':carrera', $carrera);
		$stmt->bindParam(':email', $correo);
		$stmt->bindParam(':tipo', $tipo);
		$stmt->bindParam(':idAc', $idAc);
		$stmt->execute();
	}

	//Funcion que permite eliminar un usuario de la base de datos utilizando su id.
	function delete($id){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("DELETE FROM sport_team where id=:id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}

	//Funcion que permite realizar una busqueda de un usuario para obtener todos sus atributos mediante su id.
	function search($id){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM sport_team where id=:id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		if($r = $stmt->fetch(PDO::FETCH_ASSOC))
			return $r;
		return [];
	}

	//Funcion que permite obtener todos los registros encontrados en la tabla usuarios de la base de datos.
	function getAll($num){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM sport_team WHERE id_type=:num");
		$stmt->bindParam(':num', $num);
		$stmt->execute();
		if($stmt->rowCount())
			return $stmt;
		return [];
	}

	//Funcion que obtiene la cantidad de registros encontrados en la tabla 'user' de la base de datos.
	function count_users(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//Funcion que obtiene la cantidad de registros encontrados en la tabla 'user_type' de la base de datos.
	function count_types(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user_type");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//Funcion que obtiene la cantidad de registros encontrados en la tabla 'status' de la base de datos.
	function count_status(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM status");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
		
	}

	//Funcion que obtiene la cantidad de registros encontrados en la tabla 'user_log' de la base de datos.
	function count_access(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user_log");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
		
	}

	//Funcion que obtiene la cantidad de usuarios activos.
	function count_active(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user WHERE status_id = 1");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//Funcion que obtiene la cantidad de usuarios inactivos.
	function count_inactive(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user WHERE status_id = 2");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//Función que regresa una tabla de la base de datos
	function selectAllFromTable($tabla){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM ".$tabla);
		echo ("<script>console.log( '" . $tabla . "' );</script>");
		$stmt->execute();
		return $stmt;
	}
?>