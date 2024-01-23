<?php /**19-08-2022 SS El Salvador @Motion S.A. de C.V. */

if($_SESSION)
{
    session_start();
}
require_once('Models/Residencia.php');
class EtapaController
{
    function __construct(){}

    public function register(){
        $GET_PROJ_ID =  Residencia::all($_SESSION['usuario_id']);
		require_once('Views/Etapa/register.php');
	}

    public function save(){
		$existe=false;
		$consulta=Etapa::all($_SESSION['usuario_id']);
		foreach($consulta as $etapas)
		{
			if (strcmp($etapas->getNombre(),$_POST['nombre'])==0 && strcmp($etapas->getProyectoId(),$_POST['proyectoId'])==0) 
			{
				$existe=True;
			}
		}

		if(!$existe)
		{
			$etapa = new Etapa(null,$_POST['proyectoId'], $_POST['nombre'],$_SESSION['usuario_id'],$_POST['codigo']);
			Etapa::save($etapa);
			//var_dump($etapa);
			//die();
			$_SESSION['mensaje']='Registro guardado satisfactoriamente';
			$this->show();
		}
		else
		{
			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya existe un registro con este nombre!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';
			$this->register();
		}
		
	}

    public function show(){
    	require_once('Utils/paginationUtils.php');
		$GET_PROJ_ID =  Residencia::all($_SESSION['usuario_id']);
		$etapa=Etapa::all($_SESSION['usuario_id']);
		$lista_etapa="";
		$registros=10; // debe ser siempre par
		if (count($etapa)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($etapa),$_GET['boton'],$etapa,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$etapa,count($etapa),0,1,1,1);
		}
		require_once('Views/Etapa/show.php');
	}

	public function delete(){
		Etapa::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->show();
	}

	//function show update page
	public function showupdate(){
		$id=$_GET['id'];
		$GET_PROJ_ID =  Residencia::all($_SESSION['usuario_id']);
		$etapa=Etapa::getById($id);
		require_once('Views/Etapa/update.php');  //name file (Proyecto/update.php) //name routing (residencia)
	}

	//function update
	public function update(){
		$etapa=new Etapa( $_POST['id'],$_POST['proyectoId'], $_POST['nombre'], $_SESSION['usuario_id'],$_POST['codigo']);
		Etapa::update($etapa);
		$_SESSION['mensaje']='Registro actualizado satisfactoriamente';
		$this->show();
	}

	public function buscar(){
		require_once('Utils/paginationUtils.php');
		$GET_PROJ_ID =  Residencia::all($_SESSION['usuario_id']);
		$etapa=Etapa::all($_SESSION['usuario_id']);
		$filtros=array('residencial'=>$_POST['residencial'], 'usuario'=>$_SESSION['usuario_id']);
		$etapa=Etapa::allByFilter($filtros);
		$botones=0;
		$registros=10; // debe ser siempre par
		if(count($etapa)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($etapa),$_GET['boton'],$etapa, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$etapa,count($etapa),0,1,1,1);
		}
		
		require_once('Views/Etapa/show.php');
	}
}
?>