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

        <script src="../js/jquery.min.js"></script>

    </head>
    <?php include "../includes/header.php"; ?>



    <body id="page-top">

        <div class="container-fluid">

            <?php 
                if( $actualsesion == 1){
            ?>
            <!-- DataTales admins -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de motos</h6>
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moto">
                        <span class="glyphicon glyphicon-plus"></span> Agregar moto <i class="fas fa-motorcycle" aria-hidden="true"></i> </a></button>
                        <button type="button" class="btn btn-danger">
                        <a href="./reportes/pdf_moto.php"> PDF <i class="fas fa-file-pdf"></i> </a></button>
                        <button type="button" class="btn btn-success">
                        <a href="./reportes/ex_moto.php"> Excel <i class="fas fa-table"></i> </a></button>
                </div>

                <!-- Table users -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Cilindraje</th>
                                    <th>Tipo</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <?php

                            include "../includes/db.php";
                            $result = mysqli_query($conexion, "SELECT m.id, m.placa, m.marca, m.modelo, m.cilindraje, m.tipo, u.id AS idu, 
                            u.nombre FROM moto m INNER JOIN user u ON m.id_user = u.id");
                            while ($filas = mysqli_fetch_assoc($result)) :

                            ?>
                                <tr>
                                    <td><?php echo $filas['placa']; ?></td>
                                    <td><?php echo $filas['marca']; ?></td>
                                    <td><?php echo $filas['modelo']; ?></td>
                                    <td><?php echo $filas['cilindraje']; ?></td>
                                    <td><?php echo $filas['tipo']; ?></td>
                                    <td><?php echo $filas['nombre']; ?></td>


                                    <td>
                                    <?php 
                                        if( $id_us == $filas['idu']){
                                    ?>
                                        <a class="btn btn-warning" href="../includes/editar_moto.php?id=<?php echo $filas['id']; ?> ">
                                            <i class="fa fa-edit "></i> </a>
                                    <?php
                                        }
                                    ?>
                                        <a href="../includes/eliminar_moto.php?id=<?php echo $filas['id']; ?> " class="btn btn-danger btn-del">
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
                                    title: 'Estas seguro de eliminar este vehiculo?',
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
            <?php
                };
            ?>
        </div>
        <!-- /.container-fluid -->

        <!-- Begin Page Content for user-->
        <div class="container-fluid">

            <?php 
                if( $actualsesion == 3){
            ?>
            <!-- DataTales users -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de motos</h6>
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#moto">
                        <span class="glyphicon glyphicon-plus"></span> Agregar moto <i class="fas fa-motorcycle" aria-hidden="true"></i> </a></button>
                    <?php 
                        if( $varsesion == 1){
                    ?>
                        <button type="button" class="btn btn-danger">
                        <a href="./reportes/pdf_moto.php"> PDF <i class="fas fa-file-pdf"></i> </a></button>
                        <button type="button" class="btn btn-success">
                        <a href="./reportes/ex_moto.php"> Excel <i class="fas fa-table"></i> </a></button>
                    <?php
                        };
                    ?> 
                </div>

                <!-- Table users -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Cilindraje</th>
                                    <th>tipo</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <?php

                            include "../includes/db.php";
                            $result = mysqli_query($conexion, "SELECT m.id, m.placa, m.marca, m.modelo, m.cilindraje, m.tipo, u.nombre FROM moto m 
                            INNER JOIN user u ON m.id_user = u.id WHERE u.id = $id_us");
                            while ($fila = mysqli_fetch_assoc($result)) :

                            ?>
                                <tr>
                                    <td><?php echo $fila['id']; ?></td>
                                    <td><?php echo $fila['placa']; ?></td>
                                    <td><?php echo $fila['marca']; ?></td>
                                    <td><?php echo $fila['modelo']; ?></td>
                                    <td><?php echo $fila['cilindraje']; ?></td>
                                    <td><?php echo $fila['tipo']; ?></td>
                                    <td><?php echo $fila['nombre']; ?></td>


                                    <td>
                                        <a class="btn btn-warning" href="../includes/editar_moto.php?id=<?php echo $fila['id'] ?> ">
                                            <i class="fa fa-edit "></i> </a>
                                        <a href="../includes/eliminar_moto.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
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
                                    title: 'Estas seguro de eliminar este vehiculo?',
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
            <?php
                };
            ?> 
        </div>
 
        <!-- /.container-fluid for admins -->
                    
        

        </div>
        <!-- End of Main Content -->

        <?php include "../includes/footer.php"; ?>

        <?php include "../includes/form_moto.php"; ?>

        </div>
        <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->




    </body>

</html>