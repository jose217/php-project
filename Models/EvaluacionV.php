<?php 
/**
* Modelo para el acceso a la base de datos y funciones CRUD
* Autor: Elivar Largo
* Sitio Web: wwww.ecodeup.com
*/
class EvaluacionV
{
	private $id;
	private $proyectoId;
	private $etapaId;
	private $poligonoId;
	private $loteId;
	private $numeroSerieMedidor;
	private $lecturaFinal;
	private $estadoMedidor;
	private $estadoVivienda;
	private $tipoVivienda;
	private $tipoNegocio;
	private $usuario;
	private $observaciones;
	private $mesActivo;
	private $fechaIngreso;
	private $fechaModificacion;
	private $ultimaLectura;
	private $consumo;

	function __construct($id, $proyectoId, $etapaId, $poligonoId, $loteId, $numeroSerieMedidor, $lecturaFinal, $estadoMedidor, $estadoVivienda, $tipoVivienda, $tipoNegocio,$usuario, $observaciones, $mesActivo, $fechaIngreso, $fechaModificacion, $ultimaLectura, $consumo)
	{
		$this->setId($id);
		$this->setProyectoId($proyectoId);
		$this->setEtapaId($etapaId);
		$this->setPoligonoId($poligonoId);
		$this->setLoteId($loteId);
		$this->setNumSerieMedidor($numeroSerieMedidor);
		$this->setLecturaFinal($lecturaFinal);
		$this->setEstadoMedidor($estadoMedidor);
		$this->setEstadoVivienda($estadoVivienda);
		$this->setTipoVivienda($tipoVivienda);
		$this->setTipoNegocio($tipoNegocio);
		$this->setUsuario($usuario);
		$this->setObservaciones($observaciones);
		$this->setMesActivo($mesActivo);
		$this->setFechaIngreso($fechaIngreso);
		$this->setFechaModificacion($fechaModificacion);
		$this->setUltimaLectura($ultimaLectura);
		$this->setConsumo($consumo);
	}



	//Getters y Setters
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getProyectoId(){
		return $this->proyectoId;
	}

	public function setProyectoId($proyectoId){
		$this->proyectoId = $proyectoId;
	}

	public function getEtapaId(){
		return $this->etapaId;
	}

	public function setEtapaId($etapaId){
		$this->etapaId = $etapaId;
	}

	public function getPoligonoId(){
		return $this->poligonoId;
	}

	public function setPoligonoId($poligonoId){
		$this->poligonoId = $poligonoId;
	}

	public function getLoteId(){
		return $this->loteId;
	}

	public function setLoteId($loteId){
		$this->loteId = $loteId;
	}

	public function getNumSerieMedidor(){
		return $this->numeroSerieMedidor;
	}

	public function setNumSerieMedidor($numeroSerieMedidor){
		$this->numeroSerieMedidor = $numeroSerieMedidor;
	}

	public function getLecturaFinal(){
		return $this->lecturaFinal;
	}

	public function setLecturaFinal($lecturaFinal){
		$this->lecturaFinal = $lecturaFinal;
	}

	public function getEstadoMedidor(){
		return $this->estadoMedidor;
	}

	public function setEstadoMedidor($estadoMedidor){
		$this->estadoMedidor = $estadoMedidor;
	}

	public function getEstadoVivienda(){
		return $this->estadoVivienda;
	}

	public function setEstadoVivienda($estadoVivienda){
		$this->estadoVivienda = $estadoVivienda;
	}

	public function getTipoVivienda(){
		return $this->tipoVivienda;
	}

	public function setTipoVivienda($tipoVivienda){
		$this->tipoVivienda = $tipoVivienda;
	}

	public function getTipoNegocio(){
		return $this->tipoNegocio;
	}

