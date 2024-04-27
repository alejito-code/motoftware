<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];
	if($varsesion== null || $varsesion= ''){

	    header("Location:_sesion/login.php");
	
	}

	$id = $_GET['id_cita'];
	include "db.php";
	$query = mysqli_query($conexion,"DELETE FROM citas WHERE id_cita = '$id'");
	
	header ('Location: ../views/citas.php?m=1');

?>
