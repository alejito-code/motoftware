<?php
require_once("../../includes/db.php");
require "plantilla.php";


$sql = "SELECT id, placa, marca, modelo, cilindraje, tipo FROM moto";
$resultado = $conexion->query($sql);

$pdf = new PDF("P", "mm", "letter");
$pdf->AliasNbPages();
$pdf -> AddPage();

$pdf -> SetFont("Arial", "B", 7);

$pdf -> Cell(18);
$pdf ->Cell(20, 5, "Id", 1, 0, "C");
$pdf ->Cell(25, 5, "Placa", 1, 0, "C");
$pdf ->Cell(30, 5, "Marca", 1, 0, "C");
$pdf ->Cell(25, 5, "Modelo", 1, 0, "C");
$pdf ->Cell(25, 5, "Cilindraje", 1, 0, "C");
$pdf ->Cell(25, 5, "Tipo", 1, 1, "C");

$pdf -> SetFont("Arial", "", 7);

while($fila = $resultado->fetch_assoc()){
    $pdf -> Cell(18);
    $pdf ->Cell(20, 5, $fila['id'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['placa'], 1, 0, "C");
    $pdf ->Cell(30, 5, $fila['marca'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['modelo'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['cilindraje'], 1, 0, "C");
    $pdf ->Cell(25, 5, $fila['tipo'], 1, 1, "C");

}

$pdf -> Output();

?>