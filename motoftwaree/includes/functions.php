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
            insert_cita($start);
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
            editar_cita($start);
            break;
        
        case 'editar_diagnostico':
            editar_diagnostico($start);
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

    $pass=sha1($password);

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

    $consulta = "SELECT*FROM user where nombre='$nombre' and password='$pass'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas = mysqli_fetch_array($resultado);

    if (isset($filas['rol']) == 1) {

        header('Location: ../views/usuarios.php');


        if ($filas['rol'] == 3) { //cliente


            header('Location: ../views/index.php');
        }
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Usuario o Contraseña Incorrecta',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = './_sesion/index.html';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}


function insert_esp()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO servicio (codigo, nombre, precio) VALUES ('$codigo', '$nombre', '$precio')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El servicio se ha agregado exitosamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/servicios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/servicios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
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
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El vehiculo fue registrado exitosamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/moto.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/moto.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}

function insert_horario()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO horario (dias, id_doctor) VALUES ('$dias', '$id_doctor')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/horarios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/horarios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
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
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/pacientes.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/pacientes.php'';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}

function insert_cita($start)
{
    var_dump($_POST);
    include "db.php";
   
    // Recoger datos del formulario
    extract($_POST);

    $placa = $_POST['placa'];
    $mecanico = $_POST['mecanico'];
    $fecha = $_POST['fecha']; // valor de la fecha y hora seleccionada en formato ISO 8601
    $observacion = $_POST['observacion'];

    // Obtener el tipo de falla seleccionado

    $start = $start;
    echo "Valor de 'id': " . $_POST['id_us'];
    echo "Valor de 'placa': " . $_POST['placa'];
    echo "Valor de 'mec': " . $_POST['mecanico'];
    echo "Valor de 'falla': " . $falla;
    echo "Valor de 'fecha': " . $_POST['fecha'];
    echo "Valor de 'obser': " . $_POST['observacion'];

    // Construir la consulta SQL
    $consulta = "INSERT INTO citas (id_user, id_moto, id_mec, id_serv, fecha, observacion) 
    VALUES ('$id_us', '$placa', '$mecanico', '$falla', '$fecha', '$observacion')";

    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'Cita agendada super bien',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/selec_cita.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/selec_cita.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
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
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/mecanicos.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/mecanicos.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit(); 
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
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/usuarios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/usuarios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
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
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/pacientes.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/pacientes.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}

function editar_esp()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE servicio SET codigo = '$codigo', nombre = '$nombre', precio = '$precio' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/servicios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/servicios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
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
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/moto.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/moto.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
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
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/mecanicos.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/mecanicos.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}

function editar_hora()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE horario SET dias = '$dias', id_doctor = '$id_doctor' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/horarios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/horarios.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}

function editar_cita($start)
{
    include "db.php";
    extract($_POST);

    echo "Valor de 'id': " . $_POST['id'];
    echo "Valor de 'id': " . $_POST['id_us'];
    echo "Valor de 'placa': " . $_POST['id_moto'];
    echo "Valor de 'mec': " . $_POST['id_mec'];
    echo "Valor de 'falla': " . $_POST['id_serv'];
    echo "Valor de 'fecha': " . $_POST['fecha'];
    echo "Valor de 'obser': " . $_POST['observacion'];

    $consulta = "UPDATE citas SET fecha = '$fecha', id_moto = '$id_moto', id_mec = '$id_mec',
    id_serv = '$id_serv', observacion = '$observacion' 
    WHERE id_user = '$id_us' AND id_cita = '$id'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/citas.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/citas.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}
function editar_diagnostico($start)
{
    include "db.php";
    extract($_POST);

    echo "Valor de 'id': " . $_POST['id'];
    echo "Valor de 'id': " . $_POST['id_us'];
    echo "Valor de 'placa': " . $_POST['id_moto'];
    echo "Valor de 'mec': " . $_POST['id_mec'];
    echo "Valor de 'fecha': " . $_POST['fecha'];

    $consulta = "UPDATE diagnostico SET fecha = '$fecha', id_moto = '$id_moto', id_mec = '$id_mec'
    WHERE id_user = '$id_us' AND id_diag = '$id'";

    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Bien!',
                text: 'El registro fue actualizado correctamente',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/citas.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    } else {
        echo "<script src='../package/dist/sweetalert2.min.js'></script>";
        echo "<link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>";
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Error!',
                text: 'Uy no! ha ocurrido un error, intentalo de nuevo',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#8E2317'
            }).then(function() {
                window.location.href = '../views/citas.php';
            });
            document.activeElement.blur();
        });
        </script>";
        exit();
    }
}

