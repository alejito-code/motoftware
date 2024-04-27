<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];
$id_us = $_SESSION['id'];
if($varsesion == null || $varsesion == '') {
    header("Location: _sesion/login.php");
}

$id = $_GET['id'];
echo "ID a eliminar: " . $id; // Mensaje de depuración para verificar el ID que se está recibiendo

include "db.php";
$query = mysqli_query($conexion, "DELETE FROM servicio WHERE id = '$id'");
if($query) {
    echo "Registro eliminado correctamente"; // Mensaje de depuración para verificar si la consulta se ejecutó correctamente
} else {
    echo "Error al eliminar el registro: " . mysqli_error($conexion); // Mensaje de depuración en caso de error
}

header ('Location: ../views/servicios.php?m=1');
?>
