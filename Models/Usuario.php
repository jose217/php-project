<?php 
class Usuario
{
	private $id;
    private $nombre;
    private $apellido;
    private $alias;
    private $correo;
    private $contrasenia;
    private $departamento;
    private $municipio;
    private $dui;
	private $acepta_terminos;
	private $tipoUsuario;

	public function __construct($id, $nombre, $apellido, $alias, $correo, $contrasenia, $departamento, $municipio, $dui, $acepta_terminos, $tipoUsuario)
	{
		$this->setId($id);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setAlias($alias);
        $this->setCorreo($correo);
        $this->setContrasenia($contrasenia);
        $this->setDepartamento($departamento);
        $this->setMunicipio($municipio);
        $this->setDui($dui);
		$this->setAcepta_Terminos($acepta_terminos);
		$this->setTipoUsuario($tipoUsuario);
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

	public function getCorreo(){
		return $this->correo;
	}

	public function setCorreo($correo){
		$this->correo = $correo; 
	}

	public function getContrasenia(){
		return $this->contrasenia;
	}

	public function setContrasenia($contrasenia) {
		$this->contrasenia=$contrasenia;
	}

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    public function getDui()
    {
        return $this->dui;
    }

    public function setDui($dui)
    {
        $this->dui = $dui;
	}

	public function getAcepta_Terminos(){
		return $this->acepta_terminos;
	}

	public function setAcepta_Terminos($acepta_terminos){
		$this->acepta_terminos=$acepta_terminos;
	}

	public function getTipoUsuario(){
		return $this->tipoUsuario;
	}

	public function setTipoUsuario($tipoUsuario){
		$this->tipoUsuario = $tipoUsuario;
	}


	//función para obtener todos los usuarios
	public static function all(){
		$listaUsuarios =[];
		$db=Db::getConnect();
		$sql=$db->query('SELECT * FROM usuarios ORDER BY id DESC');

		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($sql->fetchAll() as $usuario) {
			$listaUsuarios[] = new Usuario(
				$usuario['id'],
				$usuario['nombre'], 
				$usuario['apellido'],
				$usuario['alias'],
				$usuario['correo'],
				$usuario['contrasenia'],
				$usuario['departamento'],
				$usuario['municipio'],
				$usuario['dui'],
				$usuario['acepta_terminos'],
				$usuario['tipo_usuario']
			);
		}
		return $listaUsuarios;
	}

	public static function save($usuario){
		$db=Db::getConnect();
		$insert=$db->prepare('INSERT INTO usuarios VALUES (NULL,:nombre,:apellido,:alias,:correo,:contrasenia,:departamento,:municipio,:dui,:acepta_terminos,:tipoUsuario)');
		$insert->bindValue('nombre',$usuario->getNombre());
		$insert->bindValue('apellido',$usuario->getApellido());
		$insert->bindValue('alias',$usuario->getAlias());
		$insert->bindValue('correo',$usuario->getCorreo());
		//encripta la clave
		$newPass = password_hash($usuario->getContrasenia(), PASSWORD_DEFAULT);
		//var_dump($pass);
		//die();
		$insert->bindValue('contrasenia',$newPass);
		$insert->bindValue('departamento',$usuario->getDepartamento());
		$insert->bindValue('municipio',$usuario->getMunicipio());
		$insert->bindValue('dui',$usuario->getDui());
		$insert->bindValue('acepta_terminos',$usuario->getAcepta_Terminos());
		$insert->bindValue('tipoUsuario',$usuario->getTipoUsuario());
		$insert->execute();
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
			$listaFiltro[]= new Usuario($usuario['id'],$usuario['nombre'], $usuario['apellido'],$usuario['alias'],$usuario['correo'], $usuario['contrasenia'], $usuario['departamento'], $usuario['pregunta'],$usuario['fecha_ingreso'],$usuario['pago'],$usuario['acode'],$usuario['estado'],$usuario['foto']);

		}
		return $listaFiltro;
		
		
	}

