<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;

if(isset($_SESSION)){
    session_start();
}
require_once('Models/Residencia.php');
require_once('Models/Etapa.php');
require_once('Models/Poligono.php');
require_once('Models/Lote.php');
require_once('Models/MesActivo.php');
require_once('Models/Catalogos.php');
require_once('Models/Usuario.php');
require_once('Models/observaciones.php');
class EvaluacionVController{

    function __construct(){}

    public function register(){
		$usuario=$_SESSION['usuario_id'];
		$GET_PROYECTO_ID=Residencia::all($usuario);
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		//$loteAllowUser=Lote::loteNoUserId();
		$GET_MES_ID=MesActivo::allowUser();
		$estadoMedidorList=Catalogos::getListEMedidor();
		$tipoNegocioList=Catalogos::getTNegocioList();
		$observacionId=Observaciones::observationArray();
		$observacioEnd=Observaciones::observacioEnd();
		$ultimoRegistro=EvaluacionV::ultimoRegistro($usuario);
		$GET_LECTURA_LIST=EvaluacionV::list();
		// $GET_LECTURA_CONSUMO=EvaluacionV::getListConsumo();
		$GET_EXIST=EvaluacionV::limitRepetido();
		$GET_LOTE_NEXT=Lote::listNext();
        require_once('Views/EvaluacionV/register.php');
    }


	public function save(){
		$estadoVivienda = implode(', ', $_POST['estadoVivienda']);
        $tipoVivienda = implode(', ', $_POST['tipoVivienda']);
		$fechaRegistro = date('Y-m-d h:m:s');
		$allLotesByUser = EvaluacionV::all($_SESSION['usuario_id']);
		$registrado=false;

		foreach($allLotesByUser as $lotes)
		{
			if(strcmp($lotes->getLecturaFinal(),$_POST['lecturaFinal'])==0 && strcmp($lotes->getLoteId(),$_POST['lecturaFinal'])==0)
			{
				$registrado=true;
			}
		}
		if(!$registrado){
			$evaluacion = new EvaluacionV(null,$_POST['proyectoId'], $_POST['etapaId'],$_POST['poligonoId'], $_POST['loteId'], $_POST['numeroSerieMedidor'],$_POST['lecturaFinal'],$_POST['estadoMedidor'],$_POST['estadoVivienda'],$_POST['tipoVivienda'],$_POST['tipoNegocio'],$_SESSION['usuario_id'],$_POST['observaciones'], $_POST['mesActivo'], $fechaRegistro, null, $_POST['lecturaAnterior'], $_POST['consumo']);
			EvaluacionV::save($evaluacion);
			$_SESSION['mensaje']='Registro guardado satisfactoriamente';
			$this->show();
		}
		else
		{
			echo '<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">Ya se ha registrado esta lectura!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>';
			$this->register();
		}
       
	}

	public function savecontinue(){
		$allLotesByUser = EvaluacionV::all($_SESSION['usuario_id']);
		$registrado=false;

		foreach($allLotesByUser as $lotes)
		{
			if(strcmp($lotes->getLecturaFinal(),$_POST['lecturaFinal'])==0)
			{
				$registrado=true;
			}
		}
		if(!$registrado)
		{
		$fechaRegistro = date('Y-m-d h:m:s');
		$evaluacion = new EvaluacionV(null,$_POST['proyectoId'], $_POST['etapaId'],$_POST['poligonoId'], $_POST['loteId'], $_POST['numeroSerieMedidor'],$_POST['lecturaFinal'],$_POST['estadoMedidor'],$_POST['estadoVivienda'],$_POST['tipoVivienda'],$_POST['tipoNegocio'],$_SESSION['usuario_id'],$_POST['observaciones'], $_POST['mesActivo'], $fechaRegistro, null, $_POST['lecturaAnterior'], $_POST['consumo']);
		EvaluacionV::save($evaluacion);
		
		//Repuerar el registro de loteId,
		//validar si tiene indicie, si tiene haces esto recueprar el indice de loteId guardado, y le sumas 1
			//Buscar proyecto_id, etapa_id, poligono_id y indice+1 (existe)

		//si no tiene, buscar el id sigueiten, con la suma de id+1.
		
		//$this->register();
		//var_dump($lote);
		//die();
		}
	}
		
		//var_dump($evaluacion);
		//die();
	

