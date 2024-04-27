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
    <h1>¡Agenda tu cita para tu diagnostico aquí!</h1>
    <div class="container">
        <h2>Formulario para diagnostico</h2>
        <form id="formulario" action="insercion_diagnostico.php" enctype="multipart/form-data" method="POST">
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
            <input type="date" id="fecha" name="fecha" required>
          </div>
          <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>
          </div>
          <div class="form-group">
            <label for="archivo">Cargar archivo:</label>
            <input type="file" id="archivo" name="archivo" accept=".pdf, .doc, .docx" required>
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
