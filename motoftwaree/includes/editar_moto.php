<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['rol'];
$id_us = $_SESSION['id'];


	if($varsesion== null || $varsesion= ''){
     header("Location: _sesion/login.php");
	
	}


////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$id = $_GET['id'];
include "db.php";
$consulta = "SELECT m.id, m.placa, m.marca, m.modelo, m.cilindraje, m.tipo, u.id FROM moto m INNER JOIN user u ON m.id_user = u.id WHERE u.id = $id_us AND m.id 

 = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);
?>
<?php include_once "header.php"; ?>


<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esditar moto</title>


    <link rel="stylesheet" href="../../css/fontawesome-all.min.css">
	<link rel="stylesheet" href="../../css/2.css">
	<link rel="stylesheet" href="../../css/estilo.css">
</head>

<body>



    <form  action="functions.php" id="form" method="POST">

        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                     
                            <h3 class="text-center">Editar registro de la placa <?php echo $usuario ['placa']; ?></h3>
                            <br>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Actualizar placa</label>
                                <input type="text"  id="placa" name="placa" class="form-control" value="<?php echo $usuario ['placa']; ?>" onkeyup="mayuscula(this);">
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Actualizar marca</label>
                                <input type="text"  id="marca" name="marca" class="form-control" value="<?php echo $usuario ['marca']; ?>" onkeyup="mayuscula(this);">
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Actualizar modelo</label>
                                <input type="year"  id="modelo" name="modelo" class="form-control" value="<?php echo $usuario ['modelo']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Actualizar cilindraje</label>
                                <input type="number"  id="cilindraje" name="cilindraje" class="form-control" value="<?php echo $usuario ['cilindraje']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Actualizar tipo</label>
                                <input type="text"  id="tipo" name="tipo" class="form-control" value="<?php echo $usuario ['tipo']; ?>" onkeyup="mayuscula(this);">
                            </div>

                        
                            <input type="hidden" name="accion" value="editar_moto">
                                <input type="hidden" name="id_us" value="<?php echo $id_us;?>">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                               <br>
                                <div class="mb-3">
                                    
                                <button type="submit" id="form" name="form" class="btn btn-success" >Editar</button>
                               <a href="../views/moto.php" class="btn btn-danger">Cancelar</a>
                               
                            </div>
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script src="../js/mayus.js"></script>
    <?php  include_once "footer.php"; ?>
</body>
</html>