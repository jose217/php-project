<?php 
/**
* Entity de Inspeccion Solicitud
* Autor: Roberto Mena
* Sitio Web: https://motion.com.sv
* Fecha: 28-10-2023
*/
class InspeccionJoin
{

	private $id;
	private $ivSolicitudId;
	private $ivSerieMedidor;
	private $ivLecturaAnterior;
	private $ivConsumo;
	private $ivCorreccionSerie;
	private $ivLecturaEnInspeccion;
	private $ivHabitada;
	private $ivNegocio;
	private $ivFkTipoNegocioId;
	private $ivPLCuantosGiros;
	private $ivPLMarcaLitros;
	private $ivIEMAMedidor;
	private $ivIEMAValvula;
	private $ivIEMACajaMedidora;
	private $ivIEMATapadera;
	private $ivRespuesta;
	private $ivFkUserIdInspector;
	private $ivFirmaCliente;
	private $ivFechaVisita;

	private $proyectoId;
	private $etapaId;
	private $poligonoId;
	private $loteId;
	private $codCliente;
	private $fechaSolicitud;
	private $mtvInspeccionId;
	private $especificacionMtv;
	private $fechaCreacion;
	private $estado;
	private $fechaCierre;
	private $usuario;	

	function __construct($id, $ivSolicitudId, $ivSerieMedidor, $ivLecturaAnterior, $ivConsumo, $ivCorreccionSerie, $ivLecturaEnInspeccion, $ivHabitada, $ivNegocio, $ivFkTipoNegocioId, $ivPLCuantosGiros, $ivPLMarcaLitros, $ivIEMAMedidor, $ivIEMAValvula, $ivIEMACajaMedidora, $ivIEMATapadera, $ivRespuesta, $ivFkUserIdInspector, $ivFirmaCliente, $ivFechaVisita,$proyectoId,$etapaId,$poligonoId,$loteId,$codCliente,$fechaSolicitud,$mtvInspeccionId,$especificacionMtv,$fechaCreacion,$estado,$fechaCierre,$usuario)
	{
		$this->setId($id);
		$this->setIvSolicitudId($ivSolicitudId);
		$this->setIvSerieMedidor($ivSerieMedidor);
		$this->setIvLecturaAnterior($ivLecturaAnterior);
		$this->setIvConsumo($ivConsumo);
		$this->setIvCorreccionSerie($ivCorreccionSerie);
		$this->setIvLecturaEnInspeccion($ivLecturaEnInspeccion);
		$this->setIvHabitada($ivHabitada);
		$this->setIvNegocio($ivNegocio);
		$this->setIvFkTipoNegocioId($ivFkTipoNegocioId);
		$this->setIvPLCuantosGiros($ivPLCuantosGiros);
		$this->setIvPLMarcaLitros($ivPLMarcaLitros);
		$this->setIvIEMAMedidor($ivIEMAMedidor);
		$this->setIvIEMAValvula($ivIEMAValvula);
		$this->setIvIEMACajaMedidora($ivIEMACajaMedidora);
		$this->setIvIEMATapadera($ivIEMATapadera);
		$this->setIvRespuesta($ivRespuesta);
		$this->setIvFkUserIdInspector($ivFkUserIdInspector);
		$this->setIvFirmaCliente($ivFirmaCliente);
		$this->setIvFechaVisita($ivFechaVisita);
		$this->setProyectoId($proyectoId);
		$this->setEtapaId($etapaId);
		$this->setPoligonoId($poligonoId);
		$this->setLoteId($loteId);
		$this->setCodCliente($codCliente);
		$this->setFechaSolicitud($fechaSolicitud);
		$this->setMtvInspeccionId($mtvInspeccionId);
		$this->setEspecificacionMtv($especificacionMtv);
		$this->setFechaCreacion($fechaCreacion);
		$this->setEstado($estado);
		$this->setFechaCierre($fechaCierre);
		$this->setUsuario($usuario);			
	}

