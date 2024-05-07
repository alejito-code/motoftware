<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];
	if($varsesion== null || $varsesion= ''){

	    header("Location:_sesion/login.php");
	
	}

	$id = $_GET['id_diag'];
	include "db.php";
	$query = mysqli_query($conexion,"DELETE FROM diagnostico WHERE id_diag = '$id'");
	
	header ('Location: ../views/citas copy.php?m=1');

?>
