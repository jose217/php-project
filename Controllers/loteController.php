<?php
/**
* Controlador de lote o registro de casa.
* Autor: José Ramos
* Sitio Web: https://motion.com.sv
* Fecha: 23-03-2022
*/

use PhpOffice\PhpSpreadsheet\Cell\DataType;

 //error_reporting (0);
if(!isset($_SESSION))
    {
        session_start();
    }
require_once('Models/Residencia.php');
require_once('Models/Etapa.php');
require_once('Models/Poligono.php');
class LoteController
{
	function __construct(){}


	public function register(){
		$GET_POLIGONO_LIST = Poligono::list();
		$GET_ETAPA_LIST = Etapa::list();
		$GET_PROYECTO_ID = Residencia::all($_SESSION['usuario_id']);
		$GET_LOTE_LIST = Lote::list();
		require_once('Views/Lote/register.php');
		
	}

	//funcion para guardar registro
	public function save(){
		$existe=false;
		$residenciales=Lote::all($_SESSION['usuario_id']);
		$lote1=array(null,'proyectoId'=>$_POST['proyectoId'],'etapaId'=>$_POST['etapaId'],'poligonoId'=>$_POST['poligonoId'],'numeroLote'=>$_POST['numeroLote'],'numeroSerieMedidor'=>$_POST['numeroSerieMedidor']);
		
		$lote2=array(null,$_POST['proyectoId'],$_POST['etapaId'],$_POST['poligonoId'],$_POST['numeroLote'],$_POST['numeroSerieMedidor'],null,null,$_POST['indice']);
		
		$descrip = lote::buscarDuplicado($lote1);
		
		
		if($lote2 == $descrip){

			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya existe un registro con este nombre!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';
			$this->register();

		}
		
		else{

		
		$lote = new Lote(null, $_POST['proyectoId'],$_POST['etapaId'] ,$_POST['poligonoId'], $_POST['numeroLote'], $_POST['numeroSerieMedidor'],$_SESSION['usuario_id'],$_POST['codigoCliente'],$_POST['indice']);
		Lote::save($lote);
		$_SESSION['mensaje']='Registro guardado satisfactoriamente';
		$this->show();
	}

}




	//funcion para guardar registro
	public function savecontinue(){
		$allLotesByUser = Lote::all($_SESSION['usuario_id']);
		$registrado=false;

		foreach($allLotesByUser as $lotes)
		{
			if(strcmp($lotes->getNumeroLote(),$_POST['numeroLote'])==0)
			{
				$registrado=true;
			}
		}
		if(!$registrado)
		{
			$lote = new Lote(null, $_POST['proyectoId'],$_POST['etapaId'] ,$_POST['poligonoId'], $_POST['numeroLote'], $_POST['numeroSerieMedidor'],$_SESSION['usuario_id'],null,$_POST['indice']);
			Lote::save($lote);
		//$this->register();
		//var_dump($lote);
		//die();
		}
		else
		{
			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya existe un registro con este nombre!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';
		}
	}

	//muestra las historias clínicas creadas
	public function show(){
    	require_once('Utils/paginationUtils.php');
		$GET_POLIGONO_LIST = Poligono::list();
		$GET_ETAPA_LIST = Etapa::list();
		$GET_PROYECTO_ID = Residencia::all($_SESSION['usuario_id']);
		$lotes=Lote::all($_SESSION['usuario_id']);
		$lista_lotes="";
		$registros=10; // debe ser siempre par
		if (count($lotes)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($lotes),$_GET['boton'],$lotes,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$lotes,count($lotes),0,1,1,1);
		}
		require_once('Views/Lote/show.php');
	}

	public function error(){
		require_once('Views/User/error.php');
	}

	
	public function delete(){
		Lote::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->show();
	}


	public function showupdate(){
		$id=$_GET['id'];
		$lote=Lote::getById($id);
		$GET_POLIGONO_LIST = Poligono::list();
		$GET_POLIGONO_ID_V2 =Poligono::all($_SESSION['usuario_id']);
		$GET_ETAPA_LIST = Etapa::list();
		$GET_ETAPA_ID_V2 = Etapa::all($_SESSION['usuario_id']);
		$GET_PROYECTO_ID = Residencia::all($_SESSION['usuario_id']);
		require_once('Views/Lote/update.php');
	}

	//funcion para buscar registro 
	public function buscarExtendida(){
		$filtros=array('proyectoId'=>$_POST['proyectoId'],'etapaId'=>$_POST['etapaId'],'poligonoId'=>$_POST['poligonoId'], 'numeroLote'=>$_POST['numeroLote'],'usuario'=>$_SESSION['usuario_id'],$_POST['indice']);
		require_once('Utils/paginationUtils.php');
		$GET_POLIGONO_LIST = Poligono::list();
		$GET_ETAPA_LIST = Etapa::list();
		$GET_PROYECTO_ID = Residencia::all($_SESSION['usuario_id']);
		$lotes=Lote::allByFilter($filtros);
		$lista_lotes="";
		$registros=10; // debe ser siempre par
		if (count($lotes)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($lotes),$_GET['boton'],$lotes,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$lotes,count($lotes),0,1,1,1);
		}
		require_once('Views/Lote/show.php');

	}
/*
	public function generarNumero(){
		$numero=HistoClinica::getMaxId();
		$numero = (NULL) ? $numero : $numero+1 ;
		if ($numero<10) {
			$numero= "000".$numero;
		} elseif($numero>=10&&$numero<99) {
			$numero="00".$numero;
		}elseif ($numero>=100&&$numero<999) {
			$numero="0".$numero;
		}elseif ($numero>=1000&&$numero<9999) {
			$numero=$numero;
		}
		return $numero;
	}
	*/
/*
	public function saveAntFamiliares(){
		$antFamiliar= new AntFamiliar(null,$_POST['cardiopatia'], $_POST['diabetes'], $_POST['cancer'], $_POST['enfcardiovasculares'], $_POST['hipertension'], $_POST['enfmentales'], $_POST['tubercolosis'], $_POST['enfinfecciosas'], $_POST['malformacion'], $_POST['otra'], $_POST['descripcionfami'],$_POST['paciente']);
		//var_dump($antFamiliar);
		//die();
		HistoClinica::saveAntFamiliar($antFamiliar);
	}
*/
	public function update(){
		$lote = new Lote($_POST['id'], $_POST['proyectoId'],$_POST['etapaId'] ,$_POST['poligonoId'], $_POST['numeroLote'], $_POST['numeroSerieMedidor'],$_SESSION['usuario_id'],null,$_POST['indice']);
		Lote::update($lote);
		$_SESSION['mensaje']='Registro Actualizado correctamente';
		$this->show();
	}

	//REPORTES
	public function reporteHistorico(){
		//validar que no se abra si no hay consultas
		header('Location: Controllers/HistoricoPdf.php?id='.$_GET['id'].'');
	}




}
