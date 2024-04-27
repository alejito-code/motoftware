<?php

require_once("db.php");




if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
            //casos de registros

        case 'acceso_user';
            acceso_user();
            break;

        case 'insert_mec':
            insert_mec();
            break;

        case 'insert_cita':
            insert_cita();
            break;

        case 'insert_esp':
            insert_esp();
            break;
        
        case 'insert_moto':
            insert_moto();
            break;

        case 'insert_horario':
            insert_horario();
            break;

        case 'insert_paciente':
            insert_paciente();
            break;

        case 'editar_user':
            editar_user();
            break;

        case 'editar_paciente':
            editar_paciente();
            break;

        case 'editar_esp':
            editar_esp();
            break;

        case 'editar_moto':
            editar_moto();
            break;

        case 'editar_mec':
            editar_mec();
            break;


        case 'editar_hora':
            editar_hora();
            break;

        case 'editar_cita':
            editar_cita();
            break;
    }
}


function acceso_user()
{
    include("db.php");
    extract($_POST);

    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $password = $conexion->real_escape_string($_POST['password']);
    // Consulta SQL para obtener el rol del usuario basado en el nombre de usuario
    $consulta = "SELECT rol FROM `user` WHERE nombre = '$nombre'";

    $resultado = mysqli_query($conexion, $consulta);

    // Verificar si se obtuvo un resultado
    if ($resultado) {


        if (mysqli_num_rows($resultado) == 1) {
            // Obtener el resultado de la fila
            $fila = mysqli_fetch_assoc($resultado);
        
            // Obtener el rol del usuario
            $rol_usuario = $fila['rol'];
        }
    }
    

    session_start();
    $_SESSION['nombre'] = $nombre;
    $_SESSION['rol'] = $rol_usuario;

    $consulta_id_usuario = "SELECT id FROM `user` WHERE nombre = '$nombre'";
    $resultado_id_usuario = mysqli_query($conexion, $consulta_id_usuario);

    if ($resultado_id_usuario && mysqli_num_rows($resultado_id_usuario) > 0) {

        $fila = mysqli_fetch_assoc($resultado_id_usuario);
        $id_usuario = $fila['id'];
    
        // Define el ID del usuario en la variable de sesión 'id'
        $_SESSION['id'] = $id_usuario;
    }

    $consulta = "SELECT*FROM user where nombre='$nombre' and password='$password'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas = mysqli_fetch_array($resultado);

    if (isset($filas['rol']) == 1) {

        header('Location: ../views/usuarios.php');


        if ($filas['rol'] == 3) { //cliente


            header('Location: ../views/index.php');
        }
    } else {


        echo "<script language='JavaScript'>
        alert('Usuario o Contraseña Incorrecta');
        location.assign('./_sesion/index.html');
        </script>";
        session_destroy();
    }
}


function insert_esp()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO servicio (codigo, nombre, precio) VALUES ('$codigo', '$nombre', '$precio')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El servicio se ha agregado un nuevo servicio exitosamente');
        location.assign('../views/servicios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ha ocurrido un error, intentalo de nuevo');
         location.assign('../views/servicios.php');
         </script>";
    }
}

function insert_moto()
{
    include "db.php";

    if(isset($_SESSION['id'])) {
        // Obtiene el ID del usuario desde la variable de sesión 'id'
        $id = $_SESSION['id'];
    }

    extract($_POST);

    $consulta = "INSERT INTO moto (placa, marca, modelo, cilindraje, tipo, id_user) VALUES ('$placa', '$marca', '$modelo', '$cilindraje', '$tipo', '$id')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El vehiculo fue registrado exitosamente');
        location.assign('../views/moto.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ha ocurrido un error, intenta de nuevo');
         location.assign('../views/moto.php');
         </script>";
    }
}

function insert_horario()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO horario (hora) VALUES ('$hora')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('Horario agregado exitosamente');
        location.assign('../views/horarios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! algo ha salido mal');
         location.assign('../views/horarios.php');
         </script>";
    }
}

