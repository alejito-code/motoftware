<?php 

require_once("../../includes/db.php");
header("content-Type: application/xls");
header("Content-Disposition: attachment; filename= reporte_citas.xls");

?>


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
        </tr>
    </thead>

    <?php

    $result = mysqli_query($conexion, "SELECT c.id_cita, c.fecha, c.hora, u.id AS idu, u.nombre AS nomu, m.placa, 
    me.nombres, s.nombre AS serv, c.observacion FROM citas c 
    INNER JOIN user u ON c.id_user = u.id 
    INNER JOIN moto m ON c.id_moto = m.id
    INNER JOIN servicio s ON c.id_serv = s.id
    INNER JOIN mecanico me ON c.id_mec = me.id");
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

    </tr>


    <?php endwhile; ?>

    </tbody>
 </table>