<?php
if(!isset($_SESSION))
{
    session_start();
}

class MesActivoController
{
	function __construct(){}

	public function register(){	
		require_once('Views/MActivo/register.php');
	}

	public function save(){
		$mesActivo=[];
		$mesActivo=MesActivo::all($_SESSION['usuario_id']);
		$registrado=false;
		$activo=true;
		$estado=implode(', ', $_POST['estado']);

		if($estado){
			$this->updateStatus();
		}
		foreach($mesActivo as $mes)
		{
			if(strcmp($mes->getMes(),$_POST['mes'])==0 && strcmp($mes->getAnnio(),$_POST['annio'])==0){
				$registrado=true;
			}
		}

		
		if(!$registrado)
		{
			
			$activo=new MesActivo( null, $_POST['annio'], $_POST['mes'], $estado, $_SESSION['usuario_id']);		
			MesActivo::save($activo);
			$_SESSION['mensaje']='Registro guardado satisfactoriamente';
			$this->show();
			
		}
		else
		{
			echo '<script>alert("Este mes ya esta registrado en la base de datos")</script>';
			$this->register();
			
		}
        
	}

	public function updateStatus(){
		$state='no';
		$updateState=new MesActivo(null,null,null,$state,$_SESSION['usuario_id']);
		MesActivo::updateStatus($updateState);
	}

	//muestra los pacientes por usuario
	public function show(){
		require_once('Utils/paginationUtils.php');
		$activo=MesActivo::all($_SESSION['usuario_id']);
		$lista_mes="";
		$registros=10; // debe ser siempre par
		if(count($activo)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($activo),$_GET['boton'],$activo, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$activo,count($activo),0,1,1,1);
		}
		require_once('Views/MActivo/show.php');
	}

	public function error(){
		require_once('Views/User/error.php');
	}

	public function showupdate(){
		$id=$_GET['id'];
		$activo=MesActivo::getById($id);
		require_once('Views/MActivo/update.php');
	}

	public function update(){
		$estado = $_POST['estado'];
		$activo=new MesActivo($_POST['id'], $_POST['annio'], $_POST['mes'], $estado[0], $_SESSION['usuario_id']);
		MesActivo::update($activo);
		$_SESSION['mensaje']='Registro actualizado satisfactoriamente';
		$this->show();
		//header('Location: index.php');
	}

	public function delete(){
		MesActivo::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->show();
		//header('Location: index.php');
	}
	

	//Retorna una lista de usuarios.
	public function buscarExtendida(){
		require_once('Utils/paginationUtils.php');
		$estado= $_POST['estado'];
		$filtros=array('annio'=>$_POST['annio'], 'mes'=>$_POST['mes'],'estado'=>$estado[0], 'usuario'=>$_SESSION['usuario_id']);
		$activo=MesActivo::allByFilter($filtros);
		$botones=0;
		$registros=10; // debe ser siempre par
		if(count($activo)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($activo),$_GET['boton'],$activo, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$activo,count($activo),0,1,1,1);
		}
		require_once('Views/MActivo/show.php');		
	}
}
