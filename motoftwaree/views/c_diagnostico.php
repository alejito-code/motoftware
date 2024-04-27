<?php
// Seguridad de sesiones
session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location: ../includes/_sesion/login.php");
    die();
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />   

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Cita mantenimiento</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!--     Fonts and icons     -->
        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

        <!-- CSS Files -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <link href="../css/registrar.css" rel="stylesheet" />
    </head>
    <?php include "../includes/header.php"; ?>
    <body class="page-top">
        <!--   Big container   -->
        <div class="container1">   
            <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                <!--      Wizard container        -->
                <div class="wizard-container" >

                    <div class="card wizard-card" data-color="red" id="wizardProfile">
                        <form action="guardar.php" method="POST">
                    <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "orange"          -->

                            <div class="wizard-header">
                                <h3>
                                <b>AGENDAR CITA PARA DIAGNOSTICO<br>
                                </h3>
                            </div>

                            <div class="wizard-navigation">
                                <ul>
                                    <li><a href="#about" data-toggle="tab">Test</a></li>
                                    <li><a href="#account" data-toggle="tab" >Datos de reserva</a></li>
                                    <li><a href="#dates" data-toggle="tab" >Datos personales</a></li>
                                </ul>

                            </div>

                            <div class="tab-content" >
                                <div class="tab-pane" id="about">
                                    <h4 class="info-text"> Preguntas para el diagnostico </h4>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="form-group">
                                            <label for="p1">¿La moto enciende?</label><br>
                                            <input name="r1" type="radio"> Si <br>
                                            <input name="r1" type="radio"> No
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="p2">Al abrir la llave ¿el tablero se enciende?</label><br>
                                            <input name="r2" type="radio"> Si <br>
                                            <input name="r2" type="radio"> No
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="p3">¿La moto enciende?</label><br>
                                            <input name="r3" type="radio"> Si <br>
                                            <input name="r3" type="radio"> No
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="p4">¿La moto enciende?</label><br>
                                            <input name="r4" type="radio"> Si <br>
                                            <input name="r4" type="radio"> No
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="p5">¿La moto enciende?</label><br>
                                            <input name="r5" type="radio"> Si <br>
                                            <input name="r5" type="radio"> No
                                            
                                        </div>
                                        

                                    </div>                            
                                </div>
                                </div>
                                <div class="tab-pane" id="account">
                                    <h4 class="info-text">Datos de reserva</h4>
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                        <div class="form-group">
                                            <label>Vehiculo</label>
                                            <select name="t_mantenimiento" id="" class="form-control">
                                                <option value="0" selected>--Selecciona tu vehiculo--</option>
                                                <option value="1">MT09 SP</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha" class="form-label">Fecha</label>
                                            <input type="date" id="fecha" name="fecha" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="hora" class="form-label">Hora*</label>
                                            <select name="hora" id="" class="form-control" >
                                                <option value="0">--Seleccionar una hora--</option>
                                                <option value="1">8:00 AM</option>
                                                <option value="3">8:30 Am</option>
                                                <option value="4">9:00 Am</option>
                                                <option value="5">9:30 Am</option>
                                                <option value="6">10:00 Am</option>
                                                <option value="7">10:30 Am</option>
                                                <option value="8">11:00 Am</option>
                                                <option value="9">11:30 Am</option>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <label>Mecanico</label>
                                            <select class="form-control" id="id_mecanico" name="id_mecanico">
                                                <option value="0">--Selecciona una opcion--</option>
                                                <?php

                                                include("db.php");
                                                //Codigo para mostrar categorias desde otra tabla
                                                $sql = "SELECT * FROM mecanico ";
                                                $resultado = mysqli_query($conexion, $sql);
                                                while ($consulta = mysqli_fetch_array($resultado)) {
                                                    echo '<option value="' . $consulta['id'] . '">' . $consulta['nombres'] . '</option>';
                                                }

                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Observacion</label>
                                            <textarea name="Observasion" id="" cols="30" rows="10" class="form-control" placeholder="De una breve descripcion del mantenimiento deseado"></textarea>
                                        </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="dates">
                                    <h4 class="info-text">Datos personales</h4>
                                    <div class="row">
                                        
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="form-group">
                                            <input name="documento" type="text" class="form-control" placeholder="N° Documento">
                                            </div>
                                            <div class="form-group">
                                            <input name="nombre" type="text" class="form-control" placeholder="Nombre">           
                                            </div>  
                                            <div class="form-group">
                                            <input name="apellido" type="text" class="form-control" placeholder="Apellido">
                                            </div>
                                            <div class="form-group">
                                            <input name="telefono" type="text" class="form-control" placeholder="Telefono">
                                            </div>
                                            <div class="form-group">
                                            <input name="direccion" type="text" class="form-control" placeholder="Direccion">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                               
                            </div>
                            <div class="wizard-footer height-wizard">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Siguiente' style="background-color:#A02719; border: none;">
                                    <button type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm'  value='Registar' style="background-color:#A02719; border: none;">AGENDAR CITA</button>
                                </div>

                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Anterior' style="background-color:#A02719; border: none;">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                
                        </form>
                    </div>
                </div> <!-- wizard container -->
            </div>
            </div><!-- end row -->
        </div> <!--  big container -->
        <?php include "../includes/footer.php"; ?>
        <?php include "../includes/form_cita.php"; ?>
    </body>

	<!--   Core JS Files   -->
	<script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/jquery.bootstrap.wizard.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="js/gsdk-bootstrap-wizard.js"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="js/jquery.validate.min.js"></script>

</html>					