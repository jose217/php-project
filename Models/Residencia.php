<?php 
/** SS - El Salvador 19-08-2022 Motion */
class Residencia
{
	private $id;
	private $nombre;
	private $usuario;
	private $codigo;

	function __construct($id, $nombre, $usuario, $codigo)
	{
		$this->setId($id);
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
		return array("id" => $this->id,"nombre" => $this->nombre, "usuario" => $this->usuario, "codigo"=>$this->codigo);		
	}


	//opciones CRUD

	public static function save($proyecto){
		$db=Db::getConnect();
		$stgSql='INSERT INTO proyecto VALUES( NULL, :nombre, :usuario, :codigo)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('nombre',$proyecto->getNombre());
		$insert->bindValue('usuario',$proyecto->getUsuario());
		$insert->bindValue('codigo',$proyecto->getCodigo());
		$insert->execute();	
	}

	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM proyecto WHERE usuario=:id order by id DESC');
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $proyecto) {
			$lista[]= new Residencia($proyecto['id'], $proyecto['nombre'], $proyecto['usuario'], $proyecto['codigo']);
		}
		return $lista;
	}
	public static function allR(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM proyecto order by id DESC');
		
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $proyecto) {
			$lista[]= new Residencia($proyecto['id'], $proyecto['nombre'], $proyecto['usuario'], $proyecto['codigo']);
		}
		return $lista;
	}

	//la función para actualizar 
	public static function update($residencia){
		$db=Db::getConnect();
		$stgSql = 'UPDATE proyecto SET nombre=:nombre, usuario=:usuario, codigo=:codigo WHERE id=:id';
		$update=$db->prepare($stgSql);
		$update->bindValue('id', $residencia->getId());
		$update->bindValue('nombre', $residencia->getNombre());
		$update->bindValue('usuario', $residencia->getUsuario());
		$update->bindValue('codigo', $residencia->getCodigo());
		$update->execute();
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
		$lista = new Residencia($proyecto['id'], $proyecto['nombre'], $proyecto['usuario'],$proyecto['codigo']);
		return $lista;
	}


	
	public static function allByFilter($residencias){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM proyecto';
		$filtro = '';
		
		if (array_key_exists('nombre',$residencias) && !empty($residencias['nombre']))
		{
			$filtro.=' AND nombre LIKE \'%'.$residencias['nombre'].'%\'';
		}
		else if(array_key_exists('usuario',$residencias) && !empty($residencias['usuario']))
		{
			$filtro.=' AND usuario = '.$residencias['usuario'];			
		}

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $residencias) {
			$listaFiltro[]= new residencia($residencias['id'], $residencias['nombre'], $residencias['usuario'],$residencias['codigo']);
		}
		return $listaFiltro;
	}	


}