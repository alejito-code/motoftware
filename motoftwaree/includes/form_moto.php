<?php


session_start();
error_reporting(0);
$varsesion = $_SESSION['rol'];
$id = $_SESSION['id'];

if ($varsesion == null || $varsesion = '') {
    header("Location: _sesion/login.php");
}
?>


<div class="modal fade" id="moto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h3 class="modal-title" id="exampleModalLabel">Agregar moto nueva</h3>
                <button type="button" class="btn btn-black" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">

                <form action="../includes/functions.php" method="POST">
                    <div class="form-group">
                        <label for="nombre" class="form-label">Placa</label>
                        <input type="text" id="placa" name="placa" class="form-control" required onkeyup="mayuscula(this);">
                    </div>
                    <div class="form-group">
                        <label for="precio" class="form-label">Marca</label>
                        <input type="text" id="marca" name="marca" class="form-control" required onkeyup="mayuscula(this);">
                    </div>
                    <div class="form-group">
                        <label for="precio" class="form-label">Modelo</label>
                        <input type="year" id="modelo" name="modelo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="precio" class="form-label">Cilindraje</label>
                        <input type="number" id="cilindraje" name="cilindraje" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="precio" class="form-label">Tipo</label>
                        <input type="text" id="tipo" name="tipo" class="form-control" onkeyup="mayuscula(this);">
                    </div>



                    <br>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <input type="hidden" name="accion" value="insert_moto">
                    <div class="mb-3">

                        <input type="submit" value="Guardar" id="register" class="btn btn-success" name="registrar">
                        <a href="moto.php" class="btn btn-danger">Cancelar</a>

                    </div>
            </div>
        </div>

        </form>
    </div>
    <script src="../js/mayus.js"></script>
</div>