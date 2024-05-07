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
    <h1>¡Agenda tu cita aquí!</h1>
    <div class="container">
        <h2>Formulario para Agenda
            
        </h2>
        <form id="cita-form" action="../../includes/functions.php" method="POST">
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
            <div class="form-check">
              <label class="form-check-label" for="mostrarFalla">Seleccione el tipo de falla de su vehículo:</label>
              <br>
              <input class="form-check-input" type="checkbox" id="mostrarFalla1" onchange="toggleFalla('campoFalla1')">
              Falla eléctrica
              <input class="form-check-input" type="checkbox" id="mostrarFalla2" onchange="toggleFalla('campoFalla2')">
              Falla mecánica
              <input class="form-check-input" type="checkbox" id="mostrarFalla3" onchange="toggleFalla('campoFalla3')">
              Mantenimiento
            </div>
            <br>
    
            <!-- Campos "Tipo de Falla" -->
            <div class="form-group" id="campoFalla1" style="display: none;">
                <label for="falla1">Tipo de Falla Eléctrica:</label>
                <select class="form-control" id="falla1" name="fallaelectrica">
                    <option value="0">--Selecciona una opción--</option>
                    <?php
                    include("../../includes/db.php");
                    $sql = "SELECT * FROM servicio WHERE codigo = 101";
                    $resultado = mysqli_query($conexion, $sql);
                    while ($consulta = mysqli_fetch_array($resultado)) {
                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="campoFalla2" style="display: none;">
                <label for="falla2">Tipo de Falla Mecánica:</label>
                <select class="form-control" id="falla2" name="fallamecanica">
                    <option value="0">--Selecciona una opción--</option>
                    <?php
                    include("../../includes/db.php");
                    $sql = "SELECT * FROM servicio WHERE codigo = 102";
                    $resultado = mysqli_query($conexion, $sql);
                    while ($consulta = mysqli_fetch_array($resultado)) {
                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group" id="campoFalla3" style="display: none;">
                <label for="falla2">Tipo Mantenimiento:</label>
                <select class="form-control" id="falla3" name="mantenimiento">
                    <option value="0">--Selecciona una opción--</option>
                    <?php
                    include("../../includes/db.php");
                    $sql = "SELECT * FROM servicio WHERE codigo = 103";
                    $resultado = mysqli_query($conexion, $sql);
                    while ($consulta = mysqli_fetch_array($resultado)) {
                        echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                    }
                    ?>
                </select>
            </div>
              <script>
                  // Función para mostrar u ocultar el campo "Tipo de Falla" según la casilla de verificación seleccionada
                  function toggleFalla(idCampo) {
                      // Desselecciona todas las casillas excepto la que se acaba de seleccionar
                      var checkboxes = document.querySelectorAll('input[type=checkbox]');
                      checkboxes.forEach(function(checkbox) {
                          if (checkbox.id !== idCampo.replace('campoFalla', 'mostrarFalla')) {
                              checkbox.checked = false;
                          }
                      });

                      // Oculta todos los campos de "Tipo de Falla"
                      document.getElementById('campoFalla1').style.display = 'none';
                      document.getElementById('campoFalla2').style.display = 'none';
                      document.getElementById('campoFalla3').style.display = 'none';
                      
                      // Muestra el campo de "Tipo de Falla" correspondiente a la casilla seleccionada
                      document.getElementById(idCampo).style.display = 'block';
                  }
              </script>
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
            <label for="observacion">Observación:</label>
            <textarea id="observacion" name="observacion" rows="4" required></textarea>
          </div>
          <input type="hidden" name="id_us" id="id_us" value="<?php echo $id_us ?>">
          <input type="hidden" name="accion" value="insert_cita">
          <button type="submit" value="Guardar">Enviar</button>
        </form>
      </div>
        <script>
            document.getElementById('cita-form').addEventListener('submit', function(event) {
                event.preventDefault();

                // obtener los valores de los campos del formulario
                var id_us = document.getElementById('id_us').value;
                var placa = document.getElementById('placa').value;
                var mecanico = document.getElementById('mecanico').value;
                var fecha = document.getElementById('start').value;
                var observacion = document.getElementById('observacion').value;

                var falla = '';

                // verificar cuál de los campos de verificación está marcado
                if (document.getElementById('mostrarFalla1').checked) {
                    falla = document.querySelector('select[name="fallaelectrica"]').value;
                } else if (document.getElementById('mostrarFalla2').checked) {
                    falla = document.querySelector('select[name="fallamecanica"]').value;
                } else if (document.getElementById('mostrarFalla3').checked) {
                    falla = document.querySelector('select[name="mantenimiento"]').value;
                }
                
                // enviar los datos al servidor
                $.ajax({
                    url: '../../includes/functions.php', // URL del script PHP que recibe los datos
                    type: 'POST',
                    data: {
                        accion: 'insert_cita',
                        id_us: id_us,   
                        placa: placa,
                        falla: falla,
                        mecanico: mecanico,
                        fecha: fecha, // convertir la fecha a formato ISO
                        observacion: observacion
                    },
                    success: function(response) {
                        // manejar la respuesta del servidor
                        console.log(response);
                        alert('Cita agendada exitosamente');
                        location.assign('../selec_cita.php');
                    }
                });
            });
        </script>
      <!-- <script>
            document.getElementById('formulario').addEventListener('submit', function(event) {
            event.preventDefault();

            fetch('procesar_formulario.php', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cita agendada con éxito',
                        position: 'top',
                        confirmButtonColor: '#007bff',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al agendar cita',
                        text: data.mensaje,
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error al enviar el formulario:', error);
            });
        });
    </script> -->
</body>
<script src=https://kit.fontawesome.com/86860db679.js crossorigin="anonymous"></script>
</html>
