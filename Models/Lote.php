<?php 
/**
* Modelo para el acceso a la base de datos y funciones CRUD
* Autor: Elivar Largo
* Sitio Web: wwww.ecodeup.com
*/
class Lote
{
	private $id;
	private $proyectoId;
	private $etapaId;
	private $poligonoId;
	private $numeroLote;
	private $numeroSerieMedidor;
	private $usuario;
	private $codCliente;
	private $indice;

	function __construct($id,$proyectoId,$etapaId,$poligonoId,$numeroLote,$numeroSerieMedidor,$usuario,$codCliente,$indice)
	{
		$this->setId($id);
		$this->setProyectoId($proyectoId);
		$this->setEtapaId($etapaId);
		$this->setPoligonoId($poligonoId);
		$this->setNumeroLote($numeroLote);
		$this->setNumeroSerieMedidor($numeroSerieMedidor);
		$this->setUsuario($usuario);
		$this->setCodCliente($codCliente);
		$this->setIndice($indice);
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

	public function getNumeroLote(){
		return $this->numeroLote;
	}

	public function setNumeroLote($numeroLote){
		$this->numeroLote = $numeroLote;
	}

	public function getNumeroSerieMedidor(){
		return $this->numeroSerieMedidor;
	}

	public function setNumeroSerieMedidor($numeroSerieMedidor){
		$this->numeroSerieMedidor = $numeroSerieMedidor;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getCodCliente(){
		return $this->codCliente;
	}

	public function setCodCliente($codCliente){
		$this->codCliente = $codCliente;
	}

	public function getIndice(){
		return $this->indice;
	}

	public function setIndice($indice){
		$this->indice = $indice;
	}	

	public function getDataArray(){
		return array("id" => $this->id,"proyectoId"=>$this->proyectoId,"etapaId"=>$this->etapaId,"poligonoId" => $this->poligonoId,"numeroLote" => $this->numeroLote,"numeroSerieMedidor" => $this->numeroSerieMedidor, "usuario" => $this->usuario,"codCliente"=>$this->codCliente, "indice"=>$this->indice);
	}


	//opciones CRUD

	public static function save($lote){
		$db=Db::getConnect();
		$stgSql='INSERT INTO lote VALUES( NULL, :proyectoId, :etapaId, :poligonoId, :numeroLote, :numeroSerieMedidor, :usuario, :codCliente, :indice)';
		$insert=$db->prepare($stgSql);
		$insert->bindValue('proyectoId',$lote->getProyectoId());
		$insert->bindValue('etapaId',$lote->getEtapaId());
		$insert->bindValue('poligonoId',$lote->getPoligonoId());
		$insert->bindValue('numeroLote',$lote->getNumeroLote());
		$insert->bindValue('numeroSerieMedidor',$lote->getNumeroSerieMedidor());
		$insert->bindValue('usuario',$lote->getUsuario());
		$insert->bindValue('codCliente',$lote->getCodCliente());
		$insert->bindValue('indice',$lote->getIndice());
		$insert->execute();	
	}

	public static function saveAntNumero($lote){
		$db=Db::getConnect();
		$stgSql='INSERT INTO numero_anterior VALUES( NULL, :proyectoId, :etapaId, :poligonoId, :numeroLote)';
		$insert=$db->prepare($stgSql);
		$insert->bindValue('proyectoId',$lote->getProyectoId());
		$insert->bindValue('etapaId',$lote->getEtapaId());
		$insert->bindValue('poligonoId',$lote->getPoligonoId());
		$insert->bindValue('numeroLote',$lote->getNumeroLote());		
		$insert->execute();	
	}

	public static function updateNewNumber($lote){
		$db=Db::getConnect();
		$stgSql='UPDATE lote SET numero_serie_medidor =:numeroSerieMedidor, usuario=:usuario  where id=:id';					
		$update=$db->prepare($stgSql);
		$update->bindValue('id',$lote->getId());
		$update->bindValue('numeroSerieMedidor',$lote->getNumeroSerieMedidor());
		$update->bindValue('usuario',$lote->getUsuario());
		$update->execute();
	} 

	public static function update($lote){
		$db=Db::getConnect();		
		$stgSql='UPDATE lote SET proyecto_id=:proyectoId, etapa_id=:etapaId, poligono_id=:poligonoId, numero_lote=:numeroLote, numero_serie_medidor=:numeroSerieMedidor, usuario=:usuario, cod_cliente=:codCliente, indice=:indice where id=:id';
		$update=$db->prepare($stgSql);
		$update->bindValue('id',$lote->getId());
		$update->bindValue('proyectoId',$lote->getProyectoId());
		$update->bindValue('etapaId',$lote->getEtapaId());
		$update->bindValue('poligonoId',$lote->getPoligonoId());
		$update->bindValue('numeroLote',$lote->getNumeroLote());
		$update->bindValue('numeroSerieMedidor',$lote->getNumeroSerieMedidor());
		$update->bindValue('usuario',$lote->getUsuario());
		$update->bindValue('codCliente',$lote->getCodCliente());
		$update->bindValue('indice',$lote->getIndice());		
		$update->execute();	

	}

	public static function all($idUsuario){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM lote WHERE usuario=:id order by id DESC');
		$sql->bindParam(':id',$idUsuario);
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $lote) {
			$lista[]= new Lote($lote['id'], $lote['proyecto_id'], $lote['etapa_id'], $lote['poligono_id'], $lote['numero_lote'], $lote['numero_serie_medidor'], $lote['usuario'], $lote['cod_cliente'], $lote['indice']);
		}
		return $lista;
	}

	public static function loteNoUserId(){
		$lista =[];
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM lote order by id');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $lote) {
			$lista[]= new Lote($lote['id'], $lote['proyecto_id'], $lote['etapa_id'], $lote['poligono_id'], $lote['numero_lote'], $lote['numero_serie_medidor'], $lote['usuario'], $lote['cod_cliente'], $lote['indice']);
		}
		return $lista;
	}