	public function setTipoNegocio($tipoNegocio){
		$this->tipoNegocio = $tipoNegocio;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getObservaciones(){
		return $this->observaciones;
	}

	public function setObservaciones($observaciones){
		$this->observaciones=$observaciones;
	}

	public function getMesActivo(){
		return $this->mesActivo;
	}

	public function setMesActivo($mesActivo){
		$this->mesActivo=$mesActivo;
	}

	public function getFechaIngreso(){
		return $this->fechaIngreso;
	}

	public function setFechaIngreso($fechaIngreso){
		$this->fechaIngreso=$fechaIngreso;
	}

	public function getFechaModificacion(){
		return $this->fechaModificacion;
	}

	public function setFechaModificacion($fechaModificacion){
		$this->fechaModificacion=$fechaModificacion;
	}

	public function getUltimaLectura(){
		return $this->ultimaLectura;
	}

	public function setUltimaLectura($ultimaLectura){
		$this->ultimaLectura=$ultimaLectura;
	}

	public function getConsumo()
	{
		return $this->consumo;
	}

	public function setConsumo($consumo){
		$this->consumo=$consumo;
	}


	public function getDataArray(){
		return array('id'=>$this->id,
					'proyectoId'=>$this->proyectoId,
					'etapaId'=>$this->etapaId,
					'poligonoId'=>$this->poligonoId,
					'loteId'=>$this->loteId,
					'numeroSerieMedidor'=>$this->numeroSerieMedidor,
					'lecturaFinal'=>$this->lecturaFinal,
					'estadoMedidor'=>$this->estadoMedidor,
					'etadoVivienda'=>$this->estadoVivienda,
					'tipoVivienda'=>$this->tipoVivienda,
					'tipoNegocio'=>$this->tipoNegocio,
					'usuario'=>$this->usuario,
					'observaciones'=>$this->observaciones,
					'mesActivo'=>$this->mesActivo,
					'fechaIngreso'=>$this->fechaIngreso,
					'fechaModificacion'=>$this->fechaModificacion,
					'ultimaLectura'=>$this->ultimaLectura,
					'consumo'=>$this->consumo);
	}
	//opciones CRUD
	//la función para registrar una consulta
	public static function save($evaluacion){
		$db=Db::getConnect();
		$insert=$db->prepare('INSERT INTO evaluacion_vivienda VALUES(NULL, :proyectoId, :etapaId, :poligonoId, :loteId, :numeroSerieMedidor, :lecturaFinal, :estadoMedidor, :estadoVivienda, :tipoVivienda, :tipoNegocio,:usuario,:observaciones, :mesActivo, :fechaIngreso, :fechaModificacion, :ultimaLectura, :consumo)');
		$insert->bindValue('proyectoId',$evaluacion->getProyectoId());
		$insert->bindValue('etapaId',$evaluacion->getEtapaId());
		$insert->bindValue('poligonoId',$evaluacion->getPoligonoId());
		$insert->bindValue('loteId',$evaluacion->getLoteId());
		$insert->bindValue('numeroSerieMedidor',$evaluacion->getNumSerieMedidor());
		$insert->bindValue('lecturaFinal',$evaluacion->getLecturaFinal());
		$insert->bindValue('estadoMedidor',$evaluacion->getEstadoMedidor());
		$insert->bindValue('estadoVivienda',$evaluacion->getEstadoVivienda());
		$insert->bindValue('tipoVivienda',$evaluacion->getTipoVivienda());
		$insert->bindValue('tipoNegocio',$evaluacion->getTipoNegocio());
		$insert->bindValue('usuario',$evaluacion->getUsuario());
		$insert->bindValue('observaciones',$evaluacion->getObservaciones());
		$insert->bindValue('mesActivo',$evaluacion->getMesActivo());
		$insert->bindValue('fechaIngreso',$evaluacion->getFechaIngreso());
		$insert->bindValue('fechaModificacion',$evaluacion->getFechaModificacion());
		$insert->bindValue('ultimaLectura',$evaluacion->getUltimaLectura());
		$insert->bindValue('consumo', $evaluacion->getConsumo());
		$insert->execute();
	}

	public static function update($evaluacion){
		$db=Db::getConnect();
		$insert=$db->prepare('UPDATE evaluacion_vivienda SET proyecto_id=:proyectoId, etapa_id=:etapaId, poligono_id=:poligonoId, lote_id=:loteId, numero_serie_medidor=:numeroSerieMedidor, lectura_final=:lecturaFinal, estado_medidor_id=:estadoMedidor, estado_vivienda=:estadoVivienda, tipo_vivienda=:tipoVivienda, tipo_negocio_id=:tipoNegocio, usuario=:usuario,observaciones=:observaciones, mes_activo_id=:mesActivo, fecha_creacion=:fechaIngreso, fecha_modificacion=:fechaModificacion,lectura_anterior=:ultimaLectura, consumo=:consumo WHERE id=:id');
		$insert->bindValue('id',$evaluacion->getId());
		$insert->bindValue('proyectoId',$evaluacion->getProyectoId());
		$insert->bindValue('etapaId',$evaluacion->getEtapaId());
		$insert->bindValue('poligonoId',$evaluacion->getPoligonoId());
		$insert->bindValue('loteId',$evaluacion->getLoteId());
		$insert->bindValue('numeroSerieMedidor',$evaluacion->getNumSerieMedidor());
		$insert->bindValue('lecturaFinal',$evaluacion->getLecturaFinal());
		$insert->bindValue('estadoMedidor',$evaluacion->getEstadoMedidor());
		$insert->bindValue('estadoVivienda',$evaluacion->getEstadoVivienda());
		$insert->bindValue('tipoVivienda',$evaluacion->getTipoVivienda());
		$insert->bindValue('tipoNegocio',$evaluacion->getTipoNegocio());
		$insert->bindValue('usuario',$evaluacion->getUsuario());
		$insert->bindValue('observaciones',$evaluacion->getObservaciones());
		$insert->bindValue('mesActivo',$evaluacion->getMesActivo());
		$insert->bindValue('fechaIngreso',$evaluacion->getFechaIngreso());
		$insert->bindValue('fechaModificacion',$evaluacion->getFechaModificacion());
		$insert->bindValue('ultimaLectura',$evaluacion->getUltimaLectura());
		$insert->bindValue('consumo', $evaluacion->getConsumo());
		$insert->execute();
	}

	//función para obtener todas las consultas
	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM evaluacion_vivienda WHERE usuario=:id order by id DESC' );
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$lista[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $lista;
	}

	public static function limitRepetido(){
		$lista ='';
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM evaluacion_vivienda ORDER By id DESC LIMIT 1');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$arreglo= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
			$lista.=json_encode($arreglo->getDataArray()).','; 
		}
		return substr($lista,0,-1);
	}

