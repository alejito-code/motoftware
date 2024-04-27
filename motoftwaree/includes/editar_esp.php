<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

	if($varsesion== null || $varsesion= ''){
     header("Location: _sesion/login.php");
	
	}


////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$id = $_GET['id'];
include "db.php";
$consulta = "SELECT * FROM servicio WHERE id = $id";
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
    <title>Registros</title>


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
                     
                            <h3 class="text-center">Editar registro de <?php echo $usuario ['nombre']; ?></h3>
                            <br>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Actualizar codigo</label>
                                <input type="number"  id="codigo" name="codigo" class="form-control" value="<?php echo $usuario ['codigo']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Actualizar nombre</label>
                                <input type="text"  id="nombre" name="nombre" class="form-control" value="<?php echo $usuario ['nombre']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nuevo precio</label>
                                <input type="text"  id="precio" name="precio" class="form-control" value="<?php echo $usuario ['precio']; ?>">
                            </div>

                        
                            <input type="hidden" name="accion" value="editar_esp">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                               <br>
                                <div class="mb-3">
                                    
                                <button type="submit" id="form" name="form" class="btn btn-success" >Editar</button>
                               <a href="../views/servicios.php" class="btn btn-danger">Cancelar</a>
                               
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
    <?php  include_once "footer.php"; ?>
</body>
</html>