	public static function getJoinSolicitudByAllOrUser($id){

		$db=Db::getConnect();
		$query=$db->prepare('SELECT * FROM  WHERE id=:id');
		$query->bindValue('id',$id);
		$query->execute();
		//asignarlo al objeto 
		$entity = $query->fetch();
		$lista = new Inspeccion($entity['iv_id'], $entity['iv_fk_inspeccion_sol_id'], $entity['iv_serie_medidor'], $entity['iv_lectura_anterior'], $entity['iv_consumo'], $entity['iv_correccion_serie'], $entity['iv_lectura_en_inspeccion'], $entity['iv_habitada'], $entity['iv_negocio'], $entity['iv_fk_tipo_negocio_id'], $entity['iv_pl_cuantos_giros'], $entity['iv_pl_marca_litros'], $entity['iv_iema_medidor'], $entity['iv_iema_valvula'], $entity['iv_iema_caja_medidora'], $entity['iv_iema_tapadera'], $entity['iv_respuesta'], $entity['iv_fk_user_id_inspector'], $entity['iv_firma_cliente'], $entity['iv_fecha_visita'], $entity['proyecto_id'], $entity['etapa_id'], $entity['poligono_id'], $entity['lote_id'], $entity['cod_cliente']
		, $entity['fecha_solicitud'], $entity['mtv_inspeccion_id'], $entity['especificacion_mtv'], $entity['fecha_creacion'], $entity['estado'], $entity['nombre']
		, $entity['fecha_cierre'], $entity['usuario']);
		return $lista;
	}

	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of ivSolicitudId
	 */ 
	public function getIvSolicitudId()
	{
		return $this->ivSolicitudId;
	}

	/**
	 * Set the value of ivSolicitudId
	 *
	 * @return  self
	 */ 
	public function setIvSolicitudId($ivSolicitudId)
	{
		$this->ivSolicitudId = $ivSolicitudId;

		return $this;
	}

	/**
	 * Get the value of ivSerieMedidor
	 */ 
	public function getIvSerieMedidor()
	{
		return $this->ivSerieMedidor;
	}

	/**
	 * Set the value of ivSerieMedidor
	 *
	 * @return  self
	 */ 
	public function setIvSerieMedidor($ivSerieMedidor)
	{
		$this->ivSerieMedidor = $ivSerieMedidor;

		return $this;
	}

	/**
	 * Get the value of ivLecturaAnterior
	 */ 
	public function getIvLecturaAnterior()
	{
		return $this->ivLecturaAnterior;
	}

	/**
	 * Set the value of ivLecturaAnterior
	 *
	 * @return  self
	 */ 
	public function setIvLecturaAnterior($ivLecturaAnterior)
	{
		$this->ivLecturaAnterior = $ivLecturaAnterior;

		return $this;
	}

	/**
	 * Get the value of ivConsumo
	 */ 
	public function getIvConsumo()
	{
		return $this->ivConsumo;
	}

	/**
	 * Set the value of ivConsumo
	 *
	 * @return  self
	 */ 
	public function setIvConsumo($ivConsumo)
	{
		$this->ivConsumo = $ivConsumo;

		return $this;
	}

	/**
	 * Get the value of ivCorreccionSerie
	 */ 
	public function getIvCorreccionSerie()
	{
		return $this->ivCorreccionSerie;
	}

	/**
	 * Set the value of ivCorreccionSerie
	 *
	 * @return  self
	 */ 
	public function setIvCorreccionSerie($ivCorreccionSerie)
	{
		$this->ivCorreccionSerie = $ivCorreccionSerie;

		return $this;
	}

	/**
	 * Get the value of ivLecturaEnInspeccion
	 */ 
	public function getIvLecturaEnInspeccion()
	{
		return $this->ivLecturaEnInspeccion;
	}

	/**
	 * Set the value of ivLecturaEnInspeccion
	 *
	 * @return  self
	 */ 
	public function setIvLecturaEnInspeccion($ivLecturaEnInspeccion)
	{
		$this->ivLecturaEnInspeccion = $ivLecturaEnInspeccion;

		return $this;
	}

	/**
	 * Get the value of ivHabitada
	 */ 
	public function getIvHabitada()
	{
		return $this->ivHabitada;
	}

	/**
	 * Set the value of ivHabitada
	 *
	 * @return  self
	 */ 
	public function setIvHabitada($ivHabitada)
	{
		$this->ivHabitada = $ivHabitada;

		return $this;
	}

	/**
	 * Get the value of ivNegocio
	 */ 
	public function getIvNegocio()
	{
		return $this->ivNegocio;
	}

	/**
	 * Set the value of ivNegocio
	 *
	 * @return  self
	 */ 
	public function setIvNegocio($ivNegocio)
	{
		$this->ivNegocio = $ivNegocio;

		return $this;
	}

	/**
	 * Get the value of ivFkTipoNegocioId
	 */ 
	public function getIvFkTipoNegocioId()
	{
		return $this->ivFkTipoNegocioId;
	}

