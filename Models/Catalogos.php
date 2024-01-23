<?php
/**
* Modelo para el acceso a la base de datos y funciones CRUD
* Autor: Roberto Mena
* Sitio Web: wwww.motion.com.sv
* Fecha: 30/12/2020
*/

class Catalogos{

    private $id;
	private $codigo;
	private $descripcion;
	private $usuario;
	


    function __construct($id, $codigo, $descripcion,$usuario){
        $this->setId($id);
		$this->setCodigo($codigo);			
		$this->setDescripcion($descripcion);
		$this->setUsuario($usuario);
		

    }

	//Getters y Setters
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	function getCodigo() {
		return $this->codigo;
	}
	
	function setCodigo($codigo) {
		$this->codigo = $codigo;
	}

	function getDescripcion() {
		return $this->descripcion;
	}
	
	function setDescripcion($descripcion) {
		
		$this->descripcion = $descripcion;;
	}

	function getUsuario() {
		return $this->usuario;
	}
	
	
	function setUsuario($usuario){
		
		$this->usuario = $usuario;
	}
	
	//Metodo para cargar todos los resultados del catálogo de motivo de inspección.
	public static function getAllMotivoInspeccion($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_motivo_inspeccion where usuario=:usuario order by id DESC');
		$sql->bindParam(':usuario',$idUsuario);
		$sql->execute();
		foreach ($sql->fetchAll() as $row) { $lista[]= new Catalogos($row['id'], $row['codigo'],$row['descripcion'],$row['usuario']);}
		return $lista;
	}
	
	//función para recuperar una lista de tipo de Negocio
	public static function getTNegocioList(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_tipo_negocio order by id DESC');
		$sql->execute();
		foreach ($sql->fetchAll() as $row) { $lista[]= new Catalogos($row['id'], $row['codigo'],$row['descripcion'],$row['usuario']);}
		return $lista;
	}
	
	public static function getAllTNegocio($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_tipo_negocio where usuario=:usuario order by id DESC');
		$sql->bindParam(':usuario',$idUsuario);
		$sql->execute();
		foreach ($sql->fetchAll() as $row) { $lista[]= new Catalogos($row['id'], $row['codigo'],$row['descripcion'],$row['usuario']);}
		return $lista;
	}

	public static function saveTNegocio($catalogos){
		$db=Db::getConnect();
		$stgSql='INSERT INTO cat_tipo_negocio VALUES( null, :codigo, :descripcion, :usuario)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('codigo',$catalogos->getCodigo());
		$insert->bindValue('descripcion',$catalogos->getDescripcion());
		$insert->bindValue('usuario',$catalogos->getUsuario());
		$insert->execute();	
	}

	//Metodo para insertar a la tabla de CAT_MOTIVO_INSPECCION
	public static function saveMotivoInspeccion($catalogos){
		$db=Db::getConnect();
		$stgSql='INSERT INTO cat_motivo_inspeccion VALUES( null, :codigo, :descripcion, :usuario)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('codigo',$catalogos->getCodigo());
		$insert->bindValue('descripcion',$catalogos->getDescripcion());
		$insert->bindValue('usuario',$catalogos->getUsuario());
		$insert->execute();	
	}	

	public static function deleteTNegocio($id){
		$db=Db::getConnect();
		//eliminar registros 
		$delete=$db->prepare('DELETE FROM cat_tipo_negocio WHERE ID=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}


	public static function saveEMedidor($catalogos){
		$db=Db::getConnect();
		$stgSql='INSERT INTO cat_estado_medidor VALUES( null, :codigo, :descripcion, :usuario)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('codigo',$catalogos->getCodigo());
		$insert->bindValue('descripcion',$catalogos->getDescripcion());
		$insert->bindValue('usuario',$catalogos->getUsuario());
		$insert->execute();	
	}

	public static function getAllEMedidor($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_estado_medidor where usuario=:idUsuario');
		$sql->bindParam(':idUsuario',$idUsuario);
		$sql->execute();
		foreach ($sql->fetchAll() as $row) { 
			$lista[]= new Catalogos($row['id'], $row['codigo'],$row['descripcion'],$row['usuario']);
		}
		return $lista;
	}

	public static function getListEMedidor(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_estado_medidor order by id');
		$sql->execute();
		foreach ($sql->fetchAll() as $row) { 
			$lista[]= new Catalogos($row['id'], $row['codigo'],$row['descripcion'],$row['usuario']);
		}
		return $lista;
	}

	public static function deleteEMedidor($id){
		$db=Db::getConnect();
		//eliminar registros 
		$delete=$db->prepare('DELETE FROM cat_estado_medidor WHERE id=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM cat_tipo_negocio WHERE ID=:id ');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$catalogos = $select->fetch();
		$list = new Catalogos($catalogos['id'], $catalogos['codigo'],$catalogos['descripcion'], $catalogos['usuario'] );
		return $list;
	} 

	public static function getByIdM($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM cat_estado_medidor WHERE ID=:id ');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$catalogos = $select->fetch();
		$list = new Catalogos($catalogos['id'], $catalogos['codigo'],$catalogos['descripcion'], $catalogos['usuario'] );
		return $list;
	} 

	public static function getMotivoInspeccionById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM cat_motivo_inspeccion WHERE ID=:id ');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$catalogos = $select->fetch();
		$list = new Catalogos($catalogos['id'], $catalogos['codigo'],$catalogos['descripcion'], $catalogos['usuario'] );
		return $list;
	} 

	
	public static function update($catalogos){
		//var_dump($paciente);
		//die();
		$db=Db::getConnect();
		$stgSql = 'UPDATE cat_tipo_negocio SET  codigo=:codigo, descripcion=:descripcion, usuario=:usuario WHERE id=:id';
		$update=$db->prepare($stgSql);
		$update->bindValue('id',$catalogos->getId());
		$update->bindValue('codigo',$catalogos->getCodigo());
		$update->bindValue('descripcion',$catalogos->getDescripcion());
		$update->bindValue('usuario',$catalogos->getUsuario());
		
		$update->execute();
	}
	public static function updateM($catalogos){
		//var_dump($paciente);
		//die();
		$db=Db::getConnect();
		$stgSql = 'UPDATE cat_estado_medidor SET  codigo=:codigo, descripcion=:descripcion, usuario=:usuario WHERE id=:id';
		$update=$db->prepare($stgSql);
		$update->bindValue('id',$catalogos->getId());
		$update->bindValue('codigo',$catalogos->getCodigo());
		$update->bindValue('descripcion',$catalogos->getDescripcion());
		$update->bindValue('usuario',$catalogos->getUsuario());
		
		$update->execute();
	}
	public static function allByFilter($catalogos){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM cat_tipo_negocio';
		$filtro = '';
		
		
		if (array_key_exists('descripcion',$catalogos) && !empty($catalogos['descripcion']))
		{
			$filtro.=' AND descripcion LIKE \'%'.$catalogos['descripcion'].'%\'';
		}
		if(array_key_exists('usuario',$catalogos) && !empty($catalogos['usuario']))
		{
			$filtro.=' AND usuario = '.$catalogos['usuario'];			
		}

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $catalogos) {
			$listaFiltro[]= new Catalogos($catalogos['id'],$catalogos['codigo'], $catalogos['descripcion'],  $catalogos['usuario']);
		}
		return $listaFiltro;
	}