function insert_paciente()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO pacientes (nombre, sexo, correo, telefono,  estado)
    VALUES ('$nombre', '$sexo', '$correo', '$telefono',  '$estado')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/pacientes.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/pacientes.php');
         </script>";
    }
}

function insert_cita()
{
    include "db.php";

    // Recoger datos del formulario
    extract($_POST);

    if ($_POST['fallaelectrica'] != 0) {
        $falla = $_POST['fallaelectrica'];
    } elseif ($_POST['fallamecanica'] != 0) {
        $falla = $_POST['fallamecanica'];
    } elseif ($_POST['mantenimiento'] != 0) {
        $falla = $_POST['mantenimiento'];
    } else {
        $falla = "No seleccionada";
    }

    echo "Valor de 'id': " . $_POST['id_us'];
    echo "Valor de 'placa': " . $_POST['placa'];
    echo "Valor de 'mec': " . $_POST['mecanico'];
    echo "Valor de 'falla': " . $falla;
    echo "Valor de 'hora': " . $_POST['hora'];
    echo "Valor de 'fecha': " . $_POST['fecha'];
    echo "Valor de 'obser': " . $_POST['observacion'];

    // Construir la consulta SQL
    $consulta = "INSERT INTO citas (id_user, id_moto, id_mec, id_serv, id_hora, fecha, observacion) 
    VALUES ('$id_us', '$placa', '$mecanico', '$falla', '$hora', '$fecha', '$observacion')";

    echo $consulta;
    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('Cita agendada exitosamente');
        location.assign('../views/selec_cita.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ha sucedido un error, intenta de nuevo');
         location.assign('../includes/functions.php');
         </script>";
    }
}


function insert_mec()
{
    include "db.php";
    extract($_POST);
    $consulta = "INSERT INTO mecanico (cedula, nombres, apellido, sexo,  telefono, fecha, correo)
    VALUES ('$cedula', '$nombres', '$apellido','$sexo', '$telefono',  '$fecha', '$correo')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/mecanicos.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/mecanicos.php');
         </script>";
    }
}


function editar_user()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE user SET nombre = '$nombre', correo = '$correo', telefono = '$telefono', password = '$password',
     rol ='$rol' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/usuarios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/usuarios.php');
         </script>";
    }
}

function editar_paciente()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE pacientes SET nombre = '$nombre', sexo = '$sexo', correo = '$correo', 
    telefono = '$telefono', estado ='$estado' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/pacientes.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/pacientes.php');
         </script>";
    }
}

function editar_esp()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE servicio SET codigo = '$codigo', nombre = '$nombre', precio = '$precio' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/servicios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/servicios.php');
         </script>";
    }
}

function editar_moto()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE moto SET placa = '$placa', marca = '$marca', modelo = '$modelo',  cilindraje = '$cilindraje',
    tipo = '$tipo', id_user = '$id_us' WHERE id = '$id' ";
    echo $consulta;
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error: " . mysqli_error($conexion);
    }

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/moto.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/moto.php');
         </script>";
    }
}

function editar_mec()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE mecanico SET cedula = '$cedula', nombres = '$nombres', apellido = '$apellido',  sexo = '$sexo',
    telefono = '$telefono', fecha = '$fecha',  correo = '$correo' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/mecanicos.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/mecanicos.php');
         </script>";
    }
}

function editar_hora()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE horario SET dias = '$dias', id_doctor = '$id_doctor' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/horarios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/horarios.php');
         </script>";
    }
}

function editar_cita()
{
    include "db.php";
    extract($_POST);

    $consulta = "UPDATE citas SET fecha = '$fecha', hora = '$hora', id_moto = '$id_moto', id_mec = '$id_mec',
    id_serv = '$id_serv', observacion = '$observacion' 
    WHERE id_user = '$id_us' AND id_cita = '$id'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('El registro fue actualizado correctamente');
        location.assign('../views/citas.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/citas.php');
         </script>";
    }
}
