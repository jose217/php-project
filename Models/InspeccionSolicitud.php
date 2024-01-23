<?php
/**
 * Entity de Inspeccion Solicitud
 * Autor: Roberto Mena
 * Sitio Web: https://motion.com.sv
 * Fecha: 28-10-2023
 */
class InspeccionSolicitud
{
	const NAME_TABLA = "inspeccion_solicitud";

	private $id;
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
	private $habitada;
	private $negocio;
	private $negocioId;

	function __construct(
		$id,
		$proyectoId,
		$etapaId,
		$poligonoId,
		$loteId,
		$codCliente,
		$fechaSolicitud,
		$mtvInspeccionId,
		$especificacionMtv,
		$fechaCreacion,
		$estado,
		$fechaCierre,
		$usuario,
		$habitada,
		$negocio,
		$negocioId
	) {
		$this->setId($id);
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
		$this->setHabitada($habitada);
		$this->setNegocio($negocio);
		$this->setNegocioId($negocioId);
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
		$lista = new InspeccionSolicitud(
			$entity['id'],
			$entity['proyecto_id'],
			$entity['etapa_id'],
			$entity['poligono_id'],
			$entity['lote_id'],
			$entity['cod_cliente'],
			$entity['fecha_solicitud'],
			$entity['mtv_inspeccion_id'],
			$entity['especificacion_mtv'],
			$entity['fecha_creacion'],
			$entity['estado'],
			$entity['fecha_cierre'],
			$entity['usuario'],
			$entity['habitada'],
			$entity['negocio'],
			$entity['negocio_id']
		);
		return $lista;
	}

	public static function allByUser($idUsuario)
	{
		$lista = [];
		$db = Db::getConnect();
		$sql = $db->prepare('SELECT * FROM ' . self::NAME_TABLA . ' WHERE usuario=:usuario order by id');
		$sql->bindParam('usuario', $idUsuario);
		$sql->execute();
		foreach ($sql->fetchAll() as $entity) {
			$lista[] = new InspeccionSolicitud(
				$entity['id'],
				$entity['proyecto_id'],
				$entity['etapa_id'],
				$entity['poligono_id'],
				$entity['lote_id'],
				$entity['cod_cliente'],
				$entity['fecha_solicitud'],
				$entity['mtv_inspeccion_id'],
				$entity['especificacion_mtv'],
				$entity['fecha_creacion'],
				$entity['estado'],
				$entity['fecha_cierre'],
				$entity['usuario'],
				$entity['habitada'],
				$entity['negocio'],
				$entity['negocio_id']
			);
		}
		return $lista;
	}

	public static function all()
	{
		$lista = [];
		$db = Db::getConnect();
		$sql = $db->prepare('SELECT * FROM ' . self::NAME_TABLA . ' order by id');
		$sql->execute();
		foreach ($sql->fetchAll() as $entity) {
			$lista[] = new InspeccionSolicitud(
				$entity['id'],
				$entity['proyecto_id'],
				$entity['etapa_id'],
				$entity['poligono_id'],
				$entity['lote_id'],
				$entity['cod_cliente'],
				$entity['fecha_solicitud'],
				$entity['mtv_inspeccion_id'],
				$entity['especificacion_mtv'],
				$entity['fecha_creacion'],
				$entity['estado'],
				$entity['fecha_cierre'],
				$entity['usuario'],
				$entity['habitada'],
				$entity['negocio'],
				$entity['negocio_id']
			);
		}
		return $lista;
	}

