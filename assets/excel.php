<?php 
require_once('../connection.php');
require_once('PHPExcel/Classes/PHPExcel.php');
// Crear nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();
 
// Propiedades del documento
$objPHPExcel->getProperties()->setCreator("SEAC")
                ->setLastModifiedBy("SEAC System")
                ->setTitle("Informe Mensual")
                ->setSubject("Lecturas")
                ->setDescription("Documento")
                ->setKeywords("office 2010 openxml php")
                ->setCategory("Archivo con resultado");
 
 
 
// Combino las celdas desde A1 hasta E1
// $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
 
$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'codsucursal')
                ->setCellValue('B1', 'nomsucursal')
                ->setCellValue('C1', 'codproyecto')
                ->setCellValue('D1', 'nomproyecto')
	            ->setCellValue('E1', 'poligono')
	            ->setCellValue('F1', 'casa')
                ->setCellValue('G1', 'nummedidor')
                ->setCellValue('H1', 'lecturainicial')
                ->setCellValue('I1', 'diferencia')
                ->setCellValue('J1', 'fechainicial')
                ->setCellValue('K1', 'fechafinal')
                ->setCellValue('L1', 'habitada')
                ->setCellValue('M1', 'fechainspeccion')
                ->setCellValue('N1', 'esnegocio')
                ->setCellValue('O1', 'observacion')
                ->setCellValue('P1', 'usuario asignado');
			
// Fuente de la primera fila en negrita
$boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
$objPHPExcel->getActiveSheet()->getStyle('A1:P1')->applyFromArray($boldArray);		
 
	
			
//Ancho de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);	
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);	
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);	
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);	
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);			
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
 
// /*Extraer datos de MYSQL*/
// 	# conectare la base de datos
//     $con=@mysqli_connect('localhost', 'motion_seac', '6hWWeuC6l!aE', 'motion_seac');
//     if(!$con){
//         die("imposible conectarse: ".mysqli_error($con));
//     }
//     if (@mysqli_connect_errno()) {
//         die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
//     }
// 	$sql="SELECT * FROM evaluacion_vivienda  order by id";
// 	$query=mysqli_query($con,$sql);

$db=Db::getConnect();
$sql= $db->prepare('SELECT ev.proyecto_id, ev.etapa_id, ev.poligono_id, ev.lote_id, ev.numero_serie_medidor, ev.lectura_anterior,
ev.consumo, ev.fecha_creacion, ev.fecha_modificacion, ev.estado_vivienda, ev.tipo_vivienda, ev.fecha_modificacion,
ev.observaciones, ev.usuario,
r.nombre AS nombre_residencial,
e.nombre AS nombre_etapa,
p.nombre AS nombre_poligono,
l.numero_lote,
u.nombres,u.apellidos FROM evaluacion_vivienda AS ev
	INNER JOIN proyecto AS r
		ON ev.proyecto_id=r.id
	INNER JOIN etapa AS e
		ON ev.etapa_id=e.id
	INNER JOIN poligono AS p
		ON ev.poligono_id=p.id
	INNER JOIN lote AS l
		ON ev.lote_id=l.id
	INNER JOIN usuarios AS u
		ON ev.usuario=u.id
WHERE ev.proyecto_id=:residencial AND mes_activo_id=:mes');
$sql->bindParam(':residencial',$_GET['residencial']);
$sql->bindParam(':mes',$_GET['mes']);
$sql->execute();
$data=$sql->fetchAll();
$cel=2;//Numero de fila donde empezara a crear  el reporte

foreach ($data as $row){
	$codsucursal=$row['proyecto_id'];
	$nomsucursal=$row['nombre_residencial'];
	$codproyecto=$row['etapa_id'];
	$nomproyecto=$row['nombre_etapa'];
	$poligono=$row['nombre_poligono'];
    $casa=$row['numero_lote'];
    $nummedidor=$row['numero_serie_medidor'];
    $lecturainicial=$row['lectura_final'];
    $diferencia=$row['consumo'];
    $fechainicial=$row['fecha_creacion'];
    $fechafinal=$row['fecha_modificacion'];
    $habitada=$row['estado_vivienda'];
    $esnegocio=$row['tipo_vivienda'];
    $fechainspeccion=$row['fecha_modificacion'];
    $observacion=$row['observaciones'];
    $usuario=$row['nombres'].', '.$row['apellidos'];

		
		$a="A".$cel;
		$b="B".$cel;
		$c="C".$cel;
		$d="D".$cel;
		$e="E".$cel;
        $f="F".$cel;
        $g="G".$cel;
        $h="H".$cel;
        $i="I".$cel;
        $j="J".$cel;
        $k="K".$cel;
        $l="L".$cel;
        $m="M".$cel;
        $n="N".$cel;
        $o="O".$cel;
        $p="P".$cel;
		// Agregar datos
		$objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($a, $codsucursal)
                        ->setCellValue($b, $nomsucursal)
                        ->setCellValue($c, $codproyecto)
                        ->setCellValue($d, $nomproyecto)
		                ->setCellValue($e, $poligono)
                        ->setCellValue($f, $casa)
                        ->setCellValue($g, $nummedidor)
                        ->setCellValue($h, $lecturainicial)
                        ->setCellValue($i, $diferencia)
                        ->setCellValue($j, $fechainicial)
                        ->setCellValue($k, $fechafinal)
                        ->setCellValue($l, $habitada)
                        ->setCellValue($m, $fechainspeccion)
                        ->setCellValue($n, $esnegocio)
                        ->setCellValue($o, $observacion)
                        ->setCellValue($p, $usuario)
                        ;
		
	        $cel+=1;
	}
 
/*Fin extracion de datos MYSQL*/
$rango="A1:$e";
$styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF')))
);
$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);
// Cambiar el nombre de hoja de cálculo
$objPHPExcel->getActiveSheet()->setTitle('Reporte');
 
 
// Establecer índice de hoja activa a la primera hoja , por lo que Excel abre esto como la primera hoja
$objPHPExcel->setActiveSheetIndex(0);
 
$meses=array(
    '01'=>'enero',
    '02'=>'febrero',
    '03'=>'marzo',
    '04'=>'abril',
    '05'=>'mayo',
    '06'=>'junio',
    '07'=>'julio',
    '08'=>'agosto',
    '09'=>'septiembre',
    '10'=>'octubre',
    '11'=>'noviembre',
    '12'=>'diciembre'
);
 
// Redirigir la salida al navegador web de un cliente ( Excel5 )
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.'0000'.$_GET['mes'].'.xls"');
header('Cache-Control: max-age=0');
// Si usted está sirviendo a IE 9 , a continuación, puede ser necesaria la siguiente
header('Cache-Control: max-age=1');
 
// Si usted está sirviendo a IE a través de SSL , a continuación, puede ser necesaria la siguiente
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>
