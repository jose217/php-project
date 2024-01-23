<?php
/**
* Controlador UsuarioController, para administrar los usuarios
* Autor: Elivar Largo
* Sitio Web: wwww.ecodeup.com
* Fecha: 20-03-2017
*/
if(!isset($_SESSION))
    {
        session_start();
    }

class UsuarioController
{
	public function __construct(){}

	public function show(){
		//echo 'index desde UsuarioController';
		$usuario=Usuario::getById($_GET['id']);
		require_once('Views/User/show.php');

		
	}

	public function showUsuarios(){
    	require_once('Utils/paginationUtils.php');
		$usuario=usuario::all($_SESSION['usuario_id']);
		$registros=10; // debe ser siempre par
		if (count($usuario)>$registros) { // solo página si el número de registros mostrados es menor que los registros de la bd
      	$paginationUtils = PaginationUtils::calcularPaginacion($registros,count($usuario),$_GET['boton'],$usuario,5);
		}else{// si no se presenta el paginador
			$paginationUtils = new PaginationUtils(1,$usuario,count($usuario),0,1,1,1);
		}
		require_once('Views/User/show.php');
	}


	public function buscar(){
		require_once('Utils/paginationUtils.php');
		
		$filtros=array('nombres'=>$_POST['nombres']);
		$poligono=Usuario::allByFilter($filtros);
		$botones=0;
		$registros=10; // debe ser siempre par
		if(count($poligono)>$registros){
			$paginationUtils=PaginationUtils::calcularPaginacion($registros,count($poligono),$_GET['boton'],$poligono, 5);
		}else{// si no se presenta el paginador
			$paginationUtils= new PaginationUtils(1,$poligono,count($poligono),0,1,1,1);
		}
		require_once('Views/User/show.php');
	}



	public function register(){
		//echo getcwd ();
		require_once('Views/User/register.php');
	}

	//guardar
	public function save1(){
		//validar formulario registrar
		$res = $_POST['g-recaptcha-response'];
		if(!empty($res)){
			//prd
			// $clave_secreta = "6Lftf_caAAAAAB4oVt5ia46EdTJEibhiLxaX-F6J";
			//devlocal
			// $clave_secreta = "6Le1qVEdAAAAAOsKa3gWJFvaGpfb1RUIr0YqKknZ";
			// devonline
			$clave_secreta = "6LeB3DMaAAAAANn1yKdlWD0bFsKV5Yw9B1YZ6jDu";
			$remoto = $_SERVER['REMOTE_ADDR'];
			$verificacion_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clave_secreta&response=$res&remoteip=$remoto");

			//verificacion de la validacion del recaptcha en el servidor
			$jsonRes = json_decode($verificacion_server);
			if($jsonRes->success){
				//si el recaptcha es verificado ejecurara lo siguiente:
					$usuarios=[];
					$usuarios=Usuario::All();
					$existe=False;
					$user1=$_POST['pwd'];
					$user2=$_POST['pwd2'];
					foreach ($usuarios as $usuario) {
						//echo $usuario->alias."<br>".$_POST['alias']."<br>".$usuario->email;
						if (strcmp($usuario->getAlias(),$_POST['alias'])==0 or strcmp($usuario->getEmail(),$_POST['email'])==0) {
							$existe=True;
						}
					}

					if (!$existe && $user1==$user2){

						$acode=rand(999999,111111);
						$estado='inactivo';
						$foto='default.png';
						$pago=0;
						$date=date('Y-m-d H:i:s');
						$email=$_POST['email'];
            			$usuario=new Usuario(null,$_POST['alias'], $_POST['nombres'],$_POST['apellidos'],$email,$_POST['pwd'],null,null,$date,$pago,$acode,$estado,$foto);
						Usuario::save($usuario);
						//var_dump($usuario);
						//die();
						$_SESSION['mensaje']='Registro guardado satisfactoriamente';
						$this->showConfirmation();
						//enviar_correo */
						// require_once('Views/Layouts/layout.php');*/
        				$to=$email;
        				$subject='Activación de la cuenta ';
        				$message = 'Codigo de confirmacion: ['.$acode.'] . Por favor no comparta este codigo con nadie por motivos de segurida.';
        				$headers = array(
        				 	'From' => 'app-clinica@motion.com.sv',
        					'Reply-To' => 'jose360ramos@gmail.com',
        				 	'X-Mailer' => 'PHP/' . phpversion()
        				);
        				mail($to, $subject, $message, $headers);
						//header('Location: index.php');
						//require_once('Views/Layouts/layout.php');*/
					}else{
						$_SESSION['mensaje']='El alias o el correo para tu usuario ya existen';
						header('Location: index.php');
					}
			}else{
				//si no google verificara si es un proceso anormal
				echo"<h1 class='mt-2'>Esta ejecutando un proceso irregular</h1>";

			}
		}else{
			echo"<h1 class='mt-2'>Debe completar el Captcha</1>";
		}
	}

