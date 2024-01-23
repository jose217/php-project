<?php
require_once('../fpdf_latest/fpdf.php');

class plantillaInsController extends FPDF
{
    public function Background(){
        $this->Image('../../Img/baa.png', 60, 100);
    }

    public function Header()
    {
        // Puedes personalizar la cabecera del PDF aquí
        $this->SetFont('Helvetica', 'B', 15);
        $this->SetXY(52,10);
        $this->Cell(40, 20, 'SEGURIDAD ACTIVA S.A. DE C.V.');
        $this->SetFont('Helvetica', 'B', 15);
        $this->SetXY(52,10);
        $this->Cell(40,30,'HOJA DE INSPECCION');
        // $this->line(10, 20, 195, 20);
    }

    public function DatosGenerales(){
        /** residencial */
        $this->SetFont('Helvetica', '', 10);
        $this->SetXY(52,10);
        $this->Cell(0,50,'RESIDENCIAL');
        $this->Line(77,36.5,160, 36.5);
        
        /** etapa */
        $this->SetFont('Helvetica', '', 10);
        $this->SetXY(52,10);
        $this->Cell(0,65,'ETAPA / EXTERNO');
        $this->Line(85,44,160,44);

        /** fecha inspeccion */
        $this->SetFont('Helvetica', '', 10);
        $this->SetXY(92,10);
        $this->Cell(0,80,'FECHA INSPECCION');
        $this->Line(129, 51.5, 157, 51.5);
        $this->SetXY(157,10);
        $this->Cell(0,80,'HORA');
        $this->Line(170, 51.5, 185, 51.5);

        /** poligono */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,95,'POLIGONO');
        $this->Line(43,59,70,59);

        /** casa */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(70,10);
        $this->Cell(0,95,'CASA');
        $this->Line(82,59,95,59);

        /** cod cliente */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(95,10);
        $this->Cell(0,95,'COD. CLIENTE');
        $this->Line(121,59,150,59);

        /** inspeccion */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,110,'INSPECCION');
        $this->Line(47,66.5,95,66.5);

        /** habitada */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,125,'HABITADA');
        $this->Line(43,74,95,74);

        /** negocio */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,140,'NEGOCIO');
        $this->Line(41,81.5,80,81.5);

        /** tipo negocio */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(80,10);
        $this->Cell(0,140,'TIPO DE NEGOCIO');
        $this->Line(114,81.5,170,81.5);
    }

    public function DetalleInspeccion(){
        /** sub titulo */
        $this->SetFont('Helvetica','B', 12);
        $this->SetXY(23,10);
        $this->Cell(0,165,'DETALLE DE INSPECCION:');

        /** alto consumo */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,180,'ALTO CONSUMO');
        $this->Line(53,101.5,65,101.5);

        /** bajo consumo */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(65,10);
        $this->Cell(0,180,'BAJO CONSUMO');
        $this->Line(95,101.5,107,101.5);

        /** medidor invertido */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(107,10);
        $this->Cell(0,180,'MEDIDOR INVERTIDO');
        $this->Line(145,101.5,157,101.5);

        /** fuga interna */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,195,'FUGA INTERNA');
        $this->Line(51,109,63,109);
    
        /** fuga externa */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(63,10);
        $this->Cell(0,195,'FUGA EXTERNA');
        $this->Line(92,109,104,109);

        /** otros */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(104,10);
        $this->Cell(0,195,'OTROS');
        $this->Line(120,109,132,109);

        /** otros */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,210,'ESPECIFIQUE:');
        $this->Line(23,124,185,124);
    }

    public function Fontaneria(){
        /** sub titulo */
        $this->SetFont('Helvetica','B', 12);
        $this->SetXY(23,10);
        $this->Cell(0,250,'FONTANERIA:');

        /** SERIE DEL MEDIDOR */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(23,10);
        $this->Cell(0,265,'SERIE DEL MEDIDOR');
        $this->Line(61,144,85,144);

        /** SERIE DEL MEDIDOR */
        $this->SetFont('Helvetica','', 10);
        $this->SetXY(85,10);
        $this->Cell(0,265,'SERIE DEL MEDIDOR');
        $this->Line(122,144,150,144);
    }

    public function PruebaLts(){
    
    }

    public function Footer()
    {
        // // Puedes personalizar el pie de página del PDF aquí
        // $this->SetY(-15);
        // $this->SetFont('Arial', 'I', 8);
        // $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    
}

?>