<?php
// Seguridad de sesiones
session_start();
error_reporting(0);
$varsesion = $_SESSION['rol'];
$id_us = $_SESSION['id'];
if ($varsesion == null || $varsesion = '') {

    header("Location: ../includes/_sesion/index.html");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Agrega la URL de la biblioteca -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/app.js"></script>

    <!-- Otros enlaces y scripts que necesites -->
</head>
<?php include "../includes/header.php"; ?>

<body id="page-top">

    <?php 
        if( $actualsesion == 1){
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Citas</h6>
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#citas">
                    <span class="glyphicon glyphicon-plus"></span> Agregar cita <i class="fa fa-plus-circle" aria-hidden="true"></i> </a></button>
                <button type="button" class="btn btn-danger">
                <a href="./reportes/pdf_cita.php"> PDF <i class="fas fa-file-pdf"></i> </a></button>
                <button type="button" class="btn btn-success">
                <a href="./reportes/ex_cita.php"> Excel <i class="fas fa-table"></i> </a></button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th># Cita</th>
                                <th>Fecha_Cita</th>
                                <th>Horario</th>
                                <th>Nombre</th>
                                <th>Placa</th>
                                <th>Mecanico</th>
                                <th>Servicio</th>
                                <th>Observacion</th>
                                <th>Acciones..</th>
                            </tr>
                        </thead>

                        <?php

                        include "../includes/db.php";
                        $result = mysqli_query($conexion, "SELECT c.id_cita, c.fecha, h.hora, u.id AS idu, u.nombre AS nomu, m.placa, 
                        me.nombres, s.nombre AS serv, c.observacion FROM citas c 
                        INNER JOIN user u ON c.id_user = u.id 
                        INNER JOIN moto m ON c.id_moto = m.id
                        INNER JOIN servicio s ON c.id_serv = s.id
                        INNER JOIN mecanico me ON c.id_mec = me.id
                        INNER JOIN horario h ON c.id_hora = h.id");
                        while ($fila = mysqli_fetch_assoc($result)) :

                        ?>
                            <tr>
                                <td><?php echo $fila['id_cita']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                                <td><?php echo $fila['hora']; ?></td>
                                <td><?php echo $fila['nomu']; ?></td>
                                <td><?php echo $fila['placa']; ?></td>    
                                <td><?php echo $fila['nombres']; ?></td>
                                <td><?php echo $fila['serv']; ?></td>
                                <td><?php echo $fila['observacion']; ?></td>

                                <td>
                                <?php 
                                    if( $id_us == $fila['idu']){
                                 ?>
                                    <a class="btn btn-warning" href="../includes/editar_cita.php?id_cita=<?php echo $fila['id_cita'] ?> ">
                                        <i class="fa fa-edit "></i> </a>
                                <?php
                                    }
                                ?>
                                    <a href="../includes/eliminar_cita.php?id_cita=<?php echo $fila['id_cita'] ?> " class="btn btn-danger btn-del">
                                        <i class="fa fa-trash "></i></a></button>
                                </td>
                            </tr>


                        <?php endwhile; ?>

                        </tbody>
                    </table>


                    <script>
                        $('.btn-del').on('click', function(e) {
                            e.preventDefault();
                            const href = $(this).attr('href')

                            Swal.fire({
                                title: 'Estas seguro de eliminar esta cita?',
                                text: "¡No podrás revertir esto!!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si, eliminar!',
                                cancelButtonText: 'Cancelar!',
                            }).then((result) => {
                                if (result.value) {
                                    if (result.isConfirmed) {
                                        Swal.fire(
                                            'Eliminado!',
                                            'El usuario fue eliminado.',
                                            'success'
                                        )
                                    }

                                    document.location.href = href;
                                }
                            })

                        })
                    </script>
                    <script src="../package/dist/sweetalert2.all.js"></script>
                    <script src="../package/dist/sweetalert2.all.min.js"></script>
                    <script src="../package/jquery-3.6.0.min.js"></script>



                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <?php
        };
    ?>
    
    <?php 
        if( $actualsesion == 3){
    ?>

    <!-- Begin secon table user Page Content -->
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Citas</h6>
                <br>
                <button id="constancias" type="button">
                <a id="const" href="#"> Constancias de Citas <i></i> </a></button>
                <div id="cuadro-grande" class="cuadro-grande">
                <table id="tablaDatos">
                    <thead class="lista">
                        <tr>
                            <th id="atributos" style="width: 80px;">Nombre</th>
                            <th id="atributos" style="width: 80px;"># Cita</th>
                            <th id="atributos" style="width: 120px;">Fecha_Cita</th>
                            <th id="atributos" style="width: 80px;">Horario</th>
                            <th id="atributos" style="width: 120px;">Placa</th>
                        </tr>
                    </thead>
                    <tbody class="lista">
                        <?php
                        include "../includes/db.php";
                        $result = mysqli_query($conexion, "SELECT c.id_cita, c.fecha, c.hora, u.nombre AS nomu, m.placa FROM citas c
                        INNER JOIN user u ON c.id_user = u.id
                        INNER JOIN moto m ON c.id_moto = m.id
                        WHERE u.id = $id_us");
                        while ($fila = mysqli_fetch_assoc($result)) :
                        ?>
                        <tr>
                            <td id="return" style="width: 80px;"><?php echo $fila['nomu']; ?></td>
                            <td id="return" style="width: 80px;"><?php echo $fila['id_cita']; ?></td>
                            <td id="return" style="width: 120px;"><?php echo $fila['fecha']; ?></td>
                            <td id="return" style="width: 80px;"><?php echo $fila['hora']; ?></td>
                            <td id="return" style="width: 120px;"><?php echo $fila['placa']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <button id="contenido">Descargar constancia en pdf</button>
                </table>
                <button id="cierre">Cerrar</button>
                </div>
                <style>
                 #const {
                     color: #fff;
                }
                #constancias {
                    float: right;
                    margin-right: -2px;
                    margin-top: -40px;
                    border-radius: 10px;
                    background-color: #6b6d7d !important;
                    border-color: #656776 !important;
                }
                #constancias:hover {
                    background-color: #656776;
                }
                #cuadro-grande {
                    display: none;
                    position: fixed;
                    top: -100%; /* Empieza arriba de la pantalla */
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 60%;
                    height: 60%;
                    max-width: 800px; /* Máximo ancho para el cuadro */
                    max-height: 600px; /* Máximo alto para el cuadro */
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 1000; /* Asegura que esté en frente de todo */
                    transition: top 0.5s ease;
                    backdrop-filter: blur(10px); /* Efecto de desenfoque para el fondo */
                }
                #cuadro-grande.active {
                    top: 50%; /* Terminamos la trancision con el cuadro */
                    display: block; /* Muestra el cuadro grande al agregar la clase "active" */
                }
                .lista {
                    display: table;
                    width: 100%;
                    border-collapse: collapse;
                    position: relative;
                }
                .lista th {
                    background-color: #333; /* Color de fondo oscuro para el encabezado */
                    color: #fff;
                    display: table-cell;
                    padding: 10px;
                    border: 1.5px solid white;
                }
                .lista th:first-child {
                    border-right: 1.5px solid white;
                }
                .lista th:last-child {
                    border-left: 1.5px solid white;
                }
                #contenido {
                    position: absolute;
                    top: 0;
                    right: 0;
                    margin: 5px;
                    z-index: 1;
                    border: 2px solid black; /* Borde de color #6b6d7d */
                    background-color: transparent; /* Fondo transparente */
                    padding: 8px 16px; /* Espaciado interno */
                    color: black; /* Color del texto */
                    cursor: pointer; /* Cursor al pasar el mouse */
                    transition: all 0.3s; /* Transición suave al cambiar propiedades */
                }
                #contenido:hover {
                    background-color: #656776; /* Cambio de color al hacer hover */
                    color: #fff; /* Cambio de color del texto al hacer hover */
                }
                #cierre {
                    position: fixed;
                    bottom: 10px;
                    right: 10px;
                    padding: 10px 10px;
                    background-color: #e74a3b;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
                #cierre:hover {
                    background-color: #cc0000;
                }
                #return{
                    padding: 8px;
                    width: 120px;
                    color: black;
                }
                </style>
    
                <?php 
                    if( $actualsesion == 1){
                ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#citas">
                    <span class="glyphicon glyphicon-plus"></span> Agregar cita <i class="fa fa-plus-circle" aria-hidden="true"></i> </a></button>
                <button type="button" class="btn btn-danger">
                <a href="./reportes/pdf_cita.php"> PDF <i class="fas fa-file-pdf"></i> </a></button>
                <button type="button" class="btn btn-success">
                <a href="./reportes/ex_cita.php"> Excel <i class="fas fa-table"></i> </a></button>
                <?php
                    };
                ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th># Cita</th>
                                <th>Fecha_Cita</th>
                                <th>Horario</th>
                                <th>Nombre</th>
                                <th>Placa</th>
                                <th>Mecanico</th>
                                <th>Servicio</th>
                                <th>Observacion</th>
                                <th>Acciones..</th>
                            </tr>
                        </thead>

                        <?php

                        include "../includes/db.php";
                        $result = mysqli_query($conexion, "SELECT c.id_cita, c.fecha, c.hora, u.nombre AS nomu, m.placa, 
                        me.nombres, s.nombre AS serv, c.observacion FROM citas c 
                        INNER JOIN user u ON c.id_user = u.id 
                        INNER JOIN moto m ON c.id_moto = m.id
                        INNER JOIN servicio s ON c.id_serv = s.id
                        INNER JOIN mecanico me ON c.id_mec = me.id WHERE u.id = $id_us");
                        while ($fila = mysqli_fetch_assoc($result)) :

                        ?>
                            <tr>
                                <td><?php echo $fila['id_cita']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                                <td><?php echo $fila['hora']; ?></td>
                                <td><?php echo $fila['nomu']; ?></td>
                                <td><?php echo $fila['placa']; ?></td>    
                                <td><?php echo $fila['nombres']; ?></td>
                                <td><?php echo $fila['serv']; ?></td>
                                <td><?php echo $fila['observacion']; ?></td>

                                <td>
                                    <a class="btn btn-warning" href="../includes/editar_cita.php?id_cita=<?php echo $fila['id_cita'] ?> ">
                                        <i class="fa fa-edit "></i> </a>
                                    <a href="../includes/eliminar_cita.php?id_cita=<?php echo $fila['id_cita'] ?> " class="btn btn-danger btn-del">
                                        <i class="fa fa-trash "></i></a></button>
                                </td>
                            </tr>


                        <?php endwhile; ?>

                        </tbody>
                    </table>


                    <script>
                        $('.btn-del').on('click', function(e) {
                            e.preventDefault();
                            const href = $(this).attr('href')

                            Swal.fire({
                                title: 'Estas seguro de eliminar esta cita?',
                                text: "¡No podrás revertir esto!!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si, eliminar!',
                                cancelButtonText: 'Cancelar!',
                            }).then((result) => {
                                if (result.value) {
                                    if (result.isConfirmed) {
                                        Swal.fire(
                                            'Eliminado!',
                                            'El usuario fue eliminado.',
                                            'success'
                                        )
                                    }

                                    document.location.href = href;
                                }
                            })

                        })
                    </script>
                    <script src="../package/dist/sweetalert2.all.js"></script>
                    <script src="../package/dist/sweetalert2.all.min.js"></script>
                    <script src="../package/jquery-3.6.0.min.js"></script>



                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <?php
        };
    ?>

    </div>
    <!-- End of Main Content -->

    <?php include "../includes/footer.php"; ?>

    <?php include "../includes/form_cita.php"; ?>

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->




</body>

</html>