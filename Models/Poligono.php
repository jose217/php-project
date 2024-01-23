<?php 
/**
* Modelo para el acceso a la base de datos y funciones CRUD
* Autor: Elivar Largo
* Sitio Web: wwww.ecodeup.com
* Fecha: 22-03-2017
*/
class Poligono
{
	private $id;  
	private $nombre;
	private $usuario;
	private $proyectoId;
	private $etapaId;
	private $codigo;
	private $order;
	

	function __construct($id, $nombre, $usuario, $proyectoId, $etapaId,$codigo,$order)
	{
		$this->setId($id);
		$this->setNombre($nombre);
		$this->setUsuario($usuario);
		$this->setProyectoId($proyectoId);
		$this->setEtapaId($etapaId);
		$this->setCodigo($codigo);
		$this->setOrder($order);
	}


	//Getters y Setters
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
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

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo=$codigo;
	}

	public function getOrder(){
		return $this->order;
	}

	public function setOrder($order){
		$this->order=$order;
	}
	//opciones CRUD
	public function getDataArray(){
		return array(
					"id" => $this->id,
					"nombre" => $this->nombre,
					"usuario" => $this->usuario,
					"proyectoId" => $this->proyectoId,
					"etapaId" => $this->etapaId,
					"codigo" => $this->codigo,
					"order" => $this->order
				);		
	}

	//la función para registrar 
	public static function save($poligono){
		$db=Db::getConnect();
		$stgSql='INSERT INTO poligono VALUES( NULL, :nombre, :usuario, :proyectoId, :etapaId, :codigo, :order)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('nombre',$poligono->getNombre());
		$insert->bindValue('usuario',$poligono->getUsuario());
		$insert->bindValue('proyectoId', $poligono->getProyectoId());
		$insert->bindValue('etapaId', $poligono->getEtapaId());
		$insert->bindValue('codigo', $poligono->getCodigo());
		$insert->bindValue('order', $poligono->getOrder());
		$insert->execute();	
	}

	//función para obtener todos los pacientes por usuario
	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM poligono WHERE usuario=:id order by id DESC');
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $poligono) {
			$lista[]= new Poligono($poligono['id'], $poligono['nombre'], $poligono['usuario'], $poligono['proyecto_id'], $poligono['etapa_id'], $poligono['codigo'], $poligono['order']);
		}
		return $lista;
	}
	public static function allR(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM poligono order by id DESC');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $poligono) {
			$lista[]= new Poligono($poligono['id'], $poligono['nombre'], $poligono['usuario'], $poligono['proyecto_id'], $poligono['etapa_id'], $poligono['codigo'], $poligono['order']);
		}
		return $lista;
	}
	

	public static function poligonoNoUserId(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM poligono order by id ');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $poligono) {
			$lista[]= new Poligono($poligono['id'], $poligono['nombre'], $poligono['usuario'], $poligono['proyecto_id'], $poligono['etapa_id'], $poligono['codigo'], $poligono['order']);
		}
		return $lista;
	}


	public static function list(){
		$lista ="";
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM poligono order by id');
		
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $poligono) {
			$poligonolist= new Poligono($poligono['id'], $poligono['nombre'], $poligono['usuario'], $poligono['proyecto_id'], $poligono['etapa_id'], $poligono['codigo'], $poligono['order']);
			$lista.=json_encode($poligonolist->getDataArray()).','; 
		}
		return substr($lista,0,-1);
	}

	//la función para obtener un row por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM poligono WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$PoligonoDb = $select->fetch();
		$poligono = new Poligono($PoligonoDb['id'], $PoligonoDb['nombre'], $PoligonoDb['usuario'], $PoligonoDb['proyecto_id'], $PoligonoDb['etapa_id'], $PoligonoDb['codigo'], $PoligonoDb['order']);
		return $poligono;
	}
	public static function getByname($name){
		$listaPoligonos =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM poligono';
		$filtro = '';
		
		if(array_key_exists('nombre',$name) && !empty($name['polname'])){
			$filtro.=' AND nombre LIKE \'%'.$name['nombre'].'%\'';
		}
		

		$query.=' WHERE '.substr($filtro,1);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $poligono) {
			$listaPoligonos[]= new Poligono($poligono['id'], $poligono['nombre'], $poligono['usuario'], $poligono['proyecto_id'], $poligono['etapa_id'],$poligono['codigo'], $poligono['order']);
		}
		return $listaPoligonos;
	}	


	//función para obtener todos los pacientes por usuario
	public static function allByFilter($poligono){
		$listaPoligonos =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM poligono';
		$filtro = '';
		
		if(array_key_exists('nombre',$poligono) && !empty($poligono['nombre'])){
			$filtro.=' AND nombre LIKE \'%'.$poligono['nombre'].'%\'';
		}
		if(array_key_exists('usuario',$poligono) && !empty($poligono['usuario'])){
			$filtro.=' AND usuario = '.$poligono['usuario'];			
		}
		if(array_key_exists('proyectoId',$poligono) && !empty($poligono['proyectoId'])){
			$filtro.=' AND proyecto_id LIKE \'%'.$poligono['proyectoId'].'%\'';
		}
		if(array_key_exists('etapaId',$poligono) && !empty($poligono['etapaId'])){
			$filtro.=' AND etapa_id LIKE \'%'.$poligono['etapaId'].'%\'';
		}

		$query.=' WHERE '.substr($filtro,4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $poligono) {
			$listaPoligonos[]= new Poligono($poligono['id'], $poligono['nombre'], $poligono['usuario'], $poligono['proyecto_id'], $poligono['etapa_id'],$poligono['codigo'], $poligono['order']);
		}
		return $listaPoligonos;
	}	

	//la función para actualizar 
	public static function update($poligono){
		//var_dump($paciente);
		//die();
		$db=Db::getConnect();
		$stgSql='UPDATE poligono SET nombre=:nombre, usuario=:usuario, proyecto_id=:proyectoId, etapa_id=:etapaId WHERE id=:id';
		$update=$db->prepare($stgSql);
		$update->bindValue('id', $poligono->getId());
		$update->bindValue('nombre', $poligono->getNombre());
		$update->bindValue('usuario', $poligono->getUsuario());
		$update->bindValue('proyectoId', $poligono->getProyectoId());
		$update->bindValue('etapaId', $poligono->getEtapaId());
		$update->execute();
	}



	// la función para eliminar por el id
	public static function delete($id){
		//var_dump($id);
		//die();
		$db=Db::getConnect();

		// elimina en cascada

		//eliminar registros 
		$delete=$db->prepare('DELETE FROM poligono WHERE ID=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}

}