	/**
	 * Set the value of ivFkTipoNegocioId
	 *
	 * @return  self
	 */ 
	public function setIvFkTipoNegocioId($ivFkTipoNegocioId)
	{
		$this->ivFkTipoNegocioId = $ivFkTipoNegocioId;

		return $this;
	}

	/**
	 * Get the value of ivPLCuantosGiros
	 */ 
	public function getIvPLCuantosGiros()
	{
		return $this->ivPLCuantosGiros;
	}

	/**
	 * Set the value of ivPLCuantosGiros
	 *
	 * @return  self
	 */ 
	public function setIvPLCuantosGiros($ivPLCuantosGiros)
	{
		$this->ivPLCuantosGiros = $ivPLCuantosGiros;

		return $this;
	}

	/**
	 * Get the value of ivPLMarcaLitros
	 */ 
	public function getIvPLMarcaLitros()
	{
		return $this->ivPLMarcaLitros;
	}

	/**
	 * Set the value of ivPLMarcaLitros
	 *
	 * @return  self
	 */ 
	public function setIvPLMarcaLitros($ivPLMarcaLitros)
	{
		$this->ivPLMarcaLitros = $ivPLMarcaLitros;

		return $this;
	}

	/**
	 * Get the value of ivIEMAMedidor
	 */ 
	public function getIvIEMAMedidor()
	{
		return $this->ivIEMAMedidor;
	}

	/**
	 * Set the value of ivIEMAMedidor
	 *
	 * @return  self
	 */ 
	public function setIvIEMAMedidor($ivIEMAMedidor)
	{
		$this->ivIEMAMedidor = $ivIEMAMedidor;

		return $this;
	}

	/**
	 * Get the value of ivIEMAValvula
	 */ 
	public function getIvIEMAValvula()
	{
		return $this->ivIEMAValvula;
	}

	/**
	 * Set the value of ivIEMAValvula
	 *
	 * @return  self
	 */ 
	public function setIvIEMAValvula($ivIEMAValvula)
	{
		$this->ivIEMAValvula = $ivIEMAValvula;

		return $this;
	}

	/**
	 * Get the value of ivIEMACajaMedidora
	 */ 
	public function getIvIEMACajaMedidora()
	{
		return $this->ivIEMACajaMedidora;
	}

	/**
	 * Set the value of ivIEMACajaMedidora
	 *
	 * @return  self
	 */ 
	public function setIvIEMACajaMedidora($ivIEMACajaMedidora)
	{
		$this->ivIEMACajaMedidora = $ivIEMACajaMedidora;

		return $this;
	}

	/**
	 * Get the value of ivIEMATapadera
	 */ 
	public function getIvIEMATapadera()
	{
		return $this->ivIEMATapadera;
	}

	/**
	 * Set the value of ivIEMATapadera
	 *
	 * @return  self
	 */ 
	public function setIvIEMATapadera($ivIEMATapadera)
	{
		$this->ivIEMATapadera = $ivIEMATapadera;

		return $this;
	}

	/**
	 * Get the value of ivRespuesta
	 */ 
	public function getIvRespuesta()
	{
		return $this->ivRespuesta;
	}

	/**
	 * Set the value of ivRespuesta
	 *
	 * @return  self
	 */ 
	public function setIvRespuesta($ivRespuesta)
	{
		$this->ivRespuesta = $ivRespuesta;

		return $this;
	}

	/**
	 * Get the value of ivFkUserIdInspector
	 */ 
	public function getIvFkUserIdInspector()
	{
		return $this->ivFkUserIdInspector;
	}

	/**
	 * Set the value of ivFkUserIdInspector
	 *
	 * @return  self
	 */ 
	public function setIvFkUserIdInspector($ivFkUserIdInspector)
	{
		$this->ivFkUserIdInspector = $ivFkUserIdInspector;

		return $this;
	}

	/**
	 * Get the value of ivFirmaCliente
	 */ 
	public function getIvFirmaCliente()
	{
		return $this->ivFirmaCliente;
	}

	/**
	 * Set the value of ivFirmaCliente
	 *
	 * @return  self
	 */ 
	public function setIvFirmaCliente($ivFirmaCliente)
	{
		$this->ivFirmaCliente = $ivFirmaCliente;

		return $this;
	}

	/**
	 * Get the value of ivFechaVisita
	 */ 
	public function getIvFechaVisita()
	{
		return $this->ivFechaVisita;
	}

