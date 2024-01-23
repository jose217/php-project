<?php 
/**
* Clase para hacer la paginación de los registros
* Autor: Roberto Mena
* Sitio Web: http://motion.com.sv
* Fecha: 31-08-2020
*/
class PaginationUtils
{
	private $botones;
	private $listaElementos;
	private $numeroElementos;
	private $primero;
	private $ultimo;
	private $anterior;
	private $siguiente;
	private $visiblePrimero;
	private $visibleUltimo;
	private $activoAnterior;
	private $activoSiguiente;
	private $inicioPaginacion;
	private $numeroCiclos;
	private $aux;

	function __construct($botones,$listaElementos,$numeroElementos,$anterior,$siguiente,$inicioPaginacion,$numeroCiclos){
		$this->setListaElementos($listaElementos);
		$this->setNumeroElementos($numeroElementos);
		$this->setPrimero(1);
		$this->setUltimo($botones);
		$this->setAnterior($anterior);
		$this->setSiguiente($siguiente);
		$this->setInicioPaginacion($inicioPaginacion);
		$this->setNumeroCiclos($numeroCiclos);
		$this->setVisiblePrimero(true);
		$this->setVisibleUltimo(true);
		if($this->getPrimero()==$this->getUltimo()){
			$this->setVisiblePrimero(false);
			$this->setVisibleUltimo(false);
		}
	}

	public function setListaElementos($listaElementos){
		$this->listaElementos=$listaElementos;
	}

	public function getListaElementos(){
		return $this->listaElementos;
	}

	public function setNumeroElementos($numeroElementos){
		$this->numeroElementos=$numeroElementos;
	}

	public function getNumeroElementos(){
		return $this->numeroElementos;
	}
	
	public function setPrimero($primero){
		$this->primero=$primero;
	}

	public function getPrimero(){
		return $this->primero;
	}
	
	public function setUltimo($ultimo){
		$this->ultimo=$ultimo;
	}

	public function getUltimo(){
		return $this->ultimo;
	}

	public function setAnterior($anterior){	
		$this->anterior=$anterior;
	}

	public function getAnterior(){
		return $this->anterior;
	}
	
	public function setSiguiente($siguiente){		
		$this->siguiente=$siguiente;
	}

	public function getSiguiente(){
		return $this->siguiente;
	}

	public function getVisiblePrimero()
	{
		return $this->visiblePrimero;
	}

	public function setVisiblePrimero($visiblePrimero)
	{
		$this->visiblePrimero = $visiblePrimero;
	}

	public function getVisibleUltimo()
	{
		return $this->visibleUltimo;
	}

	public function setVisibleUltimo($visibleUltimo)
	{
		$this->visibleUltimo = $visibleUltimo;
	}

	public function getActivoAnterior()
	{
		return $this->activoAnterior;
	}

	public function setActivoAnterior($activoAnterior)
	{
		$this->activoAnterior = $activoAnterior;
	}

	public function getActivoSiguiente()
	{
		return $this->activoSiguiente;
	}

	public function setActivoSiguiente($activoSiguiente)
	{
		$this->activoSiguiente = $activoSiguiente;
	}	

	public static function calcularPaginacion($registros,$numeroElementos,$paginaActual,$lista,$numeroCiclos){
		$inicioPaginacion = 1;
		$numeroPaginasVisibles = 5;		
		if (($numeroElementos%$registros)==0) {
			$botones=$numeroElementos/$registros;
		}else{//si el total de registros de la bd es impar			
			#$botones=($numeroElementos/$registros)+1;
			$aux = fmod($numeroElementos,$registros);
			if($aux == 0){
				$botones=($numeroElementos/$registros);
			}else{
				$botones = floor($numeroElementos/$registros)+1;
			}			
		}

		if($botones<=$numeroCiclos){
			$numeroCiclos = $botones;
		}

		if(!isset($paginaActual)){
			$finalLoop = $registros*1;
			$inicioLoop = 0;
			//Carga los registros a presentar
			for ($i=$inicioLoop; $i < $finalLoop ; $i++) { 
				$listaElementos[]=$lista[$i];
			}			
		}else{
			$finalLoop = $registros*$paginaActual;
			$inicioLoop = $finalLoop-$registros;
			if($botones>=$numeroPaginasVisibles){
				$anterior=$paginaActual-1;
				$siguiente=$paginaActual+1;
				if($paginaActual==1){
					$anterior=1;
					$inicioPaginacion=1;
				}				
				if(($botones-$paginaActual)<$numeroPaginasVisibles){
					$inicioPaginacion=$botones-$numeroPaginasVisibles;					
					if($paginaActual==$botones){
						$siguiente=$botones;
					}					
				}else{
					$inicioPaginacion=$anterior;
				}
				$numeroCiclos=$inicioPaginacion+$numeroPaginasVisibles;			
			}
			//Carga los registros a presentar
			for ($i=$inicioLoop; $i < $finalLoop; $i++) { 
				if ($i<$numeroElementos) {
					$listaElementos[]=$lista[$i];
				}				
			}			
		}
		return new PaginationUtils($botones,$listaElementos,$numeroElementos,$anterior,$siguiente,$inicioPaginacion,$numeroCiclos);
	}
	public function getInicioPaginacion()
	{
		return $this->inicioPaginacion;
	}

	public function setInicioPaginacion($inicioPaginacion)
	{
		$this->inicioPaginacion = $inicioPaginacion;
	}

	public function getNumeroCiclos()
	{
		return $this->numeroCiclos;
	}

	public function setNumeroCiclos($numeroCiclos)
	{
		$this->numeroCiclos = $numeroCiclos;
	}
}
?>