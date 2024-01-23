<?php
/**
 * Controlador de Inspección
 * Autor: Roberto Mena
 * Sitio Web: https://motion.com.sv
 * Fecha: 28-10-2023
 */
if ($_SESSION) {
	session_start();
}
//require_once('Models/Inspeccion.php');
require_once('Models/InspeccionSolicitud.php');
require_once('Models/Residencia.php');
require_once('Models/Etapa.php');
require_once('Models/Poligono.php');
require_once('Models/Lote.php');
require_once('Models/Catalogos.php');
require_once('Models/EvaluacionV.php');
class InspeccionController
{
	function __construct()
	{
	}

	public function show()
	{
		require_once('Utils/paginationUtils.php');

		//$GET_PROJ_ID =  Inspeccion::all();
		$solicitud = Inspeccion::all();
		$registros = 10; // debe ser siempre par
		$numElementos = count($solicitud);
		if ($numElementos > $registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
			$paginationUtils = PaginationUtils::calcularPaginacion($registros, $numElementos, $_GET['boton'], $solicitud, 5);
		} else { // si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1, $solicitud, $numElementos, 0, 1, 1, 1);
		}
		require_once('Views/Inspeccion/show.php');
	}

	public function showSolicitudesByClientActive()
	{
		require_once('Utils/paginationUtils.php');

		$initArray = self::inicializarSolicitud($_POST);
		if ($initArray->getCodCliente() != null) {
			$filtros = self::inicializarSolicitud(array());
			$filtros->setCodCliente($initArray->getCodCliente());
			$solicitudes = InspeccionSolicitud::allByFilterCliente($filtros);
			// var_dump($solicitudes);
			// die();
			$registros = 10; // debe ser siempre par
			$numElementos = count($solicitudes);
			if ($numElementos > $registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
				$paginationUtils = PaginationUtils::calcularPaginacion($registros, $numElementos, $_GET['boton'], $solicitudes, 5);
			} else { // si no se presenta el paginador
				$paginationUtils = new PaginationUtils(1, $solicitudes, $numElementos, 0, 1, 1, 1);
			}
		}
		require_once('Views/Inspeccion/filtro.php');
	}

	public function register()
	{
		$id=$_GET['id'];
		$GET_SOLICITUD = InspeccionSolicitud::getById($id);
		$proyectoById = Residencia::getById($GET_SOLICITUD->getProyectoId());
		$etapaById = Etapa::getById($GET_SOLICITUD->getEtapaId());
		$poligonoById = Poligono::getById($GET_SOLICITUD->getPoligonoId());
		$loteById = Lote::getById($GET_SOLICITUD->getLoteId());
		$catInspeccionById = Catalogos::getMotivoInspeccionById($GET_SOLICITUD->getMtvInspeccionId());
		$catTipoNegocioById = Catalogos::getById($GET_SOLICITUD->getNegocioId());
		$filtros = self::inicializarSolicitud(array());
		$filtros->setProyectoId($proyectoById->getId());
		$filtros->setEtapaId($etapaById->getId());
		$filtros->setPoligonoId($poligonoById->getId());
		$filtros->setLoteId($loteById->getId());
		$lecturaByLote = EvaluacionV::getFilterBySolicitud($filtros);
		$catTiposNegocios = Catalogos::getTNegocioList();
		require_once('Views/Inspeccion/register.php');
	}

	public function save()
	{
		$inicializar = self::inicializarInspeccion($_POST);
		$inicializar->setIvFkUserIdInspector($_SESSION['usuario_id']);
		Inspeccion::save($inicializar);
		$_SESSION['mensaje'] = 'Inspeccion registrada correctamente';
		$this->show();
	}

	public function delete()
	{
		Inspeccion::delete($_GET['id']);
		$_SESSION['mensaje'] = 'Registro eliminado satisfactoriamente';
		$this->show();
	}

	//function show update page
	public function showupdate()
	{
		$id = $_GET['id'];
		$GET_PROJ_ID = Residencia::all($_SESSION['usuario_id']);
		$etapa = Etapa::getById($id);
		require_once('Views/Inspeccion/update.php');  //name file (Proyecto/update.php) //name routing (residencia)
	}

	//function update
	public function update()
	{
		$etapa = new Etapa($_POST['id'], $_POST['proyectoId'], $_POST['nombre'], $_SESSION['usuario_id'], $_POST['codigo']);
		Etapa::update($etapa);
		$_SESSION['mensaje'] = 'Registro actualizado satisfactoriamente';
		$this->show();
	}

