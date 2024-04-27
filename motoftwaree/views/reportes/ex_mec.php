<?php 

require_once("../../includes/db.php");
header("content-Type: application/xls");
header("Content-Disposition: attachment; filename= reporte_mecanicos.xls");

?>


<div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Folio#</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Sexo</th>
                                <th>Telefono#</th>
                                <th>Fecha_Nacimiento</th>
                                <th>Correo</th>
                                <th>Fecha_Registro</th>
                            </tr>
                        </thead>

                        <?php

                        $result = mysqli_query($conexion, "SELECT * FROM mecanico ");
                        while ($fila = mysqli_fetch_assoc($result)) :

                        ?>
                            <tr>
                                <td><?php echo $fila['cedula']; ?></td>
                                <td><?php echo $fila['nombres']; ?></td>
                                <td><?php echo $fila['apellido']; ?></td>
                                <td><?php echo $fila['sexo']; ?></td>
                                <td><?php echo $fila['telefono']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                                <td><?php echo $fila['correo']; ?></td>
                                <td><?php echo $fila['fecha_registro']; ?></td>

                            </tr>


                        <?php endwhile; ?>

                        </tbody>
                    </table>