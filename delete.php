<?php
	include_once('db/database2.php');

	//Elimina de acuerdo al registro seleccionado con la id correspondiente
	if(isset($_GET['id'])){
		delete($_GET['id']);
		header("location: sistema_equipos.php");
	}

?>