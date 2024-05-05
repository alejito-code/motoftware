<?php
// Seguridad de sesiones
session_start();
error_reporting(0);
$varsesion = $_SESSION['rol'];
$id_us = $_SESSION['id'];
if ($varsesion == null || $varsesion = '') {
    header("Location: ../../includes/_sesion/index.html");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falla electrica</title>
    <link rel="shortcut icon" type="image/icon" href="../../../img/tuerca (1).png">
    <link href="../estilos.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.css">
    <script src='../../js/jquery.min.js'></script>
    <script src='./fullcalendar/dist/index.global.js'></script>
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
                    document.getElementById('start').value = arg.start.toISOString(); // Mantener el formato ISO directamente

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
    <a href="../selec_cita.php" class="atras">Atras</a>
    <h1>¡Agenda tu cita para diagnóstico aquí!</h1>
    <div class="container">
        <h2>Formulario para tu diagnóstico</h2>
        <form id="cita-form" action="insertar_diagnostico.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
              <label>Selecione la placa del vehiculo</label>
                <select class="form-control" id="placa" name="placa">
                  <option value="0">--Selecciona una opcion--</option>
                    <?php

                      include("../../includes/db.php");
                      //Codigo para mostrar categorias desde otra tabla
                      $sql = "SELECT m.id, m.placa, m.marca, m.modelo, m.cilindraje, m.tipo, u.nombre FROM moto m INNER JOIN user u ON m.id_user = u.id WHERE u.id = $id_us";
                      $resultado = mysqli_query($conexion, $sql);
                      while ($consulta = mysqli_fetch_array($resultado)) {
                          echo '<option value="' . $consulta['id'] . '">' . $consulta['placa'] . '</option>';
                      }

                    ?>
                </select>
            </div>
              <div class="form-group">
                <label for="mecanico">Mecánico:</label>
                <select class="form-control" id="mecanico" name="mecanico">
                  <option value="0">--Selecciona una opcion--</option>
                    <?php

                      include("../../includes/db.php");
                      //Codigo para mostrar categorias desde otra tabla
                      $sql = "SELECT * FROM mecanico";
                      $resultado = mysqli_query($conexion, $sql);
                      while ($consulta = mysqli_fetch_array($resultado)) {
                          echo '<option value="' . $consulta['id'] . '">' . $consulta['nombres'] . '</option>';
                        }

                    ?>
                </select>
              </div>    
          <div class="form-group">
            <label for="fecha">Fecha:</label>
            <div id='calendar'></div>
            <input type="hidden" id="start" name="start">
          </div>
          <div class="form-group">
            <label for="archivo">Cargar Archivo:</label>
            <input type="file" id="archivo_pdf" name="archivo_pdf" accept=".pdf">
          </div>
          <input type="hidden" name="id_us" id="id_us" value="<?php echo $id_us ?>">
          <input type="hidden" name="accion" value="insert_diag">
          <button type="submit" value="Guardar">Enviar</button>
        </form>
        <style>
    #archivo_pdf {
        display: block;
        width: 100%;
        padding: 8px;
        font-size: 16px;
        color: #333;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        cursor: pointer;
    }

    #archivo_pdf:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>

    </div>
</body>
<script src="https://kit.fontawesome.com/86860db679.js" crossorigin="anonymous"></script>
</html>

/////////////////////////////////////////////////////////////////////////////