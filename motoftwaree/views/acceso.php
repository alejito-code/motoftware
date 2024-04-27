<?php 
error_reporting(0);
session_start();
$actualsesion = $_SESSION['rol'];

if($actualsesion == null || $actualsesion != 1){
    header("Location: ../includes/_sesion/index.html");
	die();

}


echo "<script language='JavaScript'>
alert('Necesitamos validar que eres Administrador para acceder a esta vista!!Vuelve a Iniciar Sesion');
location.assign('../includes/_sesion/cerrarSesion.php');
</script>"

?>