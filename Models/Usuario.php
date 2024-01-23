<?php 
/**
* Modelo para el acceso a la base de datos y funciones CRUD
* Autor: Elivar Largo
* Sitio Web: wwww.ecodeup.com
*/
class Usuario
{
	private $id;
	private $alias;
	private $nombres;
	private $apellidos;
	private $email;
	private $clave;
	private $pregunta;
	private $respuesta;
	private $fecha_ingreso;
	private $pago;
	private $acode;
	private $estado;
	private $foto;
	
	
	function __construct($id,$alias,$nombres,$apellidos,$email,$clave,$pregunta,$respuesta,$fecha_ingreso,$pago,$acode,$estado,$foto)
	{
		$this->setId($id);
		$this->setAlias($alias);
		$this->setNombres($nombres);
		$this->setApellidos($apellidos);
		$this->setEmail($email);
		$this->setClave($clave);
		$this->setPregunta($pregunta);
		$this->setRespuesta($respuesta);
		$this->setFecha_Ingreso($fecha_ingreso);
		$this->setPago($pago);
		$this->setAcode($acode);
		$this->setEstado($estado);
		$this->setFoto($foto);
	}


	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getAlias(){
		return $this->alias;
	}

	public function setAlias($alias){
		$this->alias = $alias;
	}

	public function getNombres(){
		return $this->nombres;
	}

