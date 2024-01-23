<?php
// Incluir la plantilla
include_once('plantillaInsController.php');
// Crear una instancia de la plantilla
$pdf = new plantillaInsController();
$pdf->AddPage();
$pdf->Background();
$pdf->Image('../../Img/baa.png', 23, 15, -300);
$pdf->Header();
$pdf->DatosGenerales();
$pdf->DetalleInspeccion();
$pdf->Fontaneria();
// Output the PDF to the browser
$pdf->Output();
?>