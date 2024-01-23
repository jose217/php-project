<?php
/**
 * Entity de Inspeccion Solicitud
 * Autor: Roberto Mena
 * Sitio Web: https://motion.com.sv
 * Fecha: 28-10-2023
 */
class Inspeccion
{
	const NAME_TABLA = "inspeccion_visita";
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
	private $ivDetalle = [];
	private $ivDetalleEspecificacion;

	function __construct($id, $ivSolicitudId, $ivSerieMedidor, $ivLecturaAnterior, $ivConsumo, $ivCorreccionSerie, $ivLecturaEnInspeccion, $ivHabitada, $ivNegocio, $ivFkTipoNegocioId, $ivPLCuantosGiros, $ivPLMarcaLitros, $ivIEMAMedidor, $ivIEMAValvula, $ivIEMACajaMedidora, $ivIEMATapadera, $ivRespuesta, $ivFkUserIdInspector, $ivFirmaCliente, $ivFechaVisita, $ivDetalle, $ivDetalleEspecificacion)
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
		$this->setIvDetalle($ivDetalle);
		$this->setIvDetalleEspecificacion($ivDetalleEspecificacion);
	}

	public static function delete($id)
	{
		$db = Db::getConnect();
		$query = $db->prepare('DELETE FROM ' . self::NAME_TABLA . ' WHERE id=:id ');
		$query->bindValue('id', $id);
		$query->execute();
	}

	public static function getById($id)
	{
		//buscar
		$db = Db::getConnect();
		$query = $db->prepare('SELECT * FROM ' . self::NAME_TABLA . ' WHERE id=:id');
		$query->bindValue('id', $id);
		$query->execute();
		//asignarlo al objeto 
		$entity = $query->fetch();
		$lista = new Inspeccion($entity['iv_id'], $entity['iv_fk_inspeccion_sol_id'], $entity['iv_serie_medidor'], $entity['iv_lectura_anterior'], $entity['iv_consumo'], $entity['iv_correccion_serie'], $entity['iv_lectura_en_inspeccion'], $entity['iv_habitada'], $entity['iv_negocio'], $entity['iv_fk_tipo_negocio_id'], $entity['iv_pl_cuantos_giros'], $entity['iv_pl_marca_litros'], $entity['iv_iema_medidor'], $entity['iv_iema_valvula'], $entity['iv_iema_caja_medidora'], $entity['iv_iema_tapadera'], $entity['iv_respuesta'], $entity['iv_fk_user_id_inspector'], $entity['iv_firma_cliente'], $entity['iv_fecha_visita'], $entity['iv_detalle'], $entity['iv_detalle_especificacion']);
		return $lista;
	}

	public static function allByUser($idUsuario)
	{
		$lista = [];
		$db = Db::getConnect();
		$sql = $db->prepare('SELECT * FROM ' . self::NAME_TABLA . ' WHERE usuario=:usuario order by id');
		$sql->bindParam(':usuario', $idUsuario);
		$sql->execute();
		foreach ($sql->fetchAll() as $entity) {
			$lista[] = new Inspeccion($entity['iv_id'], $entity['iv_fk_inspeccion_sol_id'], $entity['iv_serie_medidor'], $entity['iv_lectura_anterior'], $entity['iv_consumo'], $entity['iv_correccion_serie'], $entity['iv_lectura_en_inspeccion'], $entity['iv_habitada'], $entity['iv_negocio'], $entity['iv_fk_tipo_negocio_id'], $entity['iv_pl_cuantos_giros'], $entity['iv_pl_marca_litros'], $entity['iv_iema_medidor'], $entity['iv_iema_valvula'], $entity['iv_iema_caja_medidora'], $entity['iv_iema_tapadera'], $entity['iv_respuesta'], $entity['iv_fk_user_id_inspector'], $entity['iv_firma_cliente'], $entity['iv_fecha_visita'], $entity['iv_detalle'], $entity['iv_detalle_especificacion']);
		}
		return $lista;
	}

	public static function all()
	{
		$lista = [];
		$db = Db::getConnect();
		$sql = $db->prepare('SELECT * FROM ' . self::NAME_TABLA . ' order by iv_id DESC');
		$sql->execute();
		foreach ($sql->fetchAll() as $entity) {
			$lista[] = new Inspeccion($entity['iv_id'], $entity['iv_fk_inspeccion_sol_id'], $entity['iv_serie_medidor'], $entity['iv_lectura_anterior'], $entity['iv_consumo'], $entity['iv_correccion_serie'], $entity['iv_lectura_en_inspeccion'], $entity['iv_habitada'], $entity['iv_negocio'], $entity['iv_fk_tipo_negocio_id'], $entity['iv_pl_cuantos_giros'], $entity['iv_pl_marca_litros'], $entity['iv_iema_medidor'], $entity['iv_iema_valvula'], $entity['iv_iema_caja_medidora'], $entity['iv_iema_tapadera'], $entity['iv_respuesta'], $entity['iv_fk_user_id_inspector'], $entity['iv_firma_cliente'], $entity['iv_fecha_visita'], $entity['iv_detalle'], $entity['iv_detalle_especificacion']);
		}
		return $lista;
	}

	public static function save($entity)
	{
		$db = Db::getConnect();
		if ($entity->getId == null || $entity->getId == "") {
			$stgSql = 'INSERT INTO ' . self::NAME_TABLA . ' VALUES( NULL, :ivSolicitudId, :ivSerieMedidor, :ivLecturaAnterior, :ivConsumo, :ivCorreccionSerie, :ivLecturaEnInspeccion, :ivHabitada, :ivNegocio, :ivFkTipoNegocioId, :ivPLCuantosGiros, :ivPLMarcaLitros, :ivIEMAMedidor, :ivIEMAValvula, :ivIEMACajaMedidora, :ivIEMATapadera, :ivRespuesta, :ivFkUserIdInspector, :ivFirmaCliente, :ivFechaVisita, :ivDetalle, :ivDetalleEspecificacion)';
		}
		$save = $db->prepare($stgSql);
		$save->bindValue(':ivSolicitudId', $entity->getIvSolicitudId());
		$save->bindValue(':ivSerieMedidor', $entity->getIvSerieMedidor());
		$save->bindValue(':ivLecturaAnterior', $entity->getIvLecturaAnterior());
		$save->bindValue(':ivConsumo', $entity->getIvConsumo());
		$save->bindValue(':ivCorreccionSerie', $entity->getIvCorreccionSerie());
		$save->bindValue(':ivLecturaEnInspeccion', $entity->getIvLecturaEnInspeccion());
		$save->bindValue(':ivHabitada', $entity->getIvHabitada());
		$save->bindValue(':ivNegocio', $entity->getIvNegocio());
		$save->bindValue(':ivFkTipoNegocioId', $entity->getIvFkTipoNegocioId());
		$save->bindValue(':ivPLCuantosGiros', $entity->getIvPLCuantosGiros());
		$save->bindValue(':ivPLMarcaLitros', $entity->getIvPLMarcaLitros());
		$save->bindValue(':ivIEMAMedidor', $entity->getIvIEMAMedidor());
		$save->bindValue(':ivIEMAValvula', $entity->getIvIEMAValvula());
		$save->bindValue(':ivIEMACajaMedidora', $entity->getIvIEMACajaMedidora());
		$save->bindValue(':ivIEMATapadera', $entity->getIvIEMATapadera());
		$save->bindValue(':ivRespuesta', $entity->getIvRespuesta());
		$save->bindValue(':ivFkUserIdInspector', $entity->getIvFkUserIdInspector());
		$save->bindValue(':ivFirmaCliente', $entity->getIvFirmaCliente());
		$save->bindValue(':ivFechaVisita', $entity->getIvFechaVisita());
		$save->bindValue(':ivDetalle', $entity->getIvDetalle());
		$save->bindValue('ivDetalleEspecificacion',$entity->getIvDetalleEspecificacion());
		$save->execute();
	}

	public static function update($entity)
	{
		$db = Db::getConnect();
		if ($entity->getId() != null && $entity->getId() != "") {
			$stgSql = 'UPDATE ' . self::NAME_TABLA . ' SET iv_fk_inspeccion_sol_id = :ivSolicitudId, iv_serie_medidor = :ivSerieMedidor, iv_lectura_anterior = :ivLecturaAnterior, iv_consumo = :ivConsumo, iv_correccion_serie = :ivCorreccionSerie, iv_lectura_en_inspeccion = :ivLecturaEnInspeccion, iv_habitada = :ivHabitada, iv_negocio = :ivNegocio, iv_fk_tipo_negocio_id = :ivFkTipoNegocioId, iv_pl_cuantos_giros = :ivPLCuantosGiros, iv_pl_marca_litros = :ivPLMarcaLitros, iv_iema_medidor = :ivIEMAMedidor, iv_iema_valvula = :ivIEMAValvula, iv_iema_caja_medidora = :ivIEMACajaMedidora, iv_iema_tapadera = :ivIEMATapadera, iv_respuesta = :ivRespuesta, iv_fk_user_id_inspector = :ivFkUserIdInspector, iv_firma_cliente = :ivFirmaCliente, iv_fecha_visita = :ivFechaVisita, iv_detalle = :ivDetalle, iv_detalle_especificacion = :ivDetalleEspecificacion where iv_id = :id';
		}
		$save = $db->prepare($stgSql);
		$save->bindValue(':id', $entity->getId());
		$save->bindValue(':ivSolicitudId', $entity->getIvSolicitudId());
		$save->bindValue(':ivSerieMedidor', $entity->getIvSerieMedidor());
		$save->bindValue(':ivLecturaAnterior', $entity->getIvLecturaAnterior());
		$save->bindValue(':ivConsumo', $entity->getIvConsumo());
		$save->bindValue(':ivCorreccionSerie', $entity->getIvCorreccionSerie());
		$save->bindValue(':ivLecturaEnInspeccion', $entity->getIvLecturaEnInspeccion());
		$save->bindValue(':ivHabitada', $entity->getIvHabitada());
		$save->bindValue(':ivNegocio', $entity->getIvNegocio());
		$save->bindValue(':ivFkTipoNegocioId', $entity->getIvFkTipoNegocioId());
		$save->bindValue(':ivPLCuantosGiros', $entity->getIvPLCuantosGiros());
		$save->bindValue(':ivPLMarcaLitros', $entity->getIvPLMarcaLitros());
		$save->bindValue(':ivIEMAMedidor', $entity->getIvIEMAMedidor());
		$save->bindValue(':ivIEMAValvula', $entity->getIvIEMAValvula());
		$save->bindValue(':ivIEMACajaMedidora', $entity->getIvIEMACajaMedidora());
		$save->bindValue(':ivIEMATapadera', $entity->getIvIEMATapadera());
		$save->bindValue(':ivRespuesta', $entity->getIvRespuesta());
		$save->bindValue(':ivFkUserIdInspector', $entity->getIvFkUserIdInspector());
		$save->bindValue(':ivFirmaCliente', $entity->getIvFirmaCliente());
		$save->bindValue(':ivFechaVisita', $entity->getIvFechaVisita());
		$save->bindValue(':ivDetalle', $entity->getIvDetalle());
		$save->bindValue(':ivDetalleEspecificacion',$entity->getIvDetalleEspecificacion());
		$save->execute();
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

	public function getIvDetalle(){
		return $this->ivDetalle;
	}

	public function setIvDetalle($ivDetalle){

		$this->ivDetalle = $ivDetalle;
		
		return $this;
	}

	public function getIvDetalleEspecificacion(){
		
		return $this->ivDetalleEspecificacion;
	}

	public function setIvDetalleEspecificacion($ivDetalleEspecificacion){
		
		$this->ivDetalleEspecificacion = $ivDetalleEspecificacion;

		return $this;

	}
}