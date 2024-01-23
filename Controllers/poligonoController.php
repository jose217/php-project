<?php
/**
* Controlador PacienteController, para administrar los pacientes y datos relacionados
* Autor: Elivar Largo
* Sitio Web: wwww.ecodeup.com
* Fecha: 22-03-2017
*/
if(!isset($_SESSION))
    {
        session_start();
    }
require_once('Models/Etapa.php');
require_once('Models/Residencia.php');
require_once('Models/Poligono.php');
class PoligonoController
{
	function __construct(){}

	public function register(){	
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST = Poligono::list();
		$GET_PROJECT_ID=Residencia::all($_SESSION['usuario_id']);
		require_once('Views/Poligono/register.php');
	}


	public function save(){
		$existe=false;
		$consulta=Poligono::all($_SESSION['usuario_id']);
		foreach($consulta as $poligonos)
		{
			if (strcmp($poligonos->getNombre(),$_POST['nombre'])==0 && strcmp($poligonos->getEtapaId(),$_POST['etapaId'])==0) 
			{
				$existe=True;
			}
		}
		if(!$existe)
		{
			//var_dump($_POST['proyectoId']);
			$poligono=new Poligono( null, $_POST['nombre'], $_SESSION['usuario_id'],$_POST['proyectoId'], $_POST['etapaId'],null,null);
			Poligono::save($poligono);
			$_SESSION['mensaje']='Registro guardado satisfactoriamente';
			$this->show();
			//var_dump($poligono);
			//die();
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

	//muestra los pacientes por usuario
	public function show(){
		require_once('Utils/paginationUtils.php');
		$GET_PROJECT_ID=Residencia::all($_SESSION['usuario_id']);
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST = Poligono::list();

		$poligono=Poligono::allR();
		$lista_poligonos="";
		$registros=10; // debe ser siempre par
		if(count($poligono)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($poligono),$_GET['boton'],$poligono, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$poligono,count($poligono),0,1,1,1);
		}
		require_once('Views/Poligono/show.php');
	}

	public function error(){
		require_once('Views/User/error.php');
	}

	public function showupdate(){
		$id=$_GET['id'];
		$GET_ETAPA_ID=Etapa::list();
		$GET_PROJECT_ID=Residencia::all($_SESSION['usuario_id']);
		$GET_ETAPA_ID_V2=Etapa::all($_SESSION['usuario_id']);
		$poligono=Poligono::getById($id);
		require_once('Views/Poligono/update.php');
	}

	public function update(){
		$poligono = new Poligono($_POST['id'], $_POST['nombre'], $_SESSION['usuario_id'],$_POST['proyectoId'], $_POST['etapaId'],null,null);		
		Poligono::update($poligono);
		$_SESSION['mensaje']='Registro actualizado satisfactoriamente';
		$this->show();
		//header('Location: index.php');
	}

	public function delete(){
		Poligono::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->show();
		//header('Location: index.php');
	}
	/*
	//muestra un paciente por dui
	public function buscar(){
		// si cedula no es vacía busca por cedula
		if (!empty($_POST['cedula'])) {
			$lista_pacientes[]=Paciente::getByCedula($_POST['cedula']);
			$botones=0;
			require_once('Views/Paciente/show.php');
		}else{//si está vacía trae todos los registros
			$this->show();
		}
	}
*/
	//Retorna una lista de usuarios.
	public function buscarExtendida(){
		require_once('Utils/paginationUtils.php');
		$GET_PROJECT_ID=Residencia::all($_SESSION['usuario_id']);
		$GET_ETAPA_LIST=Etapa::list();
		$GET_POLIGONO_LIST = Poligono::list();

		
		

		$filtros=array('nombre'=>$_POST['nombre'], 'usuario'=>$_SESSION['usuario_id'], 'proyectoId'=>$_POST['proyectoId'], 'etapaId'=>$_POST['etapaId']);
		$poligono=Poligono::allByFilter($filtros);
		$botones=0;
		$registros=10; // debe ser siempre par
		if(count($poligono)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($poligono),$_GET['boton'],$poligono, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$poligono,count($poligono),0,1,1,1);
		}
		require_once('Views/Poligono/show.php');		
	}
}