	public function show(){
		$usuario=$_SESSION['usuario_id'];
		$GET_PROYECTO_ID=Residencia::allR();
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::allowUser();
		$estadoMedidorList=Catalogos::getListEMedidor();
		$tipoNegocioList=Catalogos::getTNegocioList();
    	require_once('Utils/paginationUtils.php');
		$evaluaciones=EvaluacionV::allR();
		$lista_evaluaciones="";
		$registros=10; // debe ser siempre par
		if (count($evaluaciones)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($evaluaciones),$_GET['boton'],$evaluaciones,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$evaluaciones,count($evaluaciones),0,1,1,1);
		}
		require_once('Views/EvaluacionV/show.php');
	}


	//------------Vista de empleado tecnico---------//
	public function showLecturaEMP(){
		
		$GET_PROYECTO_ID=Residencia::allR();
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::allowUser();
		$estadoMedidorList=Catalogos::getListEMedidor();
		$tipoNegocioList=Catalogos::getTNegocioList();
    	require_once('Utils/paginationUtils.php');
		$evaluaciones=EvaluacionV::all($_SESSION['usuario_id']);
		$lista_evaluaciones="";
		$registros=10; // debe ser siempre par
		if (count($evaluaciones)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($evaluaciones),$_GET['boton'],$evaluaciones,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$evaluaciones,count($evaluaciones),0,1,1,1);
		}
		require_once('Views/Lecturas/show.php');
	}	

	public function registerTec(){
		
		$GET_PROYECTO_ID=Residencia::allR();
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::allowUser();
		$estadoMedidorList=Catalogos::getListEMedidor();
		$tipoNegocioList=Catalogos::getTNegocioList();
        require_once('Views/Lecturas/register.php');
    }
	public function saveTec(){
		$estadoVivienda = implode(', ', $_POST['estadoVivienda']);
        $tipoVivienda = implode(', ', $_POST['tipoVivienda']);
		$fechaRegistro = date('Y-m-d h:m:s');
		

		$lote1=array('loteId'=>$_POST['loteId'],'lecturaFinal'=>$_POST['lecturaFinal'],'mesActivo'=>$_POST['mesActivo']);
		
		$lote2=array(null,NULL,NULL,NULL,$_POST['loteId'],null,$_POST['lecturaFinal'],null,null,null,null, null, null, $_POST['mesActivo'], null, null, null, null);
		
		$descrip = EvaluacionV::buscarDuplicado($lote1);
		if($lote2 == $descrip){

			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya se ha registrado esta lectura!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';

			
			$this->registerTec();

		}

		else
		{
			$evaluacion = new EvaluacionV(null,$_POST['proyectoId'], $_POST['etapaId'],$_POST['poligonoId'], $_POST['loteId'], $_POST['numeroSerieMedidor'],$_POST['lecturaFinal'],$_POST['estadoMedidor'],$estadoVivienda,$tipoVivienda,$_POST['tipoNegocio'], $_SESSION['usuario_id'], $_POST['observaciones'], $_POST['mesActivo'], $fechaRegistro, null, null, $_POST['consumo']);
			EvaluacionV::save($evaluacion);
			$_SESSION['mensaje']='Registro guardado satisfactoriamente';
			$this->showLecturaEMP();

		}
       
	
		//var_dump($evaluacion);
		//die();
	}
	public function savecontinueTec(){
		$allLotesByUser = EvaluacionV::all($_SESSION['usuario_id']);
		$registrado=false;

		foreach($allLotesByUser as $lotes)
		{
			if(strcmp($lotes->getLecturaFinal(),$_POST['lecturaFinal'])==0)
			{
				$registrado=true;
			}
		}
		if(!$registrado)
		{
		$fechaRegistro = date('Y-m-d h:m:s');
		$evaluacion = new EvaluacionV(null,$_POST['proyectoId'], $_POST['etapaId'],$_POST['poligonoId'], $_POST['loteId'], $_POST['numeroSerieMedidor'],$_POST['lecturaFinal'],$_POST['estadoMedidor'],$_POST['estadoVivienda'],$_POST['tipoVivienda'],$_POST['tipoNegocio'],$_SESSION['usuario_id'],$_POST['observaciones'], $_POST['mesActivo'], $fechaRegistro, null, $_POST['ultimoRegistro'], $_POST['consumo']);
		EvaluacionV::save($evaluacion);
		$_SESSION['mensaje']='Registro guardado satisfactoriamente';
			$this->registerTec();
		//$this->register();
		//var_dump($lote);
		//die();
		}
		else
		{
			
		}

	}
 
	public function deleteTec(){
		EvaluacionV::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->showLecturaEMP();
	}


	public function update(){
		$estadoVivienda = implode(', ', $_POST['estadoVivienda']);
        $tipoVivienda = implode(', ', $_POST['tipoVivienda']);
		$fechaRegistro = date('Y-m-d h:m:s');
		$evaluacion = new EvaluacionV($_POST['id'],$_POST['proyectoId'], $_POST['etapaId'],$_POST['poligonoId'], $_POST['loteId'], $_POST['numeroSerieMedidor'],$_POST['lecturaFinal'],$_POST['estadoMedidor'],$estadoVivienda,$tipoVivienda,$_POST['tipoNegocio'],$_SESSION['usuario_id'],$_POST['observaciones'], $_POST['mesActivo'], $fechaRegistro, null, $_POST['ultimoRegistro'], $_POST['consumo']);
		//print_r($evaluacion);
		EvaluacionV::update($evaluacion);
		$_SESSION['mensaje']='Registro Actualizado correctamente';
		$this->show();
	}

	public function updateTec(){
		$estadoVivienda = implode(', ', $_POST['estadoVivienda']);
        $tipoVivienda = implode(', ', $_POST['tipoVivienda']);
		$fechaRegistro = date('Y-m-d h:m:s');
		$evaluacion = new EvaluacionV($_POST['id'],$_POST['proyectoId'], $_POST['etapaId'],$_POST['poligonoId'], $_POST['loteId'], $_POST['numeroSerieMedidor'],$_POST['lecturaFinal'],$_POST['estadoMedidor'],$estadoVivienda,$tipoVivienda,$_POST['tipoNegocio'],$_SESSION['usuario_id'],$_POST['observaciones'], $_POST['mesActivo'], $fechaRegistro, null, $_POST['ultimoRegistro'], $_POST['consumo']);
		//print_r($evaluacion);
		EvaluacionV::update($evaluacion);
		$_SESSION['mensaje']='Registro Actualizado correctamente';
		$this->showLecturaEMP();
	}



	public function buscarExtendidaTec(){
		//------------import section---------//
		$lectura=array('proyectoId'=>$_POST['proyectoId'],'etapaId'=>$_POST['etapaId'],'poligonoId'=>$_POST['poligonoId'], 'loteId'=>$_POST['loteId'],'usuario'=>$_SESSION['usuario_id']);
		
		$GET_PROYECTO_ID=Residencia::allR();
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();

		//----------------------------------//
		require_once('Utils/paginationUtils.php');
		$evaluaciones=EvaluacionV::allByFilter($lectura); //<--- llama el metodo por el array
		$lista_evaluaciones="";
		$registros=10; // debe ser siempre par
		if (count($evaluaciones)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($evaluaciones),$_GET['boton'],$evaluaciones,5);
		
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$evaluaciones,count($evaluaciones),0,1,1,1);
		}
		require_once('Views/Lecturas/show.php');

	}
	public function showUpdateTec(){
		//----------------import-----------//
		$usuario=$_SESSION['usuario_id'];
		$GET_PROYECTO_ID=Residencia::allR();
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::all($usuario);
		$estadoMedidorList=Catalogos::getListEMedidor();
		$tipoNegocioList=Catalogos::getTNegocioList();
		$etapaNoUser=Etapa::etapaNoUserId();
		$poligonoNoUser=Poligono::poligonoNoUserId();
		$loteNoUser=Lote::loteNoUserId();
		//--------------------------------//
		$ID=$_GET['id'];
		$lectura=EvaluacionV::getById($ID);
		require_once('Views/Lecturas/update.php');
	}





	
    public function delete(){
		EvaluacionV::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->show();
	}

	public function savelastnumber(){
		$date=date('Y-m-d');
		$lote=new Lote(null, $_POST['loteId'], $_POST['numeroSerieMedidor'], $_SESSION['usuario_id'], $date, null, null,null);
		Lote::saveAntNumero($lote);
	}

	public function updateNewNumber(){
		$lote=new Lote($_POST['loteId'], null, null, null,null,$_POST['newNumeroSerie'],$_SESSION['usuario_id'],null);
		Lote::updateNewNumber($lote);
	}

	public function buscarExtendida(){
		//------------import section---------//
		$lectura=array('proyectoId'=>$_POST['proyectoId'],'etapaId'=>$_POST['etapaId'],'poligonoId'=>$_POST['poligonoId'], 'loteId'=>$_POST['loteId'],'usuario'=>$_SESSION['usuario_id']);
		
		$GET_PROYECTO_ID=Residencia::allR();
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::allowUser();
		//----------------------------------//
		require_once('Utils/paginationUtils.php');
		$evaluaciones=EvaluacionV::allByFilter($lectura); //<--- llama el metodo por el array
		$lista_evaluaciones="";
		$registros=10; // debe ser siempre par
		if (count($evaluaciones)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($evaluaciones),$_GET['boton'],$evaluaciones,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$evaluaciones,count($evaluaciones),0,1,1,1);
		}
		require_once('Views/EvaluacionV/show.php');

	}

	public function selectPorMes(){
		//------------import section---------//
		$lectura=array('CategoriaActivo'=>$_POST['CategoriaActivo'],'usuario'=>$_SESSION['usuario_id']);
		$usuario=$_SESSION['usuario_id'];
		$GET_PROYECTO_ID=Residencia::all($usuario);
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::allowUser();
		//----------------------------------//
		require_once('Utils/paginationUtils.php');
		$evaluaciones=EvaluacionV::allByFilterSelect($lectura); //<--- llama el metodo por el array
		$lista_evaluaciones="";
		$registros=10; // debe ser siempre par
		if (count($evaluaciones)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($evaluaciones),$_GET['boton'],$evaluaciones,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$evaluaciones,count($evaluaciones),0,1,1,1);
		}
		require_once('Views/EvaluacionV/show.php');

	}
	

	public function showUpdate(){
		//----------------import-----------//
		$usuario=$_SESSION['usuario_id'];
		$GET_PROYECTO_ID=Residencia::all($usuario);
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::all($usuario);
		$estadoMedidorList=Catalogos::getListEMedidor();
		$tipoNegocioList=Catalogos::getTNegocioList();
		$etapaNoUser=Etapa::etapaNoUserId();
		$poligonoNoUser=Poligono::poligonoNoUserId();
		$loteNoUser=Lote::loteNoUserId();
		//--------------------------------//
		$ID=$_GET['id'];
		$lectura=EvaluacionV::getById($ID);
		require_once('Views/EvaluacionV/update.php');
	}

	public function showHistoCambios(){
		$usuario=$_SESSION['usuario_id'];
		$GET_PROYECTO_ID=Residencia::all($usuario);
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::allowUser();
		$estadoMedidorList=Catalogos::getListEMedidor();
		$tipoNegocioList=Catalogos::getTNegocioList();
		$usuariosList=Usuario::all();
    	require_once('Utils/paginationUtils.php');
		$evaluaciones=EvaluacionV::all($_SESSION['usuario_id']);
		$lista_evaluaciones="";
		$registros=10; // debe ser siempre par
		if (count($evaluaciones)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($evaluaciones),$_GET['boton'],$evaluaciones,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$evaluaciones,count($evaluaciones),0,1,1,1);
		}
		require_once('Views/EvaluacionV/showHistoCambios.php');
	}

	public function buscarHistorial(){
		//------------ array ---------//
		$buscarHistory=array('proyectoId'=>$_POST['proyectoId'],'etapaId'=>$_POST['etapaId'],'poligonoId'=>$_POST['poligonoId'], 'loteId'=>$_POST['loteId'], 'numeroSerieMedidor'=>$_POST['numeroSerieMedidor'], 'fechaIngreso'=>$_POST['fechaIngreso'], 'usuario'=>$_POST['usuario']);
		//------------import section---------//
		$usuario=$_SESSION['usuario_id'];
		$GET_PROYECTO_ID=Residencia::all($usuario);
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST=Poligono::list();
        $GET_LOTE_LIST=Lote::list();
		$GET_MES_ID=MesActivo::allowUser();
		//----------------------------------//
		require_once('Utils/paginationUtils.php');
		$evaluaciones=EvaluacionV::allbyHistory($buscarHistory); //<--- llama el metodo por el array
		$lista_evaluaciones="";
		$registros=10; // debe ser siempre par
		if (count($evaluaciones)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($evaluaciones),$_GET['boton'],$evaluaciones,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$evaluaciones,count($evaluaciones),0,1,1,1);
		}
		require_once('Views/EvaluacionV/showHistoCambios.php');
	}



	
		
	public function generateExcel(){
		//define($_SERVER['DOCUMENT_ROOT'].'/excel.php';
		//$mesActivo=$_GET['mesActivo'];
		//$lectura=array('proyectoId'=>$_POST['proyectoId'],'mesActivo'=>$_POST['mesActivo']);
		//$report=EvaluacionV::reportByMont($lectura); //<--- llama el metodo por el array
		//var_dump($uri);
		//die();
		//include('../excel.php');
		header('Location: assets/excel.php?residencial='.$_POST['proyectoId'].'&mes='.$_POST['mesActivo']);
	}

	public function showGenerateReport(){
		$GET_MES_ID=MesActivo::allowUser();
		$GET_PROYECTO_ID=Residencia::allR();
		require_once('Views/EvaluacionV/showGenReport.php');
	}

	public function saveObservation(){
		$date=date('Y-m-d h:m:s');
		$evaluacion = new Observaciones(null, $_POST['mesActivo'], $_POST['loteId'], $_SESSION['usuario_id'], $_POST['observaciones'], $date);
		Observaciones::saveObservation($evaluacion);
	}

	
}
