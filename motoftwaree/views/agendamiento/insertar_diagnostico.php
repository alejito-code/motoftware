<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['rol'];
$id_us = $_SESSION['id'];
if ($varsesion == null || $varsesion == '') {
    header("Location: ../../includes/_sesion/index.html");
    die();
}

// Incluir el archivo de conexión a la base de datos
include("../../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar errores de carga de archivos
    if ($_FILES['archivo_pdf']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error al cargar el archivo. Código de error: " . $_FILES['archivo_pdf']['error'] . "');
        window.location.href = '../../views/selec_cita.php';</script>";
        die();
    }

    // Obtener los datos del formulario de manera segura
    $placa = mysqli_real_escape_string($conexion, $_POST['placa']);
    $mecanico = mysqli_real_escape_string($conexion, $_POST['mecanico']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['start']); // Suponiendo que 'start' es el nombre de tu campo de fecha en el formulario

    // Verificar que la fecha se haya obtenido correctamente
    if (empty($fecha)) {
        echo "<script>alert('Error: la fecha no se ha recibido correctamente');
        window.location.href = '../../views/selec_cita.php';</script>";
        die();
    }

    // Procesar el archivo PDF
    $nombre_archivo = $_FILES['archivo_pdf']['name'];
    $tipo_archivo = $_FILES['archivo_pdf']['type'];
    $tamaño_archivo = $_FILES['archivo_pdf']['size'];
    $temp_archivo = $_FILES['archivo_pdf']['tmp_name'];

    // Leer el contenido del archivo y convertirlo a Base64
    $observacion = mysqli_real_escape_string($conexion, base64_encode(file_get_contents($temp_archivo)));

    // Preparar la consulta SQL para insertar en la tabla 'diagnostico'
    $sql_insert = "INSERT INTO diagnostico (id_user, id_moto, id_mec, fecha, observacion) VALUES (?, ?, ?, ?, ?)";

    // Crear una consulta preparada
    $stmt = mysqli_stmt_init($conexion);
    if (mysqli_stmt_prepare($stmt, $sql_insert)) {
        // Vincular parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "iiiis", $id_us, $placa, $mecanico, $fecha, $observacion);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Cita agendada correctamente en la base de datos');
            window.location.href = '../../views/selec_cita.php';</script>";
        } else {
            echo "<script>alert('Error al agendar la cita en la base de datos: " . mysqli_error($conexion) . "');
            window.location.href = '../../views/selec_cita.php';</script>";
        }
    } else {
        echo "<script>alert('Error en la preparación de la consulta: " . mysqli_stmt_error($stmt) . "');
        window.location.href = '../../views/selec_cita.php';</script>";
    }

    // Cerrar la consulta preparada y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
