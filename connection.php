<?php
	/**
	* Conexión a la base de datos
	* Autor: Elivar Largo
	* Sitio Web: wwww.ecodeup.com
	*/
	class Db
	{
		private static $instance=NULL;
		
		private function __construct(){}

		private function __clone(){}
		
		public static function getConnect(){
			if (!isset(self::$instance)) {
				$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
				self::$instance= new PDO('mysql:host=motion.com.sv;dbname=motion_seac','motion_seac','6hWWeuC6l!aE',$pdo_options);
			}
			return self::$instance;
		}
	}
?>