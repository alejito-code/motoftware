<?php
// Seguridad de sesiones
session_start();
error_reporting(0);
$varsesion = $_SESSION['rol'];
$id_us = $_SESSION['id'];
	if($varsesion== null || $varsesion= ''){

	    header("Location: ../includes/_sesion/index.html");
	die();
	} 


include '../includes/header.php';

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
        <h1>Bienvenido <?php echo $_SESSION['nombre']; ?> a MOTOFTWARE</h1> 
        <br>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel de Usuario</h1>
</div>

<?php 
    if( $actualsesion == 1){
?>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="citas.php" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Numero de citas</a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                               include "../includes/db.php"; 
    
                                $SQL="SELECT id_cita FROM citas ORDER BY id_cita";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?>
                                
                            </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        };
    ?> 
    
    <?php 
        if( $actualsesion == 3){
    ?>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="//localhost/motoftware_final/motoftwaree/views/citas.php" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Numero de citas</a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                               include "../includes/db.php"; 
    
                                $SQL="SELECT c.id_cita FROM citas c INNER JOIN user u ON c.id_user = u.id WHERE u.id = $id_us";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?>

                        </div>
                    </div>
                    <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        };
    ?> 

    <?php 
        if( $actualsesion == 1){
    ?>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="pacientes.php" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Numero de clientes</a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                               include "../includes/db.php"; 
    
                                $SQL="SELECT rol FROM user WHERE rol = 3";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?>

                        </div>
                    </div>
                    <div class="col-auto">
                    <i class="fa-solid fa fa-male fa-2x text-gray-300" aria-hidden="true"></i>     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        };
    ?>  

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="medicos.php" class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Numero de Mecanicos </a>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php 
                               include "../includes/db.php"; 
    
                                $SQL="SELECT id FROM mecanico ORDER BY id";
                                $dato = mysqli_query($conexion, $SQL);
                                $fila= mysqli_num_rows($dato);
    
                                echo($fila); ?>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-tools fa-2x text-gray-300" aria-hidden="true"></i></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php 
        if( $actualsesion == 1){
    ?>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                           Numero de Usuarios</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                include "../includes/db.php"; 
        
                                    $SQL="SELECT id FROM user ORDER BY id";
                                    $dato = mysqli_query($conexion, $SQL);
                                    $fila= mysqli_num_rows($dato);
        
                                    echo($fila); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                        <i class="fa fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        };
    ?>  
</div>
<div class="colum">
    <?php 
        if( $actualsesion != 1){
    ?>
    <div id="agendar" class="row align-items-center"> 
        <div class="col-xl-3 col-md-2 mb-6">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#doctor">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="h5 mb-0 font-weight-bold text-white-800">          
                            <a href="./selec_cita.php"><span class="glyphicon glyphicon-plus"></span> Agendar cita 
                            <i class="fa fa-sticky-note" aria-hidden="true"></i></a>          
                        </div>
                    </div>
                </div>
            </button>
        </div>

        <div id="agendar" class="col-xl-3 col-md-2 mb-6">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#moto" style="background-color: gray; border: none">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="h5 mb-0 font-weight-bold text-white-800">          
                            <span class="glyphicon glyphicon-plus"></span> Agregar moto
                            <i class="fas fa-motorcycle" aria-hidden="true"></i>          
                        </div>
                    </div>
                </div>
            </button>
        </div>
        <style>
            #agendar{
                justify-content: center;
                margin-bottom: 30px;
                margin-top:30px;
            }
            .btn btn-success:hover {
                color: #858796;
                text-decoration: none;
            }
        </style>
    </div>
    <?php
        };
    ?> 
</div>    
    <!-- End of Page Wrapper -->  

<?php include '../includes/footer.php'; ?>
<?php include "../includes/form_moto.php"; ?>
</html>