	public static function list(){
		$lista = "";
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM lote order by id');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $lote) {
			$loteArray = new Lote($lote['id'], $lote['proyecto_id'], $lote['etapa_id'], $lote['poligono_id'], $lote['numero_lote'], $lote['numero_serie_medidor'], $lote['usuario'],$lote['cod_cliente'], $lote['indice']);
			$lista.=json_encode($loteArray->getDataArray()).','; 
		}
		return substr($lista,0,-1);
	}

	public static function listNext(){
		$lista = "";
		$db=Db::getConnect();
		$sql=$db->prepare('SELECT * FROM lote order by id');
		$sql->execute();

		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $lote) {
			$loteArray = new Lote($lote['id'], $lote['proyecto_id'], $lote['etapa_id'], $lote['poligono_id'], $lote['numero_lote'], $lote['numero_serie_medidor'], $lote['usuario'],$lote['cod_cliente'], $lote['indice']);
			$lista.=json_encode($loteArray->getDataArray()).','; 
		}
		return substr($lista,0,-1);
	}

	// la función para eliminar por el id
	public static function delete($id){
		//var_dump($id);
		//die();
		$db=Db::getConnect();

		// elimina en cascada

		//eliminar registros 
		$delete=$db->prepare('DELETE FROM lote WHERE ID=:id ');
		$delete->bindValue('id',$id);		
		$delete->execute();
	}

	//la función para obtener un row por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM lote WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto 
		$loteDb = $select->fetch();
		$lote = new Lote($loteDb['id'],$loteDb['proyecto_id'], $loteDb['etapa_id'], $loteDb['poligono_id'], $loteDb['numero_lote'], $loteDb['numero_serie_medidor'], $loteDb['usuario'], $loteDb['cod_cliente'], $loteDb['indice']);
		return $lote;
	}

	//
	public static function allByFilter($lote){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM lote';
		$filtro = '';
		
		
		if (array_key_exists('proyectoId',$lote) && !empty($lote['proyectoId']))
		{
			$filtro.=' AND proyecto_id LIKE \'%'.$lote['proyectoId'].'%\'';
		}
		if (array_key_exists('etapaId',$lote) && !empty($lote['etapaId']))
		{
			$filtro.=' AND etapa_id LIKE \'%'.$lote['etapaId'].'%\'';
		}
		if (array_key_exists('poligonoId',$lote) && !empty($lote['poligonoId']))
		{
			$filtro.=' AND poligono_id LIKE \'%'.$lote['poligonoId'].'%\'';
		}
		if (array_key_exists('numeroLote',$lote) && !empty($lote['numeroLote']))
		{
			$filtro.=' AND numero_lote LIKE \'%'.$lote['numeroLote'].'%\'';
		}
		if(array_key_exists('usuario',$lote) && !empty($lote['usuario']))
		{
			$filtro.=' AND usuario = '.$lote['usuario'];			
		}

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $loteDb) {
			$listaFiltro[]= new Lote($loteDb['id'], $loteDb['proyecto_id'], $loteDb['etapa_id'], $loteDb['poligono_id'],$loteDb['numero_lote'],$loteDb['numero_serie_medidor'],$loteDb['usuario'],$loteDb['cod_cliente'], $loteDb['indice']);
		}
		return $listaFiltro;
	}

	
	public static function buscarDuplicado($lote){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM lote';
		$filtro = '';
		
		
		if (array_key_exists('proyectoId',$lote) && !empty($lote['proyectoId']))
		{
			$filtro.=' AND proyecto_id LIKE \'%'.$lote['proyectoId'].'%\'';
		}
		if (array_key_exists('etapaId',$lote) && !empty($lote['etapaId']))
		{
			$filtro.=' AND etapa_id LIKE \'%'.$lote['etapaId'].'%\'';
		}
		if (array_key_exists('poligonoId',$lote) && !empty($lote['poligonoId']))
		{
			$filtro.=' AND poligono_id LIKE \'%'.$lote['poligonoId'].'%\'';
		}
		if (array_key_exists('numeroLote',$lote) && !empty($lote['numeroLote']))
		{
			$filtro.=' AND numero_lote LIKE \'%'.$lote['numeroLote'].'%\'';
		}
		if (array_key_exists('numeroSerieMedidor',$lote) && !empty($lote['numeroSerieMedidor']))
		{
			$filtro.=' AND numero_serie_medidor LIKE \'%'.$lote['numeroSerieMedidor'].'%\'';
		}
		

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $loteDb) {
			$listaFiltro= array(null, $loteDb['proyecto_id'], $loteDb['etapa_id'], $loteDb['poligono_id'],$loteDb['numero_lote'],$loteDb['numero_serie_medidor'],null,null,$loteDb['indice']);
		}
		return $listaFiltro;

	}

	// public static function getCodClienteSolicitud()
	// {
	// 	$lista = "";
	// 	$db=Db::getConnect();
	// 	$sql=$db->prepare('SELECT * FROM lote order by id');
	// 	$sql->execute();

	// 	// carga en la $listaPacientes cada registro desde la base de datos
	// 	foreach ($sql->fetchAll() as $lote) {
	// 		$loteArray = new Lote($lote['id'], $lote['proyecto_id'], $lote['etapa_id'], $lote['poligono_id'], $lote['numero_lote'], $lote['numero_serie_medidor'], $lote['usuario'],$lote['cod_cliente'], $lote['indice']);
	// 		$lista.=json_encode($loteArray->getDataArray()).','; 
	// 	}
	// 	return substr($lista,0,-1);
	// }

}