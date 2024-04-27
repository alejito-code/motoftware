<?php 

require('../fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this -> Image("images/motoftware.png", 10, 3, 35, 20);
    // Arial bold 15
    $this -> SetFont("Arial", "B", 12);
    // Título
    $this -> Cell(23);
    $this -> Cell(140, 5, "Reporte de mecanicos", 0, 0, "C");
    //Fecha
    $this -> SetFont("Arial", "", 9);
    $this -> Cell(25, 5, "Fecha: ".date("d/m/Y"), 0, 1, "C");
    // Salto de línea
    $this->Ln(10);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

?>