<?php
require_once("../../includes/db.php");
require "plantilla.php";


$sql = "SELECT id, codigo, nombre, precio, fecha FROM servicio";
$resultado = $conexion->query($sql);

$pdf = new PDF("P", "mm", "letter");
$pdf->AliasNbPages();
$pdf -> AddPage();

$pdf -> SetFont("Arial", "B", 7);

$pdf -> Cell(13);
$pdf ->Cell(20, 5, "Id", 1, 0, "C");
$pdf ->Cell(20, 5, "Codigo", 1, 0, "C");
$pdf ->Cell(50, 5, "Nombre", 1, 0, "C");
$pdf ->Cell(60, 5, "Precio", 1, 0, "C");
$pdf ->Cell(25, 5, "Fecha Registro", 1, 1, "C");

$pdf -> SetFont("Arial", "", 7);

while($fila = $resultado->fetch_assoc()){
    $pdf -> Cell(13);
    $pdf ->Cell(20, 5, $fila['id'], 1, 0, "C");
    $pdf ->Cell(20, 5, $fila['codigo'], 1, 0, "C");
    $pdf ->Cell(50, 5, $fila['nombre'], 1, 0, "C");
    $pdf ->Cell(60, 5, $fila['precio'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['fecha'], 1, 1, "C");

}

$pdf -> Output();

?>