	//la función para registrar un usuario
	

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
		$update=$db->prepare('UPDATE usuarios SET alias=:alias, nombres=:nombres, apellidos=:apellidos, correo=:correo WHERE id=:id');
		$update->bindValue('id',$usuario->id);
		$update->bindValue('alias',$usuario->alias);
		$update->bindValue('nombres',$usuario->nombres);
		$update->bindValue('apellidos',$usuario->apellidos);
		$update->bindValue('correo',$usuario->correo);
		$update->execute();
	}
	public static function updatepass($usuario){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE usuarios SET alias=:alias, nombres=:nombres, apellidos=:apellidos, correo=:correo, clave=:clave WHERE id=:id');
		$update->bindValue('id',$usuario->id);
		$update->bindValue('alias',$usuario->alias);
		$update->bindValue('nombres',$usuario->nombres);
		$update->bindValue('apellidos',$usuario->apellidos);
		$update->bindValue('correo',$usuario->correo);
		$update->bindValue('clave',$usuario->clave);
		$update->execute();
	}

	//function update code for reset password
	public static function updatecode($usuario){
		$db=Db::getConnect();
		$update=$db->prepare('UPDATE usuarios SET acode=:acode WHERE correo=:correo');
		$update->bindValue('correo',$usuario->correo);
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
		$usuario = new Usuario(
			$usuarioDb['id'],
			$usuarioDb['nombre'], 
			$usuarioDb['apellido'],
			$usuarioDb['alias'],
			$usuarioDb['correo'],
			$usuarioDb['contrasenia'],
			$usuarioDb['departamento'],
			$usuarioDb['municipio'],
			$usuarioDb['dui'],
			$usuarioDb['acepta_terminos'],
			$usuarioDb['tipo_usuario']
		);
		
		return $usuario;
	}

	public static function getByEmail($correo){
		//buscar
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM usuarios WHERE correo=:correo');
		$select->bindValue('correo',$correo);
		$select->execute();
		//asignarlo al objeto usuario
		$usuarioDb=$select->fetch();
		$usuario = new Usuario(
			$usuarioDb['id'],
			$usuarioDb['nombre'], 
			$usuarioDb['apellido'],
			$usuarioDb['alias'],
			$usuarioDb['correo'],
			$usuarioDb['contrasenia'],
			$usuarioDb['departamento'],
			$usuarioDb['municipio'],
			$usuarioDb['dui'],
			$usuarioDb['acepta_terminos'],
			$usuarioDb['tipo_usuario']
		);
		
		return $usuario;
	}
	
	
	//función para obtener todos los usuarios

	public static function findByEmail($correo){
		$listaUsuarios =[];
		$db=Db::getConnect();
		$query=$db->prepare('SELECT * FROM usuarios WHERE correo=:correo');
		$query->bindValue("correo",$correo);		
		$query->execute();
		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($query->fetchAll() as $usuario) {
			$listaUsuarios[] = new Usuario(
				$usuario['id'],
				$usuario['nombre'], 
				$usuario['apellido'],
				$usuario['alias'],
				$usuario['correo'],
				$usuario['contrasenia'],
				$usuario['departamento'],
				$usuario['municipio'],
				$usuario['dui'],
				$usuario['acepta_terminos']
			);
		}
		return $listaUsuarios;
	}	
	public static function findByname($name){
		$listaUsuarios =[];
		$db=Db::getConnect();
		$query=$db->prepare('SELECT * FROM usuarios WHERE usuario=:usuario');
		$query->bindValue("usuario",$name);		
		$query->execute();
		// carga en la $listaUsuarios cada registro desde la base de datos
		foreach ($query->fetchAll() as $usuario) {
			$listaUsuarios[] = new Usuario(
				$usuario['id'],
				$usuario['nombre'], 
				$usuario['apellido'],
				$usuario['alias'],
				$usuario['correo'],
				$usuario['contrasenia'],
				$usuario['departamento'],
				$usuario['municipio'],
				$usuario['dui'],
				$usuario['acepta_terminos']
			);
		}
		return $listaUsuarios;
	}	

	
}