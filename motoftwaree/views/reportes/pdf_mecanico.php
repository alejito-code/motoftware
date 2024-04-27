<?php
require_once("../../includes/db.php");
require "plantilla.php";

$sql = "SELECT id, cedula, nombres, apellido, telefono, fecha, correo FROM mecanico";
$resultado = $conexion->query($sql);

$pdf = new PDF("P", "mm", "letter");
$pdf->AliasNbPages();
$pdf -> AddPage();

$pdf -> SetFont("Arial", "B", 7);

$pdf ->Cell(20, 5, "Id", 1, 0, "C");
$pdf ->Cell(25, 5, "Cedula", 1, 0, "C");
$pdf ->Cell(30, 5, "Nombre", 1, 0, "C");
$pdf ->Cell(30, 5, "Apellido", 1, 0, "C");
$pdf ->Cell(25, 5, "Telefono", 1, 0, "C");
$pdf ->Cell(25, 5, "Fecha Nacimiento", 1, 0, "C");
$pdf ->Cell(40, 5, "Correo", 1, 1, "C");

$pdf -> SetFont("Arial", "", 7);

while($fila = $resultado->fetch_assoc()){
    
    $pdf ->Cell(20, 5, $fila['id'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['cedula'], 1, 0, "C");
    $pdf ->Cell(30, 5, $fila['nombres'], 1, 0, "C");
    $pdf ->Cell(30, 5, $fila['apellido'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['telefono'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['fecha'], 1, 0, "C");
    $pdf ->Cell(40, 5, $fila['correo'], 1, 1, "C");
}

$pdf -> Output();

?>