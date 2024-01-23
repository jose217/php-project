<?php
/**
* Controlador de Inspección Solicitud
* Autor: Roberto Mena
* Sitio Web: https://motion.com.sv
* Fecha: 28-10-2023
*/
if($_SESSION)
{
    session_start();
}
//require_once('Models/InspeccionSolicitud.php');
require_once('Models/Residencia.php');
require_once('Models/Etapa.php');
require_once('Models/Poligono.php');
require_once('Models/Lote.php');
require_once('Models/Catalogos.php');
class InspeccionSolicitudController
{
	const WF_ESTADO_ABIERTO = "ABIERTO";
	const WF_ESTADO_CERRADO = "CERRADO";
	const MNJ_ERROR_CODIGO_USUARIO = "Es requerido el código de cliente";
	const MNJ_ERROR_SOLICITUD_ACTIVA = "Este cliente ya tiene una solicitud activa";
    function __construct(){}

    public function show(){
    	require_once('Utils/paginationUtils.php');
		
		$GET_PROJ_ID =  InspeccionSolicitud::all();
		$solicitud = InspeccionSolicitud::allByUser($_SESSION['usuario_id']);
		$registros=10; // debe ser siempre par
		$numElementos = count($solicitud);
		if ($numElementos>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      		$paginationUtils = PaginationUtils::calcularPaginacion($registros,$numElementos,$_GET['boton'],$solicitud,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$solicitud,$numElementos,0,1,1,1);
		}
		require_once('Views/InspeccionSolicitud/show.php');
	}

    public function register(){
		$GET_PROYECTO_ID = Residencia::allR();
		$GET_ETAPA_LIST = Etapa::list();
		$GET_POLIGONO_LIST = Poligono::list();
		$GET_LOTE_LIST = Lote::list();
		$tipoNegocioList = Catalogos::getTNegocioList();
		$GET_MOTIVO_INSP_LIST = Catalogos::allMotivoInspeccion();
        //$GET_PROJ_ID = InspeccionSolicitud::all();
		// $get_cod_cliente = Lote::getCodClienteSolicitud();
		require_once('Views/InspeccionSolicitud/register.php');
	}

    public function save(){
		$solicitud = self::inicializar($_POST);
		if($solicitud->getCodCliente() == null){
			$_SESSION['mensaje']=self::MNJ_ERROR_CODIGO_USUARIO;
			$this->show();
		}
		$filtros = self::inicializar(array());
		$filtros->setCodCliente($solicitud->getCodCliente());
		$solicitudes = InspeccionSolicitud::allByFilterCliente($filtros);	
		$solicitudActiva = false;
		if($solicitudes != null){
			foreach($solicitudes as $row){
				if($row->getEstado() != self::WF_ESTADO_CERRADO){
					// $_SESSION['mensaje']=self::MNJ_ERROR_SOLICITUD_ACTIVA;
					$solicitudActiva = true;
					break;
				}
			}
			if($solicitudActiva){
				// $_SESSION['mensaje']=self::WF_ESTADO_ABIERTO;
				$_SESSION['mensaje']=self::MNJ_ERROR_SOLICITUD_ACTIVA;
			}
			$this->register();
		}
		else
		{
			$solicitud->setEstado(self::WF_ESTADO_ABIERTO);
			$solicitud->setUsuario($_SESSION['usuario_id']);
			$solicitud->setFechaCreacion(date("Y-m-d H:i:s"));
			$solicitud->setFechaSolicitud(date("Y-m-d H:i:s"));
			InspeccionSolicitud::save($solicitud);
			//var_dump($solicitud);
			//die();
			$_SESSION['mensaje']=self::WF_ESTADO_ABIERTO;
			$_SESSION['mensaje']="Solicitud registrada correctamente";
			$this->show();
		}
	}



	public function delete(){
		InspeccionSolicitud::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->show();
	}

	//function show update page
	public function showupdate(){
		$id=$_GET['id'];
		$solicitud = InspeccionSolicitud::getById($id);

		$GET_PROYECTO_ID = Residencia::getById($solicitud->getProyectoId());
		$GET_ETAPA_ID = Etapa::getById($solicitud->getEtapaId());
		$GET_POLIGONO_ID = Poligono::getById($solicitud->getPoligonoId());
		$GET_LOTE_ID = Lote::getById($solicitud->getLoteId());
		$tipoNegocioList = Catalogos::getTNegocioList();
		$GET_MOTIVO_INSP_LIST = Catalogos::allMotivoInspeccion();
		// call mthod for solicitud by id in the database

		require_once('Views/InspeccionSolicitud/update.php');
	}

	//function update
	public function update(){
		$actualizacion = self::inicializar($_POST);
		$actualizacion->setUsuario($_SESSION['usuario_id']);
		$actualizacion->setFechaSolicitud(date("Y-m-d H:i:s"));
		InspeccionSolicitud::update($actualizacion);
		$_SESSION['mensaje']='Solicitud actualizada correctamente';
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
		
		require_once('Views/InspeccionSolicitud/show.php');
	}

	public function inicializar($arrayPost){
		$id = isset($arrayPost['id']) ? $arrayPost['id'] : null;
		$proyecto = isset($arrayPost['proyectoId']) ? $arrayPost['proyectoId'] : null;
		$etapa = isset($arrayPost['etapaId']) ? $arrayPost['etapaId'] : null;
		$poligono = isset($arrayPost['poligonoId']) ? $arrayPost['poligonoId'] : null;
		$casa = isset($arrayPost['loteId']) ? $arrayPost['loteId'] : null;
		$cliente = isset($arrayPost['codCliente']) ? $arrayPost['codCliente'] : null;
		$fecha_solicitud = isset($arrayPost['fechaSolicitud']) ? $arrayPost['fechaSolicitud'] : null;
		$cbx_motivo_inspeccion = isset($arrayPost['cbx_motivoInspeccion']) ? $arrayPost['cbx_motivoInspeccion'] : null;
		$txa_motivo_insp = isset($arrayPost['txa_motivo_insp']) ? $arrayPost['txa_motivo_insp'] : null;
		$fecha_creacion = isset($arrayPost['fechaCreacion']) ? $arrayPost['fechaCreacion'] : null;
		$estado = isset($arrayPost['estado']) ? $arrayPost['estado'] : null;
		$fecha_cierre = isset($arrayPost['fechaCierre']) ? $arrayPost['fechaCierre'] : null;
		$usuario = isset($arrayPost['usuario']) ? $arrayPost['usuario'] : null;
		$habitada = isset($arrayPost['habitada']) ? $arrayPost['habitada'] : null;
		$negocio = isset($arrayPost['negocio']) ? $arrayPost['negocio'] : null;
		$tipoNegocio = isset($arrayPost['negocioId']) ? $arrayPost['negocioId'] : null;

		
		$solicitud = new InspeccionSolicitud(
			$id, 
			$proyecto, 
			$etapa, 
			$poligono, 
			$casa, 
			$cliente, 
			$fecha_solicitud, 
			$cbx_motivo_inspeccion, 
			$txa_motivo_insp, 
			$fecha_creacion, 
			$estado, 
			$fecha_cierre, 
			$usuario,
			$habitada,
			$negocio,
			$tipoNegocio
		);
		return $solicitud;
	}
}
?>