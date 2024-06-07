<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	//función que llama al controlador y su respectiva acción, que son pasados como parámetros
	function call($controller, $action){
		//importa el controlador desde la carpeta Controllers
		require_once('Controllers/' . $controller . 'Controller.php');
		//crea el controlador

		switch($controller){
			case 'usuario':
				require_once('Models/Usuario.php');
				$controller= new UsuarioController();
				break; 
			case 'libro':
				//require_once('Models/Poligono.php');
				$controller=new LibroController();
				break; 
			case 'bodega':
				require_once('Models/Bodega.php');
				$controller=new BodegaController();
				break;
			// case 'lote':
			// 	require_once('Models/Lote.php');
			// 	$controller=new LoteController();
			// 	break;
			// case 'evaluacionV':
			// 	require_once('Models/EvaluacionV.php');
			// 	$controller=new EvaluacionVController();
			// 	break;
			// case 'etapa':
			// 	require_once('Models/Etapa.php');
			// 	$controller=new EtapaController();
			// 	break;
			// case 'mesActivo':
			// 	require_once('Models/MesActivo.php');
			// 	$controller=new MesActivoController();
			// 	break;
			// case 'residencia':
			// 	require_once('Models/Residencia.php');
			// 	$controller=new ResidenciaController();
			// 	break;
			// case 'catalogos':
			// 	require_once('Models/Catalogos.php');
			// 	$controller=new catalogosController();
			// 	break;
			// case 'InspeccionSolicitud':
			// 	require_once('Models/InspeccionSolicitud.php');
			// 	$controller=new InspeccionSolicitudController();
			// 	break;
			// case 'Inspeccion':
			// 	require_once('Models/Inspeccion.php');
			// 	$controller=new InspeccionController();
			// 	break;												
		}
		//llama a la acción del controlador
		$controller->{$action }();
	}


	//array con los controladores y sus respectivas acciones
	$controllers= array(
						'usuario'=>['showUsuarios','register','save','showregister', 'update', 'delete', 'showLogin','login','logout','error','welcome','validarCedula','pay','confirmation','showConfirmation','recovery','RecEmailVerify','recoverySms','confirmationRecovery','confRecovery','buscar','showupdate'],
						'libro'=>['viewRegister'],
						'bodega'=>['showRegister','save','getMunicipio','show','showUpdate','update']				
						);
	//verifica que el controlador enviado desde index.php esté dentro del arreglo controllers
	if (array_key_exists($controller, $controllers)) {

		//verifica que el arreglo controllers con la clave que es la variable controller del index exista la acción
		if (in_array($action, $controllers[$controller])) {
			//llama  la función call y le pasa el controlador a llamar y la acción (método) que está dentro del controlador
			if (isset($_SESSION['usuario'])){//ingresa sólo cuando el usuario tiene sesión abierta
				call($controller, $action);}
			elseif($controller=='usuario'&&($action=='showLogin'||$action=='login'||$action=='register'||$action=='save'||$action=='confirmation'||$action=='showConfirmation'||$action=='recovery'||$action=='RecEmailVerify'||$action=='recoverySms'||$action=='confirmationRecovery'||$action=='confRecovery')){// ingresa a páginas que no necesitam sesión de usuario
				call($controller, $action);
			}else{//página que indica que no hay permisos
				call($controller, 'error');
			}
		}else{
			call('usuario', 'error');
		}
	}else{// le pasa el nombre del controlador y la pagina de error
		call('usuario', 'error');
	}
?>