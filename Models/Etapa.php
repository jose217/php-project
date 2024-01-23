<?php 
/** SS - El Salvador 19-08-2022 Motion */
class Etapa
{
	private $id;
	private $proyectoId;
	private $nombre;
	private $usuario;
	private $codigo;

	function __construct($id, $proyectoId, $nombre, $usuario,$codigo)
	{
		$this->setId($id);
		$this->setProyectoId($proyectoId);
		$this->setNombre($nombre);
		$this->setUsuario($usuario);
		$this->setCodigo($codigo);
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

	public function getProyectoId(){
		return $this->proyectoId;
	}

	public function setProyectoId($proyectoId){
		$this->proyectoId = $proyectoId;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo=$codigo;
	}

	public function getDataArray(){
		return array("id" => $this->id,"proyectoId" => $this->proyectoId, "nombre" => $this->nombre, "usuario" => $this->usuario, "codigo"=>$this->codigo);		
	}


	//opciones CRUD

	public static function save($etapa){
		$db=Db::getConnect();
		$stgSql='INSERT INTO etapa VALUES( NULL, :proyectoId, :nombre, :usuario, :codigo)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('proyectoId',$etapa->getProyectoId());
		$insert->bindValue('nombre',$etapa->getNombre());
		$insert->bindValue('usuario',$etapa->getUsuario());
		$insert->bindValue('codigo',$etapa->getCodigo());
		$insert->execute();	
	}

	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM etapa WHERE usuario=:id order by id DESC');
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $etapa) {
			$lista[]= new Etapa($etapa['id'], $etapa['proyecto_id'], $etapa['nombre'], $etapa['usuario'],$etapa['codigo']);
		}
		return $lista;
	}

	public static function etapaNoUserId(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM etapa order by id ');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $etapa) {
			$lista[]= new Etapa($etapa['id'], $etapa['proyecto_id'], $etapa['nombre'], $etapa['usuario'],$etapa['codigo']);
		}
		return $lista;
	}

	public static function list(){
		$lista ="";
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM etapa order by id');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $etapa) {
			$etapalist= new Etapa($etapa['id'], $etapa['proyecto_id'], $etapa['nombre'], $etapa['usuario'],$etapa['codigo']);
			$lista.=json_encode($etapalist->getDataArray()).','; 
		}
		return substr($lista,0,-1);
	}

	// public static function list($idUsuario){
	// 	$lista = "";
	// 	$db=Db::getConnect();
	// 	$sql=$db->prepare('SELECT * FROM lote WHERE usuario=:id order by id');
	// 	$sql->bindParam(':id',$idUsuario);
	// 	$sql->execute();

	// 	// carga en la $listaPacientes cada registro desde la base de datos
	// 	foreach ($sql->fetchAll() as $lote) {
	// 		$lote = new Lote($lote['id'], $lote['poligono_id'], $lote['numero_lote'], $lote['numero_serie_medidor'], $lote['usuario']);
	// 		$lista.=json_encode($lote->getDataArray()).','; 
	// 	}
	// 	return substr($lista,0,-1);
	// }

	// // la función para eliminar por el id
	// public static function delete($id){
	// 	//var_dump($id);
	// 	//die();
	// 	$db=Db::getConnect();

	// 	// elimina en cascada

	// 	//eliminar registros 
	// 	$delete=$db->prepare('DELETE FROM lote WHERE ID=:id ');
	// 	$delete->bindValue('id',$id);		
	// 	$delete->execute();
	// }

	// //la función para obtener un row por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM etapa WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$etapa = $select->fetch();
		$list = new Etapa($etapa['id'], $etapa['proyecto_id'], $etapa['nombre'], $etapa['usuario'],$etapa['codigo']);
		return $list;
	}

	// // la función para eliminar por el id
	public static function delete($id){
		//var_dump($id);
		//die();
		$db=Db::getConnect();

		// elimina en cascada

		//eliminar registros 
		$delete=$db->prepare('DELETE FROM etapa WHERE ID=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}


	public static function allByFilter($etapa){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM etapa';
		$filtro = '';
		
		
		if (array_key_exists('residencial',$etapa) && !empty($etapa['residencial']))
		{
			$filtro.=' AND proyecto_id LIKE \'%'.$etapa['residencial'].'%\'';
		}
		if(array_key_exists('usuario',$etapa) && !empty($etapa['usuario']))
		{
			$filtro.=' AND usuario = '.$etapa['usuario'];			
		}

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $etapa) {
			$listaFiltro[]= new Etapa($etapa['id'], $etapa['proyecto_id'], $etapa['nombre'], $etapa['usuario'],$etapa['codigo']);
		}
		return $listaFiltro;
	}
	
	public static function update($etapa){
		//var_dump($paciente);
		//die();
		$db=Db::getConnect();
		$stgSql = 'UPDATE etapa SET proyecto_id=:proyectoId, nombre=:nombre, usuario=:usuario, codigo=:codigo WHERE id=:id';
		$update=$db->prepare($stgSql);
		$update->bindValue('id',$etapa->getId());
		$update->bindValue('proyectoId',$etapa->getProyectoId());
		$update->bindValue('nombre',$etapa->getNombre());
		$update->bindValue('usuario',$etapa->getUsuario());
		$update->bindValue('codigo',$etapa->getCodigo());
		$update->execute();
	}


}