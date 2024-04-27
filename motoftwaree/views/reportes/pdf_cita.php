<?php
require_once("../../includes/db.php");
require "plantilla.php";

$sql = "SELECT c.id_cita, c.fecha, c.hora, u.nombre AS nomu, m.placa AS plac, 
me.nombres, s.nombre AS serv, c.observacion FROM citas c 
INNER JOIN user u ON c.id_user = u.id 
INNER JOIN moto m ON c.id_moto = m.id
INNER JOIN servicio s ON c.id_serv = s.id
INNER JOIN mecanico me ON c.id_mec = me.id";
$resultado = $conexion->query($sql);

$pdf = new PDF("P", "mm", "letter");
$pdf->AliasNbPages();
$pdf -> AddPage();

$pdf -> SetFont("Arial", "B", 7);

$pdf ->Cell(10, 5, "Id", 1, 0, "C");
$pdf ->Cell(20, 5, "Fecha", 1, 0, "C");
$pdf ->Cell(20, 5, "Hora", 1, 0, "C");
$pdf ->Cell(20, 5, "Cliente", 1, 0, "C");
$pdf ->Cell(18, 5, "Placa", 1, 0, "C");
$pdf ->Cell(20, 5, "Mecanico", 1, 0, "C");
$pdf ->Cell(35, 5, "Servicio", 1, 0, "C");
$pdf ->Cell(50, 5, "Observacion", 1, 1, "C");

$pdf -> SetFont("Arial", "", 7);

while($fila = $resultado->fetch_assoc()){
    
    $pdf ->Cell(10, 5, $fila['id_cita'], 1, 0, "C");
    $pdf ->Cell(20, 5, $fila['fecha'], 1, 0, "C");
    $pdf ->Cell(20, 5, $fila['hora'], 1, 0, "C");
    $pdf ->Cell(20, 5, $fila['nomu'], 1, 0, "C");
    $pdf ->Cell(18, 5, $fila['plac'], 1, 0, "C");
    $pdf ->Cell(20, 5, $fila['nombres'], 1, 0, "C");
    $pdf ->Cell(35, 5, $fila['serv'], 1, 0, "C");
    $pdf ->Cell(50, 5, $fila['observacion'], 1, 1, "C");

}

$pdf -> Output();

?>