	/**
	 * Set the value of ivFechaVisita
	 *
	 * @return  self
	 */ 
	public function setIvFechaVisita($ivFechaVisita)
	{
		$this->ivFechaVisita = $ivFechaVisita;

		return $this;
	}


	/**
	 * Get the value of proyectoId
	 */ 
	public function getProyectoId()
	{
		return $this->proyectoId;
	}

	/**
	 * Set the value of proyectoId
	 *
	 * @return  self
	 */ 
	public function setProyectoId($proyectoId)
	{
		$this->proyectoId = $proyectoId;

		return $this;
	}

	/**
	 * Get the value of etapaId
	 */ 
	public function getEtapaId()
	{
		return $this->etapaId;
	}

	/**
	 * Set the value of etapaId
	 *
	 * @return  self
	 */ 
	public function setEtapaId($etapaId)
	{
		$this->etapaId = $etapaId;

		return $this;
	}

	/**
	 * Get the value of poligonoId
	 */ 
	public function getPoligonoId()
	{
		return $this->poligonoId;
	}

	/**
	 * Set the value of poligonoId
	 *
	 * @return  self
	 */ 
	public function setPoligonoId($poligonoId)
	{
		$this->poligonoId = $poligonoId;

		return $this;
	}

	/**
	 * Get the value of loteId
	 */ 
	public function getLoteId()
	{
		return $this->loteId;
	}

	/**
	 * Set the value of loteId
	 *
	 * @return  self
	 */ 
	public function setLoteId($loteId)
	{
		$this->loteId = $loteId;

		return $this;
	}

	/**
	 * Get the value of codCliente
	 */ 
	public function getCodCliente()
	{
		return $this->codCliente;
	}

	/**
	 * Set the value of codCliente
	 *
	 * @return  self
	 */ 
	public function setCodCliente($codCliente)
	{
		$this->codCliente = $codCliente;

		return $this;
	}

	/**
	 * Get the value of fechaSolicitud
	 */ 
	public function getFechaSolicitud()
	{
		return $this->fechaSolicitud;
	}

	/**
	 * Set the value of fechaSolicitud
	 *
	 * @return  self
	 */ 
	public function setFechaSolicitud($fechaSolicitud)
	{
		$this->fechaSolicitud = $fechaSolicitud;

		return $this;
	}

	/**
	 * Get the value of mtvInspeccionId
	 */ 
	public function getMtvInspeccionId()
	{
		return $this->mtvInspeccionId;
	}

	/**
	 * Set the value of mtvInspeccionId
	 *
	 * @return  self
	 */ 
	public function setMtvInspeccionId($mtvInspeccionId)
	{
		$this->mtvInspeccionId = $mtvInspeccionId;

		return $this;
	}

	/**
	 * Get the value of especificacionMtv
	 */ 
	public function getEspecificacionMtv()
	{
		return $this->especificacionMtv;
	}

	/**
	 * Set the value of especificacionMtv
	 *
	 * @return  self
	 */ 
	public function setEspecificacionMtv($especificacionMtv)
	{
		$this->especificacionMtv = $especificacionMtv;

		return $this;
	}

	/**
	 * Get the value of fechaCreacion
	 */ 
	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}

	/**
	 * Set the value of fechaCreacion
	 *
	 * @return  self
	 */ 
	public function setFechaCreacion($fechaCreacion)
	{
		$this->fechaCreacion = $fechaCreacion;

		return $this;
	}

	/**
	 * Get the value of estado
	 */ 
	public function getEstado()
	{
		return $this->estado;
	}

	/**
	 * Set the value of estado
	 *
	 * @return  self
	 */ 
	public function setEstado($estado)
	{
		$this->estado = $estado;

		return $this;
	}

	/**
	 * Get the value of fechaCierre
	 */ 
	public function getFechaCierre()
	{
		return $this->fechaCierre;
	}

	/**
	 * Set the value of fechaCierre
	 *
	 * @return  self
	 */ 
	public function setFechaCierre($fechaCierre)
	{
		$this->fechaCierre = $fechaCierre;

		return $this;
	}

	/**
	 * Get the value of usuario
	 */ 
	public function getUsuario()
	{
		return $this->usuario;
	}

	/**
	 * Set the value of usuario
	 *
	 * @return  self
	 */ 
	public function setUsuario($usuario)
	{
		$this->usuario = $usuario;

		return $this;
	}	
}