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

// Incluir la librería de SweetAlert2 solo una vez
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar errores de carga de archivos
    if ($_FILES['archivo_pdf']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al cargar el archivo. Código de error: " . $_FILES['archivo_pdf']['error'] . "'
        }).then(function() {
            window.location.href = '../../views/selec_cita.php';
        });
        </script>";
        // Redirigir después de 3 segundos
        echo "<script>setTimeout(function() {
            window.location.href = '../../views/selec_cita.php';
        }, 3000);</script>";
        die();
    }

    // Obtener los datos del formulario de manera segura
    $placa = mysqli_real_escape_string($conexion, $_POST['placa']);
    $mecanico = mysqli_real_escape_string($conexion, $_POST['mecanico']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['start']); // Se obtiene desde el campo oculto

    // Procesar el archivo PDF
    $nombre_archivo = $_FILES['archivo_pdf']['name'];
    $tipo_archivo = $_FILES['archivo_pdf']['type'];
    $tamaño_archivo = $_FILES['archivo_pdf']['size'];
    $temp_archivo = $_FILES['archivo_pdf']['tmp_name'];

    $observacion = mysqli_real_escape_string($conexion, file_get_contents($temp_archivo)); // Convertir el archivo a BLOB

    // Preparar la consulta SQL para insertar en la tabla diagnosticos
    $sql_insert = "INSERT INTO diagnostico (id_user, id_moto, id_mec, fecha, observacion) VALUES (?, ?, ?, ?, ?)";

    // Crear una consulta preparada
    $stmt = mysqli_stmt_init($conexion);
    if (mysqli_stmt_prepare($stmt, $sql_insert)) {
        // Vincular los parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "iiiis", $id_us, $placa, $mecanico, $fecha, $observacion);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Cita agendada correctamente en la base de datos'
            }).then(function() {
                window.location.href = '../../views/selec_cita.php';
            });</script>";
            // Redirigir después de 3 segundos
            echo "<script>setTimeout(function() {
                window.location.href = '../../views/selec_cita.php';
            }, 3000);</script>";
        } else {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al agendar la cita en la base de datos: " . mysqli_error($conexion) . "'
            }).then(function() {
                window.location.href = '../../views/selec_cita.php';
            });
            </script>";
            // Redirigir después de 3 segundos
            echo "<script>setTimeout(function() {
                window.location.href = '../../views/selec_cita.php';
            }, 3000);</script>";
        }
    } else {
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error en la preparación de la consulta: " . mysqli_stmt_error($stmt) . "'
        }).then(function() {
            window.location.href = '../../views/selec_cita.php';
        });
        </script>";
        // Redirigir después de 3 segundos
        echo "<script>setTimeout(function() {
            window.location.href = '../../views/selec_cita.php';
        }, 3000);</script>";
    }

    // Cerrar la consulta preparada y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>