	public function save(){
		$existe=false;
		$consulta=Usuario::all($_SESSION['usuario_id']);
		foreach($consulta as $usuario)
		{
			if (strcmp($usuario->getEmail(),$_POST['email'])==0 ) 
			{
				$existe=True;
			}
		}

		if(!$existe)
		{
			$acode=rand(999999,111111);
			$estado='activo';
			$foto='default.png';
			$pago=0;
			$date=date('Y-m-d H:i:s');
			$tipo=implode(', ', $_POST['tipoVivienda']);
			$email=$_POST['email'];
       	 	$usuario=new Usuario(null,$tipo, $_POST['nombres'],$_POST['apellidos'],$email,$_POST['pwd'],null,null,$date,$pago,$acode,$estado,$foto);
			Usuario::save($usuario);
						//var_dump($usuario);
						//die();
				$_SESSION['mensaje']='Registro guardado satisfactoriamente';
				$this->showUsuarios();
		}
		else
		{
			echo '	<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
					Ya existe un registro con este Correo Electronico!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  			</div>  ';
			$this->register();
		}
		




		//echo getcwd ();
		
	}




	public function confirmation(){
		$usuarios=[];
		$usuarios=Usuario::All();
		$existe=False;
		
		foreach($usuarios as $usuario){
			if(strcmp($usuario->getAcode(),$_POST['acode'])==0){
				$existe=True;
			}
		}

		if(!$existe){
			$_SESSION['mensaje']='Por favor digite correctamente el codigo de confirmacion';
			header('Location: index.php');
		}else{
			$estado='activo';
			$usuario=new Usuario(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,$_POST['acode'],$estado,NULL,null);
			Usuario::confirmation($usuario);
			$_SESSION['mensaje']='Correo confirmado exitosamente';
			$this->showLogin();
			header('Location: index.php');
		}
	}

	public function showConfirmation(){
		require_once('Views/User/confirmation.php');
	}

	public function showregister(){
		$id=$_GET['id'];
		$usuario=Usuario::getById($id);
		require_once('Views/User/update.php');
		//Usuario::update($usuario);
		//header('Location: ../index.php');
	}
	public function showupdate(){
		$id=$_GET['id'];
		$usuario=Usuario::getById($id);
		require_once('Views/User/update.php');
		//Usuario::update($usuario);
		//header('Location: ../index.php');
	}

	public function update(){
		// if the form was submitted
		$nombre=$_POST['nombres'];
		$idu=$_POST['id'];
		$apellido=$_POST['apellidos'];
		$email=$_POST['email'];
		$tipo=implode(', ', $_POST['tipoVivienda']);
		if ($_POST['pwd']!="")	
		{
		$hash=password_hash($_POST['pwd'],PASSWORD_DEFAULT);
		$usuario= new Usuario($idu,$tipo,$nombre,$apellido,$email,$hash,null,null,null,null,null,null,null,$tipo);
		Usuario::updatepass($usuario);
		$_SESSION['mensaje']='Usuario y contraseña actualizado satisfactoriamente.';
		$this->showUsuarios();
		}
		else{
		$usuario= new Usuario($idu,$tipo,$nombre,$apellido,$email,null,null,null,null,null,null,null,null,$tipo);
		Usuario::update($usuario);
		$_SESSION['mensaje']='Usuario actualizado satisfactoriamente';
		$this->showUsuarios();
		}
	}



