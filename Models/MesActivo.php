<?php 
/** SS - El Salvador 19-08-2022 Motion */
class MesActivo
{
	private $id;
	private $annio;
	private $mes;
	private $estado;
	private $usuario;

	function __construct($id, $annio, $mes, $estado, $usuario)
	{
		$this->setId($id);
		$this->setAnnio($annio);
		$this->setMes($mes);
		$this->setEstado($estado);
		$this->setUsuario($usuario);
	}
	
	//Getters y Setters
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getAnnio(){
		return $this->annio;
	}

	public function setAnnio($annio){
		$this->annio = $annio;
	}

	public function getMes(){
		return $this->mes;
	}

	public function setMes($mes){
		$this->mes = $mes;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getDataArray(){
		return array("id" => $this->id,"annio" => $this->annio, "mes" => $this->mes,"estado" => $this->estado, "usuario" => $this->usuario);		
	}


	//opciones CRUD

	public static function save($activo){
		$db=Db::getConnect();
		$stgSql='INSERT INTO mes_activo VALUES( NULL, :annio, :mes, :estado, :usuario)';					
		$insert=$db->prepare($stgSql);
		$insert->bindValue('annio',$activo->getAnnio());
		$insert->bindValue('mes',$activo->getMes());
		$insert->bindValue('estado',$activo->getEstado());
		$insert->bindValue('usuario',$activo->getUsuario());
		$insert->execute();	
	}

	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM mes_activo WHERE usuario=:id order by id DESC');
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $activo) {
			$lista[]= new MesActivo($activo['id'], $activo['annio'], $activo['mes'], $activo['estado'], $activo['usuario']);
		}
		return $lista;
	}

	public static function allowUser(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM mes_activo order by id');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $activo) {
			$lista[]= new MesActivo($activo['id'], $activo['annio'], $activo['mes'], $activo['estado'], $activo['usuario']);
		}
		return $lista;
	}

	public static function updateStatus($mes)
	{
		$db=Db::getConnect();
		$sql='UPDATE mes_activo SET estado=:estado WHERE usuario=:usuario';
		$update=$db->prepare($sql);
		$update->bindValue('estado',$mes->getEstado());
		$update->bindValue('usuario',$mes->getUsuario());
		$update->execute();
	}

	public static function update($mes)
	{
		$db=Db::getConnect();
		$sql='UPDATE mes_activo SET annio=:annio, mes=:mes, estado=:estado, usuario=:usuario where id=:id';
		$update=$db->prepare($sql);
		$update->bindValue('id',$mes->getId());
		$update->bindValue('annio',$mes->getAnnio());
		$update->bindValue('mes',$mes->getMes());
		$update->bindValue('estado',$mes->getEstado());
		$update->bindValue('usuario',$mes->getUsuario());
		$update->execute();
	}
	
	// //la función para obtener un row por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM mes_activo WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$activo = $select->fetch();
		$list = new MesActivo($activo['id'], $activo['annio'], $activo['mes'], $activo['estado'], $activo['usuario']);
		return $list;
	}

    public static function delete($id){
		//var_dump($id);
		//die();
		$db=Db::getConnect();

		// elimina en cascada

		//eliminar registros 
		$delete=$db->prepare('DELETE FROM mes_activo WHERE ID=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}

	public static function allByFilter($etdo){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM mes_activo';
		$filtro = '';
		
		
		if (array_key_exists('annio',$etdo) && !empty($etdo['annio']))
		{
			$filtro.=' AND annio LIKE \'%'.$etdo['annio'].'%\'';
		}
		if (array_key_exists('mes',$etdo) && !empty($etdo['mes']))
		{
			$filtro.=' AND mes LIKE \'%'.$etdo['mes'].'%\'';
		}
		if (array_key_exists('estado',$etdo) && !empty($etdo['estado']))
		{
			$filtro.=' AND estado LIKE \'%'.$etdo['estado'].'%\'';
		}
		if(array_key_exists('usuario',$etdo) && !empty($etdo['usuario']))
		{
			$filtro.=' AND usuario = '.$etdo['usuario'];			
		}

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $ cada registro desde la base de datos
		foreach ($sql->fetchAll() as $activo) {
			$listaFiltro[]= new MesActivo($activo['id'], $activo['annio'], $activo['mes'], $activo['estado'], $activo['usuario']);
		}
		return $listaFiltro;
	}

}