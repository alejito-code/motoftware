<?php
error_reporting(0);
session_start();
$actualsesion = $_SESSION['rol'];
$id_us = $_SESSION['id'];
if ($actualsesion == null || $actualsesion == '') {
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
    <link rel='stylesheet' href='../package/dist/sweetalert2.min.css'>

</head>
<?php include "../includes/header.php"; ?>
<?php
//if( $actualsesion == "Administrador"){
?>


<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h2 class="subtitle">¡Bienvenido Administrator <?php echo $_SESSION['nombre']; ?>!</h2>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>
                <br>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#user">
                    <span class="glyphicon glyphicon-plus"></span> Agregar usuario <i class="fa fa-user-plus"></i> </a></button>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Fecha</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <?php

                        include "../includes/db.php";
                        $result = mysqli_query($conexion, "SELECT  user.id, user.nombre, user.correo, user.fecha,
                        roles.rol FROM user LEFT JOIN roles ON user.rol= roles.id ");
                        while ($fila = mysqli_fetch_assoc($result)) :

                        ?>
                            <tr>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['correo']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                                <td><?php echo $fila['rol']; ?></td>

                                <td>
                                <?php 
                                    if( $id_us == $fila['id']){
                                 ?>
                                    <a class="btn btn-warning" href="../includes/editar_user.php?id=<?php echo $fila['id'] ?> ">
                                        <i class="fa fa-edit "></i> </a>
                                <?php
                                    }
                                ?>
                                    <a href="../includes/eliminar_user.php?id=<?php echo $fila['id'] ?> " class="btn btn-danger btn-del">
                                        <i class="fa fa-trash "></i></a></button>
                                </td>
                            </tr>


                        <?php endwhile; ?>
                        <?php
                        //}

                        ?>
                        </tbody>
                    </table>


                    <script>
                        $('.btn-del').on('click', function(e) {
                            e.preventDefault();
                            const href = $(this).attr('href')

                            Swal.fire({
                                title: 'Estas seguro de eliminar este usuario?',
                                text: "¡No podrás revertir esto!!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#8E2317',
                                cancelButtonColor: '#8E2317',
                                confirmButtonText: 'Si, eliminar!',
                                cancelButtonText: 'Cancelar!',
                            }).then((result) => {
                                if (result.value) {
                                    if (result.isConfirmed) {
                                        Swal.fire(
                                            title: 'Eliminado!',
                                            text: 'El usuario fue eliminado.',
                                            icon: 'success',
                                            confirmButtonColor: '#8E2317'
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

    </div>
    <!-- End of Main Content -->

    <?php include "../includes/footer.php"; ?>

    <?php include "../includes/_sesion/registros.php"; ?>

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->




</body>

</html>