	public function delete(){
		Usuario::delete($_GET['id']);
		$_SESSION['mensaje']='Registro eliminado satisfactoriamente';
		$this->showUsuarios();
	}

	public function error(){
		require_once('Views/User/error.php');
	}
	public function welcome(){
		require_once('Views/bienvenido.php');
	}

	public function showLogin(){
		require_once('Views/User/login.php');
	}

	//función que valida el usuario esté registrado
	public function login(){
		// echo 'login() <br/>'.$_POST['email'];
		$usuarios=[];
		$usuarios=Usuario::findByEmail($_POST['email']);
		if(isset($usuarios) && !empty($usuarios)) {
			// echo 'isset($usuarios) && !empty($usuarios) <br/>';
			foreach($usuarios as $usuario){
				// echo 'foreach($usuarios as $usuario) <br/>';
				if(password_verify($_POST['pwd'],$usuario->getClave()) && filter_var($usuario->getEstado(),FILTER_DEFAULT)=='activo'){					
					$_SESSION['usuario_id']=$usuario->getId();
					$_SESSION['usuario_alias']=$usuario->getAlias();
					$_SESSION['usuario_nombres']=$usuario->getNombres();
					$_SESSION['usuario_apellidos']=$usuario->getApellidos();
					$_SESSION['usuario_foto']=$usuario->getFoto();
					$_SESSION['usuario_estado']=$usuario->getEstado();
					$_SESSION['usuario']=TRUE;
				}
			}

			if($_SESSION['usuario']){
				$action='welcome';
				require_once('Views/Layouts/layout.php');
				header('Location: index.php');
			}
			else
			{
				$_SESSION['mensaje']='Email o contraseña invalidos';
				$_SESSION['mensaje']='Verifique que su correo fue activado correctamente.';
				$this->errorLogin();	
			}
		}
		else
		{
      		$_SESSION['mensaje']='Email o contraseña invalidos';
			$this->errorLogin();
		}
	}

	public function errorLogin(){
		if(headers_sent()){
			require_once('Views/User/login.php');
		}else{
			header('Location: index.php');
			exit();
		}
	}

	public function logout() {
		unset($_SESSION['usuario']);
		unset($_SESSION['usuario_id']);
		unset($_SESSION['usuario_name']);
		unset($_SESSION['usuario_alias']);
		header('Location: index.php');
	}

	public function validarCedula(){
		// fuerzo parametro de entrada a string
		$retorno="";
        $numero = $_POST['cedula'];
        //var_dump($numero);
        //die();
        // borro por si acaso errores de llamadas anteriores.
        //$this->setError('');
        // validaciones

            //$this->validarInicial($numero, '10');
           // $this->validarCodigoProvincia(substr($numero, 0, 2));
            //$this->validarTercerDigito($numero[2], 'cedula');
            $this->algoritmoModulo10(substr($numero, 0, 9), $numero[9]);
            $retorno='SI';

        $datos = array('estado' => 'ok','nombre' => $nombre, 'apellido' => $apellido, 'edad' => $edad);
        echo  json_encode($datos, true);
	}

	public function algoritmoModulo10($digitosIniciales, $digitoVerificador)
    {
        $arrayCoeficientes = array(2,1,2,1,2,1,2,1,2);
        $digitoVerificador = (int)$digitoVerificador;
        $digitosIniciales = str_split($digitosIniciales);
        $total = 0;
        foreach ($digitosIniciales as $key => $value) {
            $valorPosicion = ( (int)$value * $arrayCoeficientes[$key] );
            if ($valorPosicion >= 10) {
                $valorPosicion = str_split($valorPosicion);
                $valorPosicion = array_sum($valorPosicion);
                $valorPosicion = (int)$valorPosicion;
            }
            $total = $total + $valorPosicion;
        }
        $residuo =  $total % 10;
        if ($residuo == 0) {
            $resultado = 0;
        } else {
            $resultado = 10 - $residuo;
        }
        if ($resultado != $digitoVerificador) {
            //return false;
            //throw new Exception('Dígitos iniciales no validan contra Dígito Idenficador');
        }
        return true;
    }

