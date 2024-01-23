<?php /**19-08-2022 SS El Salvador @Motion S.A. de C.V. */

if($_SESSION)
{
    session_start();
}
class ResidenciaController
{
    function __construct(){}

    public function register(){
		require_once('Views/Proyecto/register.php');
	}


    public function save(){
		$existe=false;
		$residenciales=Residencia::all($_SESSION['usuario_id']);
		foreach($residenciales as $residencias)
		{
			if (strcmp($residencias->getNombre(),$_POST['nombre'])==0) 
			{
				$existe=True;
			}
		}
		if(!$existe)
		{
			$array = new Residencia(null, $_POST['nombre'],$_SESSION['usuario_id'],$_POST['codigo']);
			Residencia::save($array);
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
		$proyecto=Residencia::all($_SESSION['usuario_id']);
		$lista_proyectos="";
		$registros=10; // debe ser siempre par
		if (count($proyecto)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($proyecto),$_GET['boton'],$proyecto,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$proyecto,count($proyecto),0,1,1,1);
		}
		require_once('Views/Proyecto/show.php');
	}

	//function delete
	public function delete(){
		Residencia::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->show();
	}

	//function show update page
	public function showupdate(){
		$id=$_GET['id'];
		$residencia=Residencia::getById($id);
		require_once('Views/Proyecto/update.php');  //name file (Proyecto/update.php) //name routing (residencia)
	}

	//function update
	public function update(){
		$residencia=new Residencia($_POST['id'], $_POST['nombre'], $_SESSION['usuario_id'], $_POST['codigo']);
		Residencia::update($residencia);
		$_SESSION['mensaje']='Registro actualizado satisfactoriamente';
		$this->show();
		//var_dump($residencia);
		//die();
	}

	//function search

	public function buscar(){
		require_once('Utils/paginationUtils.php');
		
		$filtros=array('nombre'=>$_POST['nombre'], 'usuario'=>$_SESSION['usuario_id']);
		$residencia=Residencia::allByFilter($filtros);
		$botones=0;
		$registros=10; // debe ser siempre par
		if(count($residencia)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($residencia),$_GET['boton'],$residencia, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$residencia,count($residencia),0,1,1,1);
		}
		require_once('Views/Proyecto/show.php');
	}
}
?>