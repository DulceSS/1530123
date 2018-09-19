<?php
	require_once('database.php');

	//Se realiza la conexion a la base de datos, utilizando las constantes definidas en database_credentials.php
	function getPDO(){//PDO
        $host = DB_HOST; //host
        $dbname = DB_DATABASE; //Base de datos
        $dbOtp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");// Habilitar el utf8 
        $pdoObj = new PDO("mysql:host={$host};dbname={$dbname};port=3307", DB_USER, DB_PASSWORD, $dbOtp); //Se crea la instancia
        return $pdoObj;
    }

	//Agrega registro
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

	//Realiza actualizacion
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

	//Elimina registro
	function delete($id){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("DELETE FROM sport_team where id=:id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}

	//Busca registro de acuerdo al id
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

	//Consulta de todos los registros.
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

	//funcion para leer registros de tabla user y contar la cantidad.
	function count_users(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//leer registros de la tabla y regresar cantidad .
	function count_types(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user_type");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//leer registros de la tabla y regresar cantidad
	function count_status(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM status");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
		
	}

	//leer registros de la tabla y regresar cantidad
	function count_access(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user_log");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
		
	}

	//leer registros de la tabla y regresar cantidad de estado activo
	function count_active(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user WHERE status_id = 1");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//leer registros de la tabla y regresar cantidad de estado inactivo
	function count_inactive(){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM user WHERE status_id = 2");
		$stmt -> execute();
		$r = $stmt->rowCount();
		return $r;
	}

	//regresa tabla a la BD
	function selectAllFromTable($tabla){
		global $db;
		$db = getPDO();
		$stmt = $db->prepare("SELECT * FROM ".$tabla);
		echo ("<script>console.log( '" . $tabla . "' );</script>");
		$stmt->execute();
		return $stmt;
	}
?>