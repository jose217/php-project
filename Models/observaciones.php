<?php
class Observaciones{

    private $id;
    private $mesId;
    private $idLote;
    private $idUsuario;
    private $decrip;
    

    function __construct($id, $mesId, $idLote, $idUsuario, $decrip)
    {
        $this->setId($id);
        $this->setMesId($mesId);
        $this->setIdLote($idLote);
        $this->setIdUsuario($idUsuario);
        $this->setDesc($decrip);
        
    }

    public function getId()
    {
		return $this->id;
	}

	public function setId($id)
    {
		$this->id = $id;
	}

    public function getMesId()
    {
        return $this->mesId;
    }

    public function setMesId($mesId)
    {
        $this->mesId=$mesId;
    }

    public function getIdLote()
    {
        return $this->idLote;
    }

    public function setIdLote($idLote)
    {
        $this->idLote=$idLote;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario=$idUsuario;
    }

    public function getDesc()
    {
        return $this->decrip;
    }

    public function setDesc($decrip)
    {
        $this->decrip=$decrip;
    }

   

    public function getDataArray(){
		return array("id" => $this->id,"mesId" => $this->mesId,"idLote" => $this->idLote, "idUsuario" => $this->idUsuario , "decrip" => $this->decrip);		
	}

    public static function saveObservation($observacion)
	{
		$db=Db::getConnect();
		$insert=$db->prepare('INSERT INTO observaciones VALUES (NULL, :mesId, :idLote, :idUsuario, :decrip)');
		$insert->bindValue('mesId', $observacion->getMesId());
		$insert->bindValue('idLote', $observacion->getIdLote());
		$insert->bindValue('idUsuario', $observacion->getIdUsuario());
		$insert->bindValue('decrip', $observacion->getDesc());
		
		$insert->execute();
	}

    public static function observationArray()
	{
        $list = "";
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM observaciones ORDER BY ID');
		$select->execute();
        foreach ($select->fetchAll() as $observacion) {
			$array = new Observaciones($observacion['id'], $observacion['mes_activo_id'], $observacion['lote_id'], $observacion['usuario_id'], $observacion['observacion']);
			$list.=json_encode($array->getDataArray()).','; 
		}
		return substr($list,0,-1);
	}

    
    public static function observacioEnd()
	{
        $list = "";
		$db=Db::getConnect();
		$select=$db->prepare('SELECT * FROM observaciones ORDER BY ID DESC LIMIT 1');
		$select->execute();
        foreach ($select->fetchAll() as $observacion) {
			$array = new Observaciones($observacion['id'], $observacion['mes_activo_id'], $observacion['lote_id'], $observacion['usuario_id'], $observacion['observacion']);
			$list.=json_encode($array->getDataArray()).','; 
		}
		return substr($list,0,-1);
	}
}

?>