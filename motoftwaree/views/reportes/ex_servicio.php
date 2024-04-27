<?php 

require_once("../../includes/db.php");
header("content-Type: application/xls");
header("Content-Disposition: attachment; filename= reporte_servicios.xls");

?>


<div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Codigo</th>
                                <th>Servicio</th>
                                <th>Precio</th>
                                <th>Fecha_Registro</th>
                            </tr>
                        </thead>

                        <?php

                        $result = mysqli_query($conexion, "SELECT * FROM servicio ");
                        while ($fila = mysqli_fetch_assoc($result)) :

                        ?>
                            <tr>
                                <td><?php echo $fila['id']; ?></td>
                                <td><?php echo $fila['codigo']; ?></td>
                                <td><?php echo $fila['nombre']; ?></td>
                                <td><?php echo $fila['precio']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>

                            </tr>


                        <?php endwhile; ?>

                        </tbody>
                    </table>