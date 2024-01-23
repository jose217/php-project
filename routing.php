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
			case 'poligono':
				require_once('Models/Poligono.php');
				$controller=new PoligonoController();
				break; 
			case 'lote':
				require_once('Models/Lote.php');
				$controller=new LoteController();
				break;
			case 'evaluacionV':
				require_once('Models/EvaluacionV.php');
				$controller=new EvaluacionVController();
				break;
			case 'etapa':
				require_once('Models/Etapa.php');
				$controller=new EtapaController();
				break;
			case 'mesActivo':
				require_once('Models/MesActivo.php');
				$controller=new MesActivoController();
				break;
			case 'residencia':
				require_once('Models/Residencia.php');
				$controller=new ResidenciaController();
				break;
			case 'catalogos':
				require_once('Models/Catalogos.php');
				$controller=new catalogosController();
				break;
			case 'InspeccionSolicitud':
				require_once('Models/InspeccionSolicitud.php');
				$controller=new InspeccionSolicitudController();
				break;
			case 'Inspeccion':
				require_once('Models/Inspeccion.php');
				$controller=new InspeccionController();
				break;												
		}
		//llama a la acción del controlador
		$controller->{$action }();
	}


	//array con los controladores y sus respectivas acciones
	$controllers= array(
						'usuario'=>['showUsuarios','register','save','showregister', 'update', 'delete', 'showLogin','login','logout','error','welcome','validarCedula','pay','confirmation','showConfirmation','recovery','RecEmailVerify','recoverySms','confirmationRecovery','confRecovery','buscar','showupdate'],
						'poligono'=>['register','registerV2','save', 'show', 'showupdate','update', 'delete','buscar','buscarExtendida'],
						'lote'=>['register','save', 'show', 'showupdate','update', 'delete','reporteHistorico','buscar','buscarExtendida','registerV2','savecontinue','add'],
						'evaluacionV'=>['register','showUpdateTec','save','savecontinue','show','delete','deleteTec','showupdate','update','updateTec','savelastnumber','updateNewNumber','buscarExtendida','showHistoCambios','buscarHistorial','selectPorMes','selectPorMesTec','showLecturaEMP','registerTec','saveTec','savecontinueTec','allR','buscarExtendidaTec','saveObservation','generateExcel','showGenerateReport'],
						'etapa'=>['register','save','registerV2','show','update','delete','showupdate','buscar'],
						'residencia'=>['register','save','registerV2','show','delete','update','showupdate','buscar'],  
						'mesActivo'=>['register','save','registerV2','show','delete','update','updateStatus','buscarExtendida','showupdate'],
						'catalogos'=>['registerTNegocio','saveTipoNegocio','deleteTNegocio','showTNegocio','updateTNegocio','showBusquedaTN',
										'showEMedidor','registerEMedidor','saveEMedidor','deleteEMedidor','updateEMedidor','buscarEMedidor','showupdateEMedidor'
										,'buscar', 'show','update','showupdate',
										'showMotivoInspeccion','updateMotivoInspeccion','registerMotivoInspeccion','saveMotivoInspeccion','deleteMotivoInspeccion','buscarMotivoInspeccion','showupdateMotivoInspeccion'],
						'InspeccionSolicitud'=>['register','save','show','delete','update','updateStatus','buscarExtendida','showupdate'],
						'Inspeccion'=>['register','save','show','delete','update','updateStatus','buscarExtendida','showupdate','showSolicitudesByClientActive', 'getDocumentInsId']				
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