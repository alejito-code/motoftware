<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];
$id_us = $_SESSION['id'];
if ($varsesion == null || $varsesion = '') {
    header("Location: _sesion/login.php");
}

include "db.php";
$id = $_GET['id_cita'];
$consulta = "SELECT c.id_cita, c.fecha, u.nombre AS nomu, m.placa AS plac, 
me.nombres, me.id AS idmec, s.nombre AS serv, s.codigo, m.id AS idmoto, s.id AS idserv, c.observacion FROM citas c 
INNER JOIN user u ON c.id_user = u.id 
INNER JOIN moto m ON c.id_moto = m.id
INNER JOIN servicio s ON c.id_serv = s.id
INNER JOIN mecanico me ON c.id_mec = me.id WHERE u.id = $id_us AND c.id_cita = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);
?>
<?php include_once "header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falla electrica</title>
    <link rel="shortcut icon" type="image/icon" href="../../img/tuerca (1).png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../views/agendamiento/fullcalendar/dist/index.global.js"></script>
    <script src='../package/dist/sweetalert2.min.js'></script>
    <link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>

    <style>

    #calendar {
        max-width: 500px;
        height: 380px;
        margin: 0 auto;
        padding: 5px;
        background-color: white;
        border-radius: 5px;
    }

    </style>
</head>
<body>

<form action="functions.php" id="form" method="POST">

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <h3 class="text-center">Editar Cita del Cliente <?php echo $usuario['nomu']; ?></h3>
                    <br>
                    
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <div id='calendar'></div>
                        <input type="hidden" id="start" name="start">
                    </div>


                    <div class="form-group ">
                        <label>Placa</label>
                        <select class="form-control" id="id_moto" name="id_moto">
                            <option <?php echo $usuario['plac'] === 'id_moto' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idmoto']; ?>"><?php echo $usuario['plac']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT m.id AS idmoto, m.placa AS plac , m.marca, m.modelo, m.cilindraje, m.tipo, u.nombre FROM moto m INNER JOIN user u ON m.id_user = u.id WHERE u.id = $id_us";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['idmoto'] . '">' . $consulta['plac'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>

                    <div class="form-group ">
                        <label>Mecanico</label>
                        <select class="form-control" id="id_mec" name="id_mec">
                            <option <?php echo $usuario['nombres'] === 'id_mec' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idmec']; ?>"><?php echo $usuario['nombres']; ?> </option>
                            <?php

                            include("db.php");
                            $sql = "SELECT * FROM mecanico ";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombres'] . '</option>';
                            }

                            ?>

                        </select>
                    </div>

                    <?php 
                        if($usuario['codigo'] == 101 && $usuario['id_cita'] == $id){
                    ?>

                    <div class="form-group ">
                        <label>Servicio</label>
                        <select class="form-control" id="id_serv" name="id_serv">
                            <option <?php echo $usuario['serv'] === 'id_serv' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idserv']; ?>"><?php echo $usuario['serv']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM servicio WHERE codigo = 101";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>

                    <?php
                        };
                    ?> 

                    <?php 
                        if($usuario['codigo'] == 102 && $usuario['id_cita'] == $id){
                    ?>

                    <div class="form-group ">
                        <label>Servicio</label>
                        <select class="form-control" id="id_serv" name="id_serv">
                            <option <?php echo $usuario['serv'] === 'id_serv' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idserv']; ?>"><?php echo $usuario['serv']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM servicio WHERE codigo = 102";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>

                    <?php
                        };
                    ?> 
                     <?php 
                        if($usuario['codigo'] == 103 && $usuario['id_cita'] == $id){
                    ?>

                    <div class="form-group ">
                        <label>Servicio</label>
                        <select class="form-control" id="id_serv" name="id_serv">
                            <option <?php echo $usuario['serv'] === 'id_serv' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idserv']; ?>"><?php echo $usuario['serv']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM servicio WHERE codigo = 103";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>

                    <?php
                        };
                    ?> 

                    <div class="form-group ">
                        <label for="observacion">Observacion:</label>
                        <textarea required id="observacion" name="observacion" cols="30" rows="5" class="form-control"><?php echo $usuario['observacion']; ?></textarea>
                    </div>

                    <input type="hidden" name="accion" value="editar_cita">
                    <input type="hidden" name="id_us" id="id_us" value="<?php echo $id_us; ?>">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                    <br>
                    <div class="mb-3">

                        <button type="submit" id="form" name="form" class="btn btn-success">Editar</button>
                        <a href="../views/citas.php" class="btn btn-danger">Cancelar</a>

                    </div>

                </div>
            </div>
</form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var today = new Date(); // obtener la fecha actual

            var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialDate: '2023-01-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            validRange: { // agregar esta opción
                start: today // solo permitir selección a partir de la fecha actual
            },
            selectConstraint: { // agregar esta opción
                startTime: '08:00', // hora de inicio válida
                endTime: '21:00' // hora de fin válida
            },
            slotMinTime: '08:00', // hora de inicio mínima
            slotMaxTime: '21:00', // hora de fin máxima
            selectAllow: function(arg) { // agregar esta función
                var day = arg.start.getDay(); // obtener el día de la semana (0 = domingo, 1 = lunes, ...)
                return day >= 1 && day <= 6; // permitir selección solo si el día es entre lunes y sábado
            },
            select: function(arg) {
                var title = prompt('Event Title:');
                if (title != 0) {
                    var start = arg.start.toISOString();; // fecha y hora de inicio
                    var end = arg.end; // fecha y hora de fin
                    var allDay = arg.allDay; // true si es un evento de todo el día, false en caso contrario

                    // asignar los valores de start y end a campos ocultos en el formulario
                    document.getElementById('start').value = moment(start).format('YYYY-MM-DDTHH:mm:ss');

                    calendar.addEvent({
                    title: title,
                    start: arg.start,
                    end: arg.end
                    });
                }
                calendar.unselect();
            },
            eventClick: function(arg) {
                if (confirm('Are you sure you want to delete this event?')) {
                arg.event.remove()
                }
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [
                // tus eventos aquí
            ]
            });

            calendar.render();
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ...

            // Add event listener for form submission
            document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get form values
            const id = document.getElementById('id').value;
            const id_us = document.getElementById('id_us').value;
            const id_moto = document.getElementById('id_moto').value;
            const id_serv = document.getElementById('id_serv').value;
            const id_mec = document.getElementById('id_mec').value;
            const fecha = document.getElementById('start')?.value; // Add optional chaining (?.) to handle null values
            const observacion = document.getElementById('observacion').value;

            // Send data to server
            if (fecha) {
                $.ajax({
                url: './functions.php', // URL of the PHP script that receives the data
                type: 'POST',
                data: {
                    accion: 'editar_cita',
                    id: id,
                    id_us: id_us,
                    id_moto: id_moto,
                    id_serv: id_serv,
                    id_mec: id_mec,
                    fecha: fecha, // convert date to ISO format
                    observacion: observacion
                },
                success: function(response) {
                    // Handle server response
                    console.log(response);
                    Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado correctamente!',
                    showConfirmButton: false,
                    timer: 1500  // La alerta se cerrará automáticamente después de 1.5 segundos
                    }) .then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // Redirigir al usuario después de que la alerta se cierre automáticamente
                        window.location.href = '../views/citas.php';
                    }
                    });
                }
                });
            }
            });
        });
    </script>
</div>
</div>

<?php include_once "footer.php"; ?>

</body>
</html>