	public static function save($entity)
	{
		$db = Db::getConnect();
		$stgSql = 
			'
			 INSERT 
				INTO 
					' .self::NAME_TABLA . ' 
			 VALUES
			 	( 
					NULL, 
					:proyectoId,
					:etapaId,
					:poligonoId,
					:loteId,
					:codCliente,
					:fechaSolicitud,
					:mtvInspeccionId,
					:especificacionMtv,
					:fechaCreacion,
					:estado,
					:fechaCierre, 
					:usuario,
					:habitada,
					:negocio,
					:negocioId
				)
			';
		$save = $db->prepare($stgSql);
		$save->bindValue('proyectoId', $entity->getProyectoId());
		$save->bindValue('etapaId', $entity->getEtapaId());
		$save->bindValue('poligonoId', $entity->getPoligonoId());
		$save->bindValue('loteId', $entity->getLoteId());
		$save->bindValue('codCliente', $entity->getCodCliente());
		$save->bindValue('fechaSolicitud', $entity->getFechaSolicitud());
		$save->bindValue('mtvInspeccionId', $entity->getMtvInspeccionId());
		$save->bindValue('especificacionMtv', $entity->getEspecificacionMtv());
		$save->bindValue('fechaCreacion', $entity->getFechaCreacion());
		$save->bindValue('estado', $entity->getEstado());
		$save->bindValue('fechaCierre', $entity->getFechaCierre());
		$save->bindValue('usuario', $entity->getUsuario());
		$save->bindValue('habitada', $entity->getHabitada());
		$save->bindValue('negocio', $entity->getNegocio());
		$save->bindValue('negocioId', $entity->getNegocioId());
		$save->execute();
	}

	public static function update($entity){
		$db = Db::getConnect();
		$stgSql = 
			'
			 UPDATE 
				' .self::NAME_TABLA . '
			 SET 
				cod_cliente = :codCliente, 
				fecha_solicitud = :fechaSolicitud, 
				mtv_inspeccion_id = :mtvInspeccionId, 
				especificacion_mtv = :especificacionMtv, 
				usuario = :usuario,
				habitada = :habitada,
				negocio = :negocio,
				negocio_id = :negocioId  
			 where 
			 	id=:id
			';
		$save = $db->prepare($stgSql);
		$save->bindValue('id', $entity->getId());
		$save->bindValue('codCliente', $entity->getCodCliente());
		$save->bindValue('fechaSolicitud', $entity->getFechaSolicitud());
		$save->bindValue('mtvInspeccionId', $entity->getMtvInspeccionId());
		$save->bindValue('especificacionMtv', $entity->getEspecificacionMtv());
		$save->bindValue('usuario', $entity->getUsuario());
		$save->bindValue('habitada', $entity->getHabitada());
		$save->bindValue('negocio', $entity->getNegocio());
		$save->bindValue('negocioId', $entity->getNegocioId());
		$save->execute();
	}

	public static function allByFilterCliente($filtros)
	{
		$lista = [];
		$db = Db::getConnect();
		$query = 'SELECT * FROM ' . self::NAME_TABLA . ' ';
		$filtro = '';

		//var_dump($filtros->getCodCliente());
		//die();

		if (!empty($filtros->getCodCliente())) {
			$filtro .= 'AND cod_cliente =' . $filtros->getCodCliente();
		}

		$query .= ' WHERE ' . substr($filtro, 4);
		$sql = $db->prepare($query);
		$sql->execute();
		foreach ($sql->fetchAll() as $entity) {
			$lista[] = new InspeccionSolicitud(
				$entity['id'],
				$entity['proyecto_id'],
				$entity['etapa_id'],
				$entity['poligono_id'],
				$entity['lote_id'],
				$entity['cod_cliente'],
				$entity['fecha_solicitud'],
				$entity['mtv_inspeccion_id'],
				$entity['especificacion_mtv'],
				$entity['fecha_creacion'],
				$entity['estado'],
				$entity['fecha_cierre'],
				$entity['usuario'],
				$entity['habitada'],
				$entity['negocio'],
				$entity['negocio_id']
			);
		}
		return $lista;
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

	public function getHabitada()
	{
		return $this->habitada;
	}

	public function setHabitada($habitada)
	{
		$this->habitada = $habitada;
		return $this;
	}

	public function getNegocio()
	{
		return $this->negocio;
	}

	public function setNegocio($negocio)
	{
		$this->negocio = $negocio;
		return $this;
	}

	public function getNegocioId()
	{
		return $this->negocioId;
	}

	public function setNegocioId($negocioId)
	{
		$this->negocioId = $negocioId;
		return $this;
	}

}