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
    </head>
    <?php include "../includes/header.php"; ?>
    <body id="page-top">
        <header>
            <!-- place navbar here -->
        </header>
        <main>
        <div class="box_cita">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h3 class="modal-title" id="exampleModalLabel">Agregar nueva cita<?php echo $fila['nombre']; ?>
                            </h3>
                            <button type="button" class="btn btn-black" data-dismiss="modal">
                                <i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                        <div class="modal-body">

                            <form action="../includes/functions.php" method="POST">
                                <div class="form-group">
                                    <label for="fecha" class="form-label">Fecha*</label>
                                    <input type="date" id="fecha" name="fecha" class="form-control" required>
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
                                    <select class="form-control" id="id_doctor" name="id_doctor">
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


                                <div class="form-group ">
                                    <label>Motivo de reserva</label>
                                    <select class="form-control" id="id_especialidad" name="id_especialidad">
                                        <option value="0">--Selecciona una opcion--</option>
                                        <?php

                                        include("db.php");
                                        //Codigo para mostrar categorias desde otra tabla
                                        $sql = "SELECT * FROM especialidades ";
                                        $resultado = mysqli_query($conexion, $sql);
                                        while ($consulta = mysqli_fetch_array($resultado)) {
                                            echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                                        }

                                        ?>


                                    </select>
                                </div>

                                <label for="observacion">Observacion:</label>
                                <input class="form-control" name="observacion" required type="text" id="observacion" placeholder="Escribe una observacion del paciente">


                                <div class="form-group">
                                    <label for="pendiente" class="form-label">Estado:</label>
                                    <select name="estado" id="estado" class="form-control" required>
                                        <option value="">--Selecciona una opcion--</option>
                                        <option value="1">Atendido</option>
                                        <option value="2">Pendiente</option>
                                    </select>
                                </div>


                                <input type="hidden" name="accion" value="insert_cita">
                                <br>

                                <div class="mb-3">

                                    <input type="submit" value="Guardar" id="register" class="btn btn-success" name="registrar">
                                    <a href="citas.php" class="btn btn-danger">Cancelar</a>

                                </div>
                        </div>
                    </div>
                    </form>
        </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