	public function buscar()
	{
		require_once('Utils/paginationUtils.php');
		$GET_PROJ_ID = Residencia::all($_SESSION['usuario_id']);
		$etapa = Etapa::all($_SESSION['usuario_id']);
		$filtros = array('residencial' => $_POST['residencial'], 'usuario' => $_SESSION['usuario_id']);
		$etapa = Etapa::allByFilter($filtros);
		$botones = 0;
		$registros = 10; // debe ser siempre par
		if (count($etapa) > $registros) {
			$paginationUtils = PaginationUtils::calcularPaginacion($registros, count($etapa), $_GET['boton'], $etapa, 5);
		} else { // si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1, $etapa, count($etapa), 0, 1, 1, 1);
		}

		require_once('Views/Inspeccion/show.php');
	}

	public function inicializarSolicitud($arrayPost)
	{
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

	public function inicializarInspeccion($arrayPost){
		$id = isset($arrayPost['id']) ? $arrayPost['id'] :	null;
		$ivSolicitudId = isset($arrayPost['ivSolicitudId']) ? $arrayPost['ivSolicitudId'] : null;
		$ivSerieMedidor = isset($arrayPost['ivSerieMedidor']) ? $arrayPost['ivSerieMedidor'] : null;
		$ivLecturaAnterior = isset($arrayPost['ivLecturaAnterior']) ? $arrayPost['ivLecturaAnterior']	: null;
		$ivConsumo = isset($arrayPost['ivConsumo']) ? $arrayPost['ivConsumo'] : null;
		$ivCorreccionSerie = isset($arrayPost['ivCorreccionSerie']) ? $arrayPost['ivCorreccionSerie'] : null;
		$ivLecturaEnInspeccion = isset($arrayPost['ivLecturaEnInspeccion']) ? $arrayPost['ivLecturaEnInspeccion'] : null;
		$ivHabitada = isset($arrayPost['ivHabitada']) ? $arrayPost['ivHabitada'] :	null;
		$ivNegocio = isset($arrayPost['ivNegocio']) ? $arrayPost['ivNegocio'] : null;
		$ivFkTipoNegocioId = isset($arrayPost['ivFkTipoNegocioId']) ? $arrayPost['ivFkTipoNegocioId']	: null;
		$ivPLCuantosGiros = isset($arrayPost['ivPLCuantosGiros']) ? $arrayPost['ivPLCuantosGiros']	: null;
		$ivPLMarcaLitros = isset($arrayPost['ivPLMarcaLitros']) ? $arrayPost['ivPLMarcaLitros'] : null;
		$ivIEMAMedidor = isset($arrayPost['ivIEMAMedidor']) ? $arrayPost['ivIEMAMedidor'] : null;
		$ivIEMAValvula = isset($arrayPost['ivIEMAValvula']) ? $arrayPost['ivIEMAValvula'] : null;
		$ivIEMACajaMedidora = isset($arrayPost['ivIEMACajaMedidora']) ? $arrayPost['ivIEMACajaMedidora'] : null;
		$ivIEMATapadera = isset($arrayPost['ivIEMATapadera']) ? $arrayPost['ivIEMATapadera'] : null;
		$ivRespuesta = isset($arrayPost['ivRespuesta']) ? $arrayPost['ivRespuesta'] : null;
		$ivFkUserIdInspector = isset($arrayPost['ivFkUserIdInspector']) ? $arrayPost['ivFkUserIdInspector'] : null;
		$ivFirmaCliente = isset($arrayPost['ivFirmaCliente']) ? $arrayPost['ivFirmaCliente'] : null;
		$ivFechaVisita = isset($arrayPost['ivFechaVisita']) ? $arrayPost['ivFechaVisita'] : null;
		$ivDetalle = isset($arrayPost['ivDetalle']) ? $arrayPost['ivDetalle'] : null;
		$ivDetalleEspecificacion = isset($arrayPost['ivDetalleEspecificacion']) ? $arrayPost['ivDetalleEspecificacion'] : null;
		$inspeccion = new Inspeccion(
			$id, $ivSolicitudId, $ivSerieMedidor, $ivLecturaAnterior, $ivConsumo, $ivCorreccionSerie,
			$ivLecturaEnInspeccion, $ivHabitada, $ivNegocio, $ivFkTipoNegocioId, $ivPLCuantosGiros, $ivPLMarcaLitros,
			$ivIEMAMedidor, $ivIEMAValvula, $ivIEMACajaMedidora, $ivIEMATapadera, $ivRespuesta, $ivFkUserIdInspector,
			$ivFirmaCliente, $ivFechaVisita, $ivDetalle, $ivDetalleEspecificacion
		);
		return $inspeccion;
	}

	public function getDocumentInsId(){
		header("Location: Controllers/DocumentoInspeccion/docInsController.php");
	}
}
?>