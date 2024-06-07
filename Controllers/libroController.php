<?php if(!isset($_SESSION)){ session_start(); }

class LibroController{

    public function __construct(){}

    public function viewRegister(){ require_once('Views/Libro/register.php'); }

}

?>