    public function setError($newError)
    {
        $this->error = $newError;
        return $this;
    }

	public function recovery(){
		require_once('Views/User/recovery.php');
	}

	public function recoverySms(){
		require_once('Views/User/recoverySms.php');
	}

	function confirmationRecovery(){
		require_once('Views/User/confirmationRecovery.php');
	}

	public function RecEmailVerify(){
		//validar formulario registrar
		$res = $_POST['g-recaptcha-response'];
		if(!empty($res)){
			//prod
			// $clave_secreta = "6Lftf_caAAAAAB4oVt5ia46EdTJEibhiLxaX-F6J";
			//devlocal
			//$clave_secreta = "6Le1qVEdAAAAAOsKa3gWJFvaGpfb1RUIr0YqKknZ";
			// devonline
			$clave_secreta = "6LeB3DMaAAAAANn1yKdlWD0bFsKV5Yw9B1YZ6jDu";
			$remoto = $_SERVER['REMOTE_ADDR'];
			$verificacion_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$clave_secreta&response=$res&remoteip=$remoto");

			//verificacion de la validacion del recaptcha en el servidor
			$jsonRes = json_decode($verificacion_server);
			if($jsonRes->success){
				//si el recaptcha es verificado ejecurara lo siguiente:
					$usuarios=[];
					$usuarios=Usuario::All();
					$existe=False;
					foreach ($usuarios as $usuario) {
						
						if (strcmp($usuario->getEmail(),$_POST['email'])==0) {
							$existe=True;
						}
					}

					if (!$existe){
						echo "<script>alert('Correo no encontrado, verifique de nuevo o registre un nuevo correo.')</script>";
						$this->recovery();
					}else{
						$acode=rand(999999,111111);
						$email=$_POST['email'];
						$to=$email;
        				$subject='Restablecer contraseña';
        				$message = 'Codigo de confirmación: ['.$acode.'] . Por favor no comparta este código por motivos de seguridad.';
        				$headers = array(
        				 	'From' => 'app-clinica@motion.com.sv',
        					'Reply-To' => 'jose360ramos@gmail.com',
        				 	'X-Mailer' => 'PHP/' . phpversion()
        				);
        				mail($to, $subject, $message, $headers);
						$usuario = new Usuario(NULL,NULL,NULL,NULL,$_POST['email'],NULL,NULL,NULL,NULL,NULL,$acode,NULL,NULL);
						Usuario::updatecode($usuario);
						$this->confirmationRecovery();
					}
			}else{
				//si no google verificara si es un proceso anormal
				echo"<h1 class='mt-2'>Esta ejecutando un proceso irregular</h1>";

			}
		}else{
			echo"<h1 class='mt-2'>Debe completar el Captcha</1>";
		}
	}

	public function confRecovery(){
		$usuarios=[];
		$usuarios=Usuario::All();
		$existe=False;
		$code=$_POST['acode'];
		foreach($usuarios as $usuario){
			if(strcmp($usuario->getAcode(),$code)==0){
				$existe=True;
			}
		}

		if (!$existe) {
			echo "<script>alert('El codigo ingresado es incorrecto. Por favor verifique.')</script>";
			//echo "<script>window.history.back()</script>";
		}else{
			$password1=$_POST['pwd'];
			$password2=$_POST['pwd2'];
			if($password1==$password2){
				$usuario = new Usuario(NULL,NULL,NULL,NULL,NULL,$_POST['pwd'],NULL,NULL,NULL,NULL,$acode,NULL,NULL);
				Usuario::updatepwd($usuario);
				header('Location: index.php ');
			}else{
				echo "<script>alert('Las claves deben coincidir')</script>";
				$this->confirmationRecovery();
			}
		}
	}


	public function sendSMS(){
		/*
		* Get API key and Sender ID from
		* http://springedge.com
		* Copy php-send-sms-code.php in same directory
		*/
		include 'php-send-sms-code.php';
		$sendsms=new sendsms("1i6xxxxxxxxxxxxxx", "BUxxxx");
		$sendsms->send_sms("99xxxxxxxx", "test sms"); 
	}
}?>