	public function setNombres($nombres){
		$this->nombres = $nombres;
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function setApellidos($apellidos){
		$this->apellidos = $apellidos;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getClave(){
		return $this->clave;
	}

	public function setClave($clave){
		$this->clave = $clave;
	}

	public function getPregunta(){
		return $this->pregunta;
	}

	public function setPregunta($pregunta){
		$this->pregunta = $pregunta;
	}

	public function getRespuesta(){
		return $this->respuesta;
	}

	public function setRespuesta($respuesta){
		$this->respuesta = $respuesta;
	}

	public function getFecha_Ingreso(){
		return $this->fecha_ingreso;
	}

	public function setFecha_Ingreso($fecha_ingreso){
		$this->fecha_ingreso=$fecha_ingreso;
	}

	public function getPago(){
		return $this->pago;
	}

	public function setPago($pago){
		$this->pago=$pago;
	}

	public function getAcode(){
		return $this->acode;
	}

	public function setAcode($acode){
		$this->acode=$acode;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado=$estado;
	}

	public function getFoto(){
		return $this->foto;
	}

	public function setFoto($foto){
		$this->foto=$foto;
	}


	//opciones CRUD

	//función para obtener todos los usuarios
	public static function all(){
		$listaUsuarios =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM usuarios ORDER BY id DESC');

		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $usuario) {
			$listaUsuarios[]= new Usuario($usuario['id'],$usuario['alias'], $usuario['nombres'],$usuario['apellidos'],$usuario['email'], $usuario['clave'], $usuario['respuesta'], $usuario['pregunta'],$usuario['fecha_ingreso'],$usuario['pago'],$usuario['acode'],$usuario['estado'],$usuario['foto']);
		}
		return $listaUsuarios;
	}


	public static function allByFilter($usuario){
		$listaFiltro =[];
		$db=Db::getConnect();
		$query = 'SELECT * FROM usuarios';
		$filtro = '';
		
		
		if (array_key_exists('nombres',$usuario) && !empty($usuario['nombres']))
		{
			$filtro.=' AND nombres LIKE \'%'.$usuario['nombres'].'%\'';
		}
		

		$query.=' WHERE '.substr($filtro, 4);
		$sql=$db->prepare($query);		

		$sql->execute();
		// carga en la $listaPacientes cada registro desde la base de datos
		foreach ($sql->fetchAll() as $usuario) {
			$listaFiltro[]= new Usuario($usuario['id'],$usuario['alias'], $usuario['nombres'],$usuario['apellidos'],$usuario['email'], $usuario['clave'], $usuario['respuesta'], $usuario['pregunta'],$usuario['fecha_ingreso'],$usuario['pago'],$usuario['acode'],$usuario['estado'],$usuario['foto']);

		}
		return $listaFiltro;
		
		
	}






	//la función para registrar un usuario
	public static function save($usuario){
		$db=Db::getConnect();
		$insert=$db->prepare('INSERT INTO usuarios VALUES (NULL,:alias,:nombres,:apellidos,:email,:clave,:pregunta,:respuesta,:fecha_ingreso,:pago,:acode,:estado,:foto)');
		$insert->bindValue('alias',$usuario->getAlias());
		$insert->bindValue('nombres',$usuario->getNombres());
		$insert->bindValue('apellidos',$usuario->getApellidos());
		$insert->bindValue('email',$usuario->getEmail());
		//encripta la clave
		$pass=password_hash($usuario->getClave(),PASSWORD_DEFAULT);
		//var_dump($pass);
		//die();
		$insert->bindValue('clave',$pass);
		$insert->bindValue('pregunta',$usuario->getPregunta());
		$insert->bindValue('respuesta',$usuario->getRespuesta());
		$insert->bindValue('fecha_ingreso',$usuario->getFecha_Ingreso());
		$insert->bindValue('pago',$usuario->getPago());
		$insert->bindValue('acode',$usuario->getAcode());
		$insert->bindValue('estado',$usuario->getEstado());
		$insert->bindValue('foto',$usuario->getFoto());
		$insert->execute();
	}

	//funcion para confirmar correo
	public static function confirmation($usuario){
		$db=Db::getConnect();
		$confirmation=$db->prepare('UPDATE usuarios SET estado=:estado WHERE acode=:acode');
		$confirmation->bindValue('acode',$usuario->acode);
		$confirmation->bindValue('estado',$usuario->estado);
		$confirmation->execute();
	}

	//la función para actualizar 
	public static function update($usuario){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE usuarios SET alias=:alias, nombres=:nombres, apellidos=:apellidos, email=:email WHERE id=:id');
		$update->bindValue('id',$usuario->id);
		$update->bindValue('alias',$usuario->alias);
		$update->bindValue('nombres',$usuario->nombres);
		$update->bindValue('apellidos',$usuario->apellidos);
		$update->bindValue('email',$usuario->email);
		$update->execute();
	}
	public static function updatepass($usuario){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE usuarios SET alias=:alias, nombres=:nombres, apellidos=:apellidos, email=:email, clave=:clave WHERE id=:id');
		$update->bindValue('id',$usuario->id);
		$update->bindValue('alias',$usuario->alias);
		$update->bindValue('nombres',$usuario->nombres);
		$update->bindValue('apellidos',$usuario->apellidos);
		$update->bindValue('email',$usuario->email);
		$update->bindValue('clave',$usuario->clave);
		$update->execute();
	}

	//function update code for reset password
	public static function updatecode($usuario){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE usuarios SET acode=:acode WHERE email=:email');
		$update->bindValue('email',$usuario->email);
		$update->bindValue('acode',$usuario->acode);
		$update->execute();
		// var_dump($update);
		// die();
	}

	public static function updatepwd($usuario){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE usuarios SET clave=:clave WHERE acode=:acode');
		$update->bindValue('clave',$usuario->clave);
		$update->bindValue('acode',$usuario->acode);
		$update->execute();
	}


	// la función para eliminar por el id
	public static function delete($id){
		$db=Db::getConnect();
		$delete=$db->prepare('DELETE FROM usuarios WHERE ID=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

	//la función para obtener un usuario por el id
	public static function getById($id){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM usuarios WHERE ID=:id');
		$select->bindValue('id',$id);
		$select->execute();
		//asignarlo al objeto usuario
		$usuarioDb=$select->fetch();
		$usuario= new Usuario($usuarioDb['id'],$usuarioDb['alias'],$usuarioDb['nombres'],$usuarioDb['apellidos'],$usuarioDb['email'], $usuarioDb['clave'],$usuarioDb['pregunta'],$usuarioDb['respuesta'],$usuarioDb['fecha_ingreso'],$usuarioDb['pago'],$usuarioDb['acode'],$usuarioDb['estado'],$usuarioDb['foto']);
		//var_dump($usuario);
		//die();
		return $usuario;
	}
	
	//función para obtener todos los usuarios

	public static function findByEmail($email){
		$listaUsuarios =[];
		$db=Db::getConnect();
		$query=$db->prepare('SELECT * FROM usuarios WHERE EMAIL=:email');
		$query->bindValue("email",$email);		
		$query->execute();
		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($query->fetchAll() as $usuario) {
			$listaUsuarios[]= new Usuario($usuario['id'],$usuario['alias'], $usuario['nombres'],$usuario['apellidos'],$usuario['email'], $usuario['clave'], $usuario['respuesta'], $usuario['pregunta'],$usuario['fecha_ingreso'],$usuario['pago'],$usuario['acode'],$usuario['estado'],$usuario['foto']);
		}
		return $listaUsuarios;
	}	
	public static function findByname($name){
		$listaUsuarios =[];
		$db=Db::getConnect();
		$query=$db->prepare('SELECT * FROM usuarios WHERE NOMBRES=:nombres');
		$query->bindValue("nombres",$name);		
		$query->execute();
		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($query->fetchAll() as $usuario) {
			$listaUsuarios[]= new Usuario($usuario['id'],$usuario['alias'], $usuario['nombres'],$usuario['apellidos'],$usuario['email'], $usuario['clave'], $usuario['respuesta'], $usuario['pregunta'],$usuario['fecha_ingreso'],$usuario['pago'],$usuario['acode'],$usuario['estado'],$usuario['foto']);
		}
		return $listaUsuarios;
	}	

	
}