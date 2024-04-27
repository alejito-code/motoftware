<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['rol'];
$id_us = $_SESSION['id'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:_sesion/login.php");
		exit();
	}

	$id = $_GET['id'];
	include "db.php";

	
	echo "Consulta SQL: DELETE FROM moto WHERE id = '$id' AND (id_user = $id_us OR id_user = $actualsesion)";
	$query = mysqli_query($conexion,"DELETE FROM moto WHERE id = '$id'");
	echo $query;
	
	if ($query) {
		// Redirigir a una página de éxito
		header ('Location: ../views/moto.php?m=1');
		exit();
	} else {
		// Mostrar un mensaje de error
		echo "Error al intentar eliminar el registro.".mysqli_error($conexion);	
		
	}

?>