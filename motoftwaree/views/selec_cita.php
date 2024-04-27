<?php
// Seguridad de sesiones
session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];

if ($varsesion == null || $varsesion = '') {

    header("Location: ../includes/_sesion/index.html");
    die();
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Agendar cita</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link rel="stylesheet" href="../css/stilo.css">
    </head>
    <?php include "../includes/header.php"; ?>
    <body id="page-top">
        <div class="container-fluid">    
            <main class="container">
                <div class="box1">
                    <div class="btn1"><button type="button" class="butto1"><a href="./cdiagnostico/form_diagnostico/templates/formulario.html">Diagnosticar</a><i id="icons" class="fas fa-file-medical-alt"></i></button></i></i></div>
                    <div class="btn1"><button type="button" class="butto1"><a href="./agendamiento/cita.php">Agendar cita</a><i id="icons" class="fas fa-screwdriver"></i></button></div>
                </div>
            </main>
        </div>

        <?php include "../includes/footer.php"; ?>


    </body>
</html>
