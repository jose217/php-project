<?php 
/** SS - El Salvador 19-08-2022 Motion */
class Proyecto
{
	private $id;
	private $codigo;
	private $nombre;
	private $usuario;

	function __construct($id, $codigo, $nombre, $usuario)
	{
		$this->setId($id);
		$this->setCodigo($codigo);
		$this->setNombre($nombre);
		$this->setUsuario($usuario);
	}
	
	//Getters y Setters
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
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

	public function getDataArray(){
		return array("id" => $this->id,"codigo" => $this->codigo,"nombre" => $this->nombre, "usuario" => $this->usuario);		
	}


	//opciones CRUD

	public static function save($proyecto){
		$db=Db::getConnect();
		$stgSql='INSERT INTO proyecto VALUES( NULL, :codigo, :nombre, :usuario)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('codigo',$proyecto->getCodigo());
		$insert->bindValue('nombre',$proyecto->getNombre());
		$insert->bindValue('usuario',$proyecto->getUsuario());
		$insert->execute();	
	}

	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM proyecto WHERE usuario=:id order by id');
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $proyecto) {
			$lista[]= new Proyecto($proyecto['id'], $proyecto['codigo'], $proyecto['nombre'], $proyecto['usuario']);
		}
		return $lista;
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
	public static function delete($id){
		//var_dump($id);
		//die();
		$db=Db::getConnect();

		// elimina en cascada

		//eliminar registros 
		$delete=$db->prepare('DELETE FROM proyecto WHERE ID=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}

	// //la función para obtener un row por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM proyecto WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$proyecto = $select->fetch();
		$lista = new Proyecto($proyecto['id'], $proyecto['codigo'], $proyecto['nombre'], $proyecto['usuario']);
		return $lista;
	}


}