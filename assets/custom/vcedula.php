<?php
/**
* Validador número de cédula ecuatoriana, adaptado del sitio: https://github.com/diaspar/validacion-cedula-ruc-ecuador/blob/master/validadores/php/ValidarIdentificacion.php
* Autor: Elivar Largo
* Sitio Web: wwww.ecodeup.com
* Fecha: 27-03-2017
*/
	$numero = $_POST['cedula'];
    if ((strlen($numero) != 9)) {
		$datos = array('estado' =>'NO');
		
	} else{ $datos = array('estado' =>'OK');
    echo  json_encode($datos, true);
    }
    
?>