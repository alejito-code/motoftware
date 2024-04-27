<?php 

require_once("../../includes/db.php");
header("content-Type: application/xls");
header("Content-Disposition: attachment; filename= reporte_motos.xls");

?>

<div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Placa</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Cilindraje</th>
                                    <th>tipo</th>
                                </tr>
                            </thead>

                            <?php

                            $result = mysqli_query($conexion, "SELECT * FROM moto ");
                            while ($fila = mysqli_fetch_assoc($result)) :

                            ?>
                                <tr>
                                    <td><?php echo $fila['id']; ?></td>
                                    <td><?php echo $fila['placa']; ?></td>
                                    <td><?php echo $fila['marca']; ?></td>
                                    <td><?php echo $fila['modelo']; ?></td>
                                    <td><?php echo $fila['cilindraje']; ?></td>
                                    <td><?php echo $fila['tipo']; ?></td>
                                </tr>

                            <?php endwhile; ?>

                            </tbody>
                        </table>