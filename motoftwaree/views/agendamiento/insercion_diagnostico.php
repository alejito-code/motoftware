<?php
session_start();
error_reporting(0);
include("../../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_us = $_POST["id_us"];
    $id_moto = $_POST["placa"];
    $id_mecanico = $_POST["mecanico"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    
    // Verifica si se cargó un archivo
    if(isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == 0) {
        $archivo_tmp = $_FILES["archivo"]["tmp_name"];
        $archivo_nombre = $_FILES["archivo"]["name"];
        $archivo_tipo = $_FILES["archivo"]["type"];
        $archivo_tamanio = $_FILES["archivo"]["size"];

        // Lee el contenido del archivo en binario
        $archivo_contenido = file_get_contents($archivo_tmp);

        // Escapa el contenido para evitar problemas de SQL injection
        $archivo_contenido = mysqli_real_escape_string($conexion, $archivo_contenido);

        // Consulta SQL para insertar los datos en la tabla 'diagnostico'
        $sql = "INSERT INTO diagnostico (id_usuario, id_moto, id_mecanico, fecha, hora, archivo) 
                VALUES ('$id_us', '$id_moto', '$id_mecanico', '$fecha', '$hora', '$archivo_contenido')";

        if (mysqli_query($conexion, $sql)) {
            // Inserción exitosa
            echo "Datos insertados correctamente.";
            // Redirecciona o muestra un mensaje de éxito según tu flujo de aplicación
        } else {
            // Error en la inserción
            echo "Error al insertar datos: " . mysqli_error($conexion);
        }
    } else {
        // No se cargó ningún archivo o hubo un error al subirlo
        echo "Error al cargar el archivo.";
    }

    mysqli_close($conexion);
}
?>