	public static function allByFilterM($catalogos){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM cat_estado_medidor ';
		$filtro = '';
		
		
		if (array_key_exists('descripcion',$catalogos) && !empty($catalogos['descripcion']))
		{
			$filtro.=' AND descripcion LIKE \'%'.$catalogos['descripcion'].'%\'';
		}
		if(array_key_exists('usuario',$catalogos) && !empty($catalogos['usuario']))
		{
			$filtro.=' AND usuario = '.$catalogos['usuario'];			
		}

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $catalogos) {
			$listaFiltro[]= new Catalogos($catalogos['id'],$catalogos['codigo'], $catalogos['descripcion'],  $catalogos['usuario']);
		}
		return $listaFiltro;
	}

	public static function getDataByFilter($catalogos,$tabla){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM '.$tabla.' ';
		$filtro = '';
		
		
		if (array_key_exists('descripcion',$catalogos) && !empty($catalogos['descripcion']))
		{
			$filtro.=' AND descripcion LIKE \'%'.$catalogos['descripcion'].'%\'';
		}
		if(array_key_exists('usuario',$catalogos) && !empty($catalogos['usuario']))
		{
			$filtro.=' AND usuario = '.$catalogos['usuario'];			
		}

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $catalogos) {
			$listaFiltro[]= new Catalogos($catalogos['id'],$catalogos['codigo'], $catalogos['descripcion'],  $catalogos['usuario']);
		}
		return $listaFiltro;
	}


	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_tipo_negocio WHERE usuario=:id order by id DESC' );
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $catalogos) {
			$lista[]= new Catalogos($catalogos['id'],$catalogos['codigo'],  $catalogos['descripcion'], $catalogos['usuario']);
		}
		return $lista;
	}
	
	
	public static function allM($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_estado_medidor WHERE usuario=:id order by id DESC' );
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $catalogos) {
			$lista[]= new Catalogos($catalogos['id'],$catalogos['codigo'],  $catalogos['descripcion'], $catalogos['usuario']);
		}
		return $lista;
	}

	public static function allMotivoInspeccion(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM cat_motivo_inspeccion order by id DESC' );
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $catalogos) {
			$lista[]= new Catalogos($catalogos['id'],$catalogos['codigo'],  $catalogos['descripcion'], $catalogos['usuario']);
		}
		return $lista;
	}	

	public static function buscarDuplicado($descripcion){
		$pdo=Db::getConnect();
		
		$sql='SELECT * FROM cat_tipo_negocio where descripcion = ?';
		$sentencia= $pdo->prepare($sql);
		$sentencia->execute(array($descripcion));
		$resultado = $sentencia	->fetch();
		if($resultado){
			return 1;
		}
		else{
			return 0;
		}		
	}

	public static function buscarDuplicadoM($descripcion){
		$pdo=Db::getConnect();
		
		$sql='SELECT * FROM cat_estado_medidor where descripcion = ?';
		$sentencia= $pdo->prepare($sql);
		$sentencia->execute(array($descripcion));
		$resultado = $sentencia	->fetch();
		if($resultado){
			return 1;
		}
		else{
			return 0;
		}
	}

	public static function buscarDupMotivoInspeccion($descripcion){
		$pdo=Db::getConnect();
		
		$sql='SELECT * FROM cat_motivo_inspeccion where descripcion = ?';
		$sentencia= $pdo->prepare($sql);
		$sentencia->execute(array($descripcion));
		$resultado = $sentencia	->fetch();
		if($resultado){
			return 1;
		}
		else{
			return 0;
		}		
	}	
}
?>