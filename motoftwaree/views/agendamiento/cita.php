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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.5/sweetalert2.min.css">
</head>
<body>
<a href="../selec_cita.php" class="atras"><i class="fas fa-chevron-left"></i>  Atras</a>
    <h1>¡Agenda tu cita por falla electrica aquí!</h1>
    <div class="container">
        <h2>Formulario para Falla electrica</h2>
        <form id="formulario" action="../../includes/functions.php" method="POST">
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
                <select class="form-control" id="falla" name="fallaelectrica">
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
                <select class="form-control" id="falla" name="fallamecanica">
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
                <select class="form-control" id="falla" name="mantenimiento">
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
            <input type="date" id="fecha" name="fecha" required>
          </div>
          <div class="form-group">
            <label for="hora" class="form-label">Hora:</label>
            <select class="form-control" id="hora" name="hora">
                  <option value="0">--Selecciona una hora--</option>
                    <?php

                      include("../../includes/db.php");
                      //Codigo para mostrar categorias desde otra tabla
                      $sql = "SELECT c.id_hora, h.id AS ih, h.hora AS hora FROM horario h
                      LEFT JOIN citas c ON h.id = c.id_hora
                      WHERE c.id_hora IS NULL";
                      $resultado = mysqli_query($conexion, $sql);
                      while ($consulta = mysqli_fetch_array($resultado)) {
                          echo '<option value="' . $consulta['ih'] . '">' . $consulta['hora'] . '</option>';
                        }

                    ?>
                </select>
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
