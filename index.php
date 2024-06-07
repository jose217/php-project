<?php 
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	require_once('connection.php');
	if (isset($_GET['controller'])&&isset($_GET['action'])) {							
		$controller=$_GET['controller'];
		$action=$_GET['action'];		
	} else {		
		$controller='usuario';
		if (isset($_SESSION['usuario'])) {			
			$action='welcome';
		}else{
			$action='showLogin';
		}
	}	
	require_once('Views/Layouts/layout.php');

?>