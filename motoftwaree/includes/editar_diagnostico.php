<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['nombre'];
$id_us = $_SESSION['id'];
if ($varsesion == null || $varsesion = '') {
    header("Location: _sesion/login.php");
}

include "db.php";

                    $id = $_GET['id_diag'];
                    $result = mysqli_query($conexion, "SELECT d.id_diag, d.fecha, u.id AS idu, u.nombre AS nomu, m.placa, 
                        me.nombres, d.observacion FROM diagnostico d 
                        INNER JOIN user u ON d.id_user = u.id 
                        INNER JOIN moto m ON d.id_moto = m.id
                        INNER JOIN mecanico me ON d.id_mec = me.id WHERE u.id = $id_us");
                        $resultado = mysqli_query($conexion, $consulta);
                        $usuario = mysqli_fetch_assoc($resultado);
                              ?>
<?php include_once "header.php"; ?>



<form action="functions.php" id="form" method="POST">

    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <h3 class="text-center">Editar Cita del Cliente <?php echo $usuario['nomu']; ?></h3>
                    <br>
                    
                    <div class="form-group ">
                        <label for="fecha" class="form-label">Fecha*</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $usuario['fecha']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="hora" class="form-label">Hora*</label>
                        <input type="time" id="hora" name="hora" class="form-control" value="<?php echo $usuario['hora']; ?>" required>
                    </div>

                    <div class="form-group ">
                        <label>Placa</label>
                        <select class="form-control" id="id_moto" name="id_moto">
                            <option <?php echo $usuario['plac'] === 'id_moto' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idmoto']; ?>"><?php echo $usuario['plac']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT m.id AS idmoto, m.placa AS plac , m.marca, m.modelo, m.cilindraje, m.tipo, u.nombre FROM moto m INNER JOIN user u ON m.id_user = u.id WHERE u.id = $id_us";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['idmoto'] . '">' . $consulta['plac'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>

                    <div class="form-group ">
                        <label>Mecanico</label>
                        <select class="form-control" id="id_mec" name="id_mec">
                            <option <?php echo $usuario['nombres'] === 'id_mec' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idmec']; ?>"><?php echo $usuario['nombres']; ?> </option>
                            <?php

                            include("db.php");
                            $sql = "SELECT * FROM mecanico ";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombres'] . '</option>';
                            }

                            ?>

                        </select>
                    </div>

                    <?php 
                        if($usuario['codigo'] == 101 && $usuario['id_diag'] == $id){
                    ?>

                    <div class="form-group ">
                        <label>Servicio</label>
                        <select class="form-control" id="id_serv" name="id_serv">
                            <option <?php echo $usuario['serv'] === 'id_serv' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idserv']; ?>"><?php echo $usuario['serv']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM servicio WHERE codigo = 101";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>

                    <?php
                        };
                    ?> 

                    <?php 
                        if($usuario['codigo'] == 102 && $usuario['id_diag'] == $id){
                    ?>

                    <div class="form-group ">
                        <label>Servicio</label>
                        <select class="form-control" id="id_serv" name="id_serv">
                            <option <?php echo $usuario['serv'] === 'id_serv' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idserv']; ?>"><?php echo $usuario['serv']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM servicio WHERE codigo = 102";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                            }

                            ?>


                        </select>
                    </div>

                    <?php
                        };
                    ?> 
                     <?php 
                        if($usuario['codigo'] == 103 && $usuario['id_diag'] == $id){
                    ?>

                    <div class="form-group ">
                        <label>Servicio</label>
                        <select class="form-control" id="id_serv" name="id_serv">
                            <option <?php echo $usuario['serv'] === 'id_serv' ? "selected='selected' " : "" ?> value="<?php echo $usuario['idserv']; ?>"><?php echo $usuario['serv']; ?> </option>
                            <?php

                            include("db.php");
                            //Codigo para mostrar categorias desde otra tabla
                            $sql = "SELECT * FROM servicio WHERE codigo = 103";
                            $resultado = mysqli_query($conexion, $sql);
                            while ($consulta = mysqli_fetch_array($resultado)) {
                                echo '<option value="' . $consulta['id'] . '">' . $consulta['nombre'] . '</option>';
                            }

                            ?>


                        </select>
                        <?php
                        };
                    ?> 
                </div>
            </div>
</form>
</div>
</div>

<?php include_once "footer.php"; ?>