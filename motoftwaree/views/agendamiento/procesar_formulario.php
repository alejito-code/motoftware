<?php

include '../../includes/db.php';

if(isset($_SESSION['id'])) {
    // Obtiene el ID del usuario desde la variable de sesión 'id'
    $id_us = $_SESSION['id'];
}
















// // Verificar si la variable $conexion está definida
// if(!isset($conexion)) {
//     $conexion = mysqli_connect("localhost", "root", " ", "motoft");
// }

// $placa = filter_var($_POST["placa"], FILTER_SANITIZE_NUMBER_INT);
// $tipoFalla = filter_var($_POST["falla"], FILTER_SANITIZE_NUMBER_INT);
// $mecanico = filter_var($_POST["mecanico"], FILTER_SANITIZE_NUMBER_INT);
// $fecha = filter_var($_POST["fecha"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// $timestamp = strtotime($fecha);
// $fecha_formateada = date('Y-m-d', $timestamp);
// $hora = filter_var($_POST["hora"], FILTER_SANITIZE_STRING);
// $observacion = filter_var($_POST["observacion"], FILTER_SANITIZE_STRING);

// // Revisa que las entradas de datos sean de tipo correcto
// $id_us = intval($id_us);
// $placa = intval($placa);
// $tipoFalla = intval($tipoFalla);
// $mecanico = intval($mecanico);
// $fecha = mysqli_real_escape_string($conexion, sanitize_input($fecha_formateada));
// $hora = mysqli_real_escape_string($conexion, sanitize_input($hora));
// $observacion = mysqli_real_escape_string($conexion, sanitize_input($observacion));

// // Definir tipos de parámetros
// $types = "issssss";

// $sql = "INSERT INTO citas (id_user, placa, mecanico, tipo_falla, hora, fecha, observacion) VALUES (?,?,?,?,?,?,?)";

// $stmt = mysqli_prepare($conexion, $sql);

// // Vincula los parámetros pero con la información de tipo correcta y sanitizada
// mysqli_stmt_bind_param($stmt, $types, $id_us, $placa, $mecanico, $tipoFalla, $hora, $fecha_formateada, $observacion);

// if (mysqli_stmt_execute($stmt)) {
//     echo json_encode(array('success' => true, 'mensaje' => 'Datos insertados correctamente en la tabla citas.'));
// } else {
//     echo json_encode(array('success' => false, 'mensaje' => 'Error al insertar datos: '. mysqli_error($conexion)));
// }

// mysqli_stmt_close($stmt);
// mysqli_close($conexion);

// function sanitize_input($data)
// {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }

?>