	// public static function getListConsumo(){
	// 	$lista ='';
	// 	$db=Db::getConnect();
	// 	$sql=$db->prepare('SELECT * FROM evaluacion_vivienda ORDER By id DESC LIMIT 2');
	// 	$sql->execute();

	// 	// carga en la $listaPacientes cada registro desde la base de datos
	// 	foreach ($sql->fetchAll() as $evaluacion) {
	// 		$arreglo= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
	// 		$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
	// 		$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
	// 		$lista.=json_encode($arreglo->getDataArray()).','; 
	// 	}
	// 	return substr($lista,0,-1);
	// }

	public static function list(){
		$lista ='';
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM evaluacion_vivienda' );
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$arreglo= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
			$lista.=json_encode($arreglo->getDataArray()).','; 
		}
		return substr($lista,0,-1);
	}

	public static function allR(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM evaluacion_vivienda order by id DESC' );
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$lista[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $lista;
	}


	public static function delete($id){
		//var_dump($id);
		//die();
		$db=Db::getConnect();

		// elimina en cascada

		//eliminar registros 
		$delete=$db->prepare('DELETE FROM evaluacion_vivienda WHERE ID=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}

	// //la función para obtener una consulta por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM evaluacion_vivienda WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto usuario
		$evaluacion=$select->fetch();
		$evaluacionV = new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
		$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
		$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		//var_dump($usuario);
		//die();
		return $evaluacionV;
	}


	public static function allByFilter($lectura){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM evaluacion_vivienda';
		$filtro = '';
		if (array_key_exists('proyectoId',$lectura) && !empty($lectura['proyectoId']))
		{
			$filtro.=' AND proyecto_id LIKE \'%'.$lectura['proyectoId'].'%\'';
		}
		if (array_key_exists('etapaId',$lectura) && !empty($lectura['etapaId']))
		{
			$filtro.=' AND etapa_id LIKE \'%'.$lectura['etapaId'].'%\'';
		}
		if (array_key_exists('poligonoId',$lectura) && !empty($lectura['poligonoId']))
		{
			$filtro.=' AND poligono_id LIKE \'%'.$lectura['poligonoId'].'%\'';
		}
		if (array_key_exists('loteId',$lectura) && !empty($lectura['loteId']))
		{
			$filtro.=' AND lote_id LIKE \'%'.$lectura['loteId'].'%\'';
		}
		if(array_key_exists('usuario',$lectura) && !empty($lectura['usuario']))
		{
			$filtro.=' AND usuario = '.$lectura['usuario'];			
		}
		// if(array_key_exists('mesActivo',$lectura) && !empty($lectura['mesActivo']))
		// {
		// 	$filtro.=' AND mes_activo = '.$lectura['mesActivo'];			
		// }

		$query.=' WHERE '.substr($filtro, 5);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$listaFiltro[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $listaFiltro;
	}


	public static function allByFilterSelect($lectura){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM evaluacion_vivienda';
		$filtro = '';
		if (array_key_exists('CategoriaActivo',$lectura) && !empty($lectura['CategoriaActivo']))
		{
			$filtro.=' AND mes_activo_id LIKE \'%'.$lectura['CategoriaActivo'].'%\'';
		}
		if(array_key_exists('usuario',$lectura) && !empty($lectura['usuario']))
		{
			$filtro.=' AND usuario = '.$lectura['usuario'];			
		}
		// if(array_key_exists('mesActivo',$lectura) && !empty($lectura['mesActivo']))
		// {
		// 	$filtro.=' AND mes_activo = '.$lectura['mesActivo'];			
		// }

		$query.=' WHERE '.substr($filtro, 5);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$listaFiltro[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $listaFiltro;
	}

	public static function allByHistory($lectura){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM evaluacion_vivienda';
		$filtro = '';
		if (array_key_exists('proyectoId',$lectura) && !empty($lectura['proyectoId']))
		{
			$filtro.=' AND proyecto_id LIKE \'%'.$lectura['proyectoId'].'%\'';
		}
		if (array_key_exists('etapaId',$lectura) && !empty($lectura['etapaId']))
		{
			$filtro.=' AND etapa_id LIKE \'%'.$lectura['etapaId'].'%\'';
		}
		if (array_key_exists('poligonoId',$lectura) && !empty($lectura['poligonoId']))
		{
			$filtro.=' AND poligono_id LIKE \'%'.$lectura['poligonoId'].'%\'';
		}
		if (array_key_exists('loteId',$lectura) && !empty($lectura['loteId']))
		{
			$filtro.=' AND lote_id LIKE \'%'.$lectura['loteId'].'%\'';
		}
		if (array_key_exists('numeroSerieMedidor',$lectura) && !empty($lectura['numeroSerieMedidor']))
		{
			$filtro.=' AND numero_serie_medidor LIKE \'%'.$lectura['numeroSerieMedidor'].'%\'';
		}
		if (array_key_exists('fechaIngreso',$lectura) && !empty($lectura['fechaIngreso']))
		{
			$filtro.=' AND fecha_creacion LIKE \'%'.$lectura['fechaIngreso'].'%\'';
		}
		if(array_key_exists('usuario',$lectura) && !empty($lectura['usuario']))
		{
			$filtro.=' AND usuario LIKE \'%'.$lectura['usuario'].'%\'';			
		}
		// if(array_key_exists('mesActivo',$lectura) && !empty($lectura['mesActivo']))
		// {
		// 	$filtro.=' AND mes_activo = '.$lectura['mesActivo'];			
		// }

		$query.=' WHERE '.substr($filtro, 5);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$listaFiltro[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $listaFiltro;
	}
	
	//funcion para btener el ultimo registro ingresado por el usuario
	
	public static function ultimoRegistro($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM evaluacion_vivienda WHERE usuario=:id order by id DESC LIMIT 1 ');
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$lista[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $lista;
	}


	public static function reportByMont($lectura){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM evaluacion_vivienda';
		$filtro = '';
		if (array_key_exists('proyectoId',$lectura) && !empty($lectura['proyectoId']))
		{
			$filtro.=' AND proyecto_id = '.$lectura['proyectoId'];
		}
		if(array_key_exists('mesActivo',$lectura) && !empty($lectura['mesActivo']))
		{
			$filtro.=' AND mes_activo_id = '.$lectura['mesActivo'];			
		}

		$query.=' WHERE '.substr($filtro, 5);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$listaFiltro[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $listaFiltro;
	}

	public static function getFilterBySolicitud($filtros){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM evaluacion_vivienda';
		$filtro = '';
		if (!empty($filtros->getProyectoId()))
		{
			$filtro.=' AND proyecto_id = '.$filtros->getProyectoId();
		}
		if (!empty($filtros->getEtapaId()))
		{
			$filtro.=' AND etapa_id = '.$filtros->getEtapaId();
		}
		if (!empty($filtros->getPoligonoId()))
		{
			$filtro.=' AND poligono_id = '.$filtros->getPoligonoId();
		}
		if (!empty($filtros->getLoteId()))
		{
			$filtro.=' AND lote_id = '.$filtros->getLoteId();
		}
		if(!empty($filtros->getUsuario()))
		{
			$filtro.=' AND usuario = '.$filtros->getUsuario();			
		}
		
		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $evaluacion) {
			$listaFiltro[]= new EvaluacionV($evaluacion['id'], $evaluacion['proyecto_id'],$evaluacion['etapa_id'],$evaluacion['poligono_id'], $evaluacion['lote_id'], $evaluacion['numero_serie_medidor'],
			$evaluacion['lectura_final'], $evaluacion['estado_medidor_id'],$evaluacion['estado_vivienda'],$evaluacion['tipo_vivienda'],$evaluacion['tipo_negocio_id'],
			$evaluacion['usuario'],$evaluacion['observaciones'], $evaluacion['mes_activo_id'],$evaluacion['fecha_creacion'], $evaluacion['fecha_modificacion'], $evaluacion['lectura_anterior'], $evaluacion['consumo']);
		}
		return $listaFiltro;
	}
	
}
?>