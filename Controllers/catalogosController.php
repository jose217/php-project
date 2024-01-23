<?php /**19-08-2022 SS El Salvador @Motion S.A. de C.V. */

if($_SESSION)
{
    session_start();
}
class catalogosController
{
    function __construct(){}

	/**
	 *  Controles para Motivo Inspección.
	 */

	public function registerMotivoInspeccion(){      
		require_once('Views/Catalogos/registerMotivoInspeccion.php');
	}

	public function saveMotivoInspeccion(){
		$codigo=rand(1111, 9999);

		$descrip = Catalogos::buscarDupMotivoInspeccion($_POST['descripcion']);

		if($descrip==1){
			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya existe un registro con este nombre!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';
			$this->registerMotivoInspeccion();
		}
		
		else{
		$catalogos = new Catalogos(null,$codigo,$_POST['descripcion'],$_SESSION['usuario_id']);
		Catalogos::saveMotivoInspeccion($catalogos);
		$_SESSION['mensaje']='Registro guardado satisfactoriamente';
		$this->showMotivoInspeccion();
		
		}
	}

	public function showupdateMotivoInspeccion(){
		$id=$_GET['id'];
		$GET_PROJ_ID =  Catalogos::getAllMotivoInspeccion($_SESSION['usuario_id']);
		$catalogos=Catalogos::getMotivoInspeccionById($id);
		require_once('Views/Catalogos/updateMotivoInspeccion.php');
	}

	public function updateMotivoInspeccion(){
		$catalogos=new Catalogos( $_POST['id'],null,$_POST['descripcion'], $_SESSION['usuario_id'] );
		Catalogos::updateM($catalogos);
		$_SESSION['mensaje']='Registro actualizado satisfactoriamente';
		$this->showMotivoInspeccion();
	}


	public function showMotivoInspeccion(){
    	require_once('Utils/paginationUtils.php');
		$catalogos=Catalogos::getAllMotivoInspeccion($_SESSION['usuario_id']);
		$lista_emedidor="";
		$registros=10; // debe ser siempre par
		if (count($catalogos)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($catalogos),$_GET['boton'],$catalogos,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$catalogos,count($catalogos),0,1,1,1);
		}
		require_once('Views/Catalogos/showMotivoInspeccion.php');
	}

	public function buscarMotivoInspeccion(){
		require_once('Utils/paginationUtils.php');
		$filtros=array('descripcion'=>$_POST['descripcion'] , 'usuario'=>$_SESSION['usuario_id']);
		$datos=Catalogos::getDataByFilter($filtros,'cat_motivo_inspeccion');
		$botones=0;
		$numElementos = count($datos);
		$registros=10; // debe ser siempre par
		if(count($datos)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,$numElementos,$_GET['boton'],$datos, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$datos,$numElementos,0,1,1,1);
		}
		require_once('Views/Catalogos/showMotivoInspeccion.php');
	}

	public function deleteMotivoInspeccion(){
		Catalogos::deleteEMedidor($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->showEMedidor();
	}


	public function registerEMedidor(){
        
		require_once('Views/Catalogos/registerEMedidor.php');
	}

	public function saveEMedidor(){
		$codigo=rand(1111, 9999);

		$descrip = Catalogos::buscarDuplicado($_POST['descripcion']);

		if($descrip==1){
			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya existe un registro con este nombre!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';
			$this->registerEMedidor();
		}
		
		else{
		$catalogos = new Catalogos(null,$codigo,$_POST['descripcion'],$_SESSION['usuario_id']);
		Catalogos::saveTNegocio($catalogos);
		$_SESSION['mensaje']='Registro guardado satisfactoriamente';
		$this->showEMedidor();
		
		}
	}

	public function showupdateEMedidor(){
		$id=$_GET['id'];
		$GET_PROJ_ID =  Catalogos::allM($_SESSION['usuario_id']);
		$catalogos=Catalogos::getByIdM($id);
		require_once('Views/Catalogos/updateEMedidor.php');
	}

	public function updateEMedidor(){
		$catalogos=new Catalogos( $_POST['id'],null,$_POST['descripcion'], $_SESSION['usuario_id'] );
		Catalogos::updateM($catalogos);
		$_SESSION['mensaje']='Registro actualizado satisfactoriamente';
		$this->showEMedidor();
	}


	public function showEMedidor(){
    	require_once('Utils/paginationUtils.php');
		$catalogos=Catalogos::getAllEMedidor($_SESSION['usuario_id']);
		$lista_emedidor="";
		$registros=10; // debe ser siempre par
		if (count($catalogos)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($catalogos),$_GET['boton'],$catalogos,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$catalogos,count($catalogos),0,1,1,1);
		}
		require_once('Views/Catalogos/showEMedidor.php');
	}

	public function deleteEMedidor(){
		Catalogos::deleteEMedidor($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->showEMedidor();
	}

    public function registerTNegocio(){
        
		require_once('Views/Catalogos/catTipoNegocio.php');
	}

    public function saveTipoNegocio(){
		$descrip = Catalogos::buscarDuplicado($_POST['descripcion']);
		
		if($descrip==1){
			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya existe un registro con este nombre!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';
			$this->registerTNegocio();
		}
		
		else{
		$catalogos = new Catalogos(null,null,$_POST['descripcion'],$_SESSION['usuario_id']);
		Catalogos::saveTNegocio($catalogos);
		$_SESSION['mensaje']='Registro guardado satisfactoriamente';
		$this->showTNegocio();
		}
		
		

	}

    public function showTNegocio(){
    	require_once('Utils/paginationUtils.php');
		$catalogos=Catalogos::getAllTNegocio($_SESSION['usuario_id']);
		$lista_tnegocio="";
		$registros=10; // debe ser siempre par
		if (count($catalogos)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($catalogos),$_GET['boton'],$catalogos,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$catalogos,count($catalogos),0,1,1,1);
		}
		require_once('Views/Catalogos/show.php');
	}

	public function deleteTNegocio(){
		Catalogos::deleteTNegocio($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->showTNegocio();
	}

	//function show update page
	public function showupdate(){
		$id=$_GET['id'];
		$GET_PROJ_ID =  Catalogos::all($_SESSION['usuario_id']);
		$catalogos=Catalogos::getById($id);
		require_once('Views/Catalogos/update.php');  //name file (Proyecto/update.php) //name routing (residencia)
	}

	//function update
	public function updateTNegocio(){
		$catalogos=new Catalogos( $_POST['id'],null,$_POST['descripcion'], $_SESSION['usuario_id'] );
		Catalogos::update($catalogos);
		$_SESSION['mensaje']='Registro actualizado satisfactoriamente';
		$this->showTNegocio();
	}

	public function buscar(){
		require_once('Utils/paginationUtils.php');
		
		$filtros=array('descripcion'=>$_POST['descripcion'] , 'usuario'=>$_SESSION['usuario_id']);
		$poligono=Catalogos::allByFilter($filtros);
		$botones=0;
		$registros=10; // debe ser siempre par
		if(count($poligono)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($poligono),$_GET['boton'],$poligono,count($poligono));
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$poligono,count($poligono),0,1,1,1);
		}
		require_once('Views/Catalogos/show.php');
	}

	public function buscarEMedidor(){
		require_once('Utils/paginationUtils.php');
		$filtros=array('descripcion'=>$_POST['descripcion'] , 'usuario'=>$_SESSION['usuario_id']);
		$poligono=Catalogos::allByFilterM($filtros);
		$botones=0;
		$registros=10; // debe ser siempre par
		if(count($poligono)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($poligono),$_GET['boton'],$poligono, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$poligono,count($poligono),0,1,1,1);
		}
		require_once('Views/Catalogos/showEMedidor.php');
	}
	
}
?>
