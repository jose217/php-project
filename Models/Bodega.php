<?php

class Bodega
{

    private $id;
    private $codigo;
    private $nombre;
    private $departamento;
    private $municipio;
    private $direccion;
    private $fechaRegistro;
    private $usuarioModificacion;

    public function __construct($id, $codigo, $nombre, $departamento, $municipio, $direccion, $fechaRegistro, $usuarioModificacion)
    {
        $this->setId($id);
        $this->setCodigo($codigo);
        $this->setNombre($nombre);
        $this->setDepartamento($departamento);
        $this->setMunicipio($municipio);
        $this->setDireccion($direccion);
        $this->setFechaRegistro($fechaRegistro);
        $this->setUsuarioModificacion($usuarioModificacion);
    }

    //getters
    public function getId()
    {
        return $this->id;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function getMunicipio()
    {
        return $this->municipio;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function getUsuarioModificacion()
    {
        return $this->usuarioModificacion;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    public function setUsuarioModificacion($usuarioModificacion)
    {
        $this->usuarioModificacion = $usuarioModificacion;
    }

    public static function getAll(){
        $lista=[];
        $conn = Db::getConnect();
        $sql = $conn->prepare("select * from bodegas order by id desc");
        $sql->execute();
        foreach($sql->fetchAll() as $row){
            $lista[]=new Bodega($row['id'], $row['codigo'], $row['nombre'], $row['departamento'], $row['municipio'],$row['direccion'], $row['fechaRegistro'], $row['usuarioModificacion']);
        }
        return $lista;
    }

    public static function getById($id){
        $conn = Db::getConnect();
        $sql = $conn->prepare("select * from bodegas where id=:id");
        $sql->bindParam('id', $id);
        $sql->execute();
        $row=$sql->fetch();
        $bod=new Bodega($row['id'], $row['codigo'], $row['nombre'], $row['departamento'], $row['municipio'],$row['direccion'], $row['fechaRegistro'], $row['usuarioModificacion']);
        return $bod;
    }

    public static function save($bodega){
        $conn = Db::getConnect();
        $sql = $conn->prepare('insert into bodegas values (null, :codigo, :nombre, :departamento, :municipio, :direccion, :fechaRegistro, :usuarioModificacion)');
        $sql->bindValue("codigo", $bodega->getCodigo());
        $sql->bindValue("nombre", $bodega->getNombre());
        $sql->bindValue("departamento", $bodega->getDepartamento());
        $sql->bindValue("municipio", $bodega->getMunicipio());
        $sql->bindValue("direccion", $bodega->getDireccion());
        $sql->bindValue("fechaRegistro", $bodega->getFechaRegistro());
        $sql->bindValue("usuarioModificacion", $bodega->getUsuarioModificacion());
        $sql->execute();
    }

    public static function update($bodega){
        $conn = Db::getConnect();
        $sql = $conn->prepare('update bodegas set codigo=:codigo, nombre=:nombre, departamento=:departamento, municipio=:municipio, direccion=:direccion, fechaRegistro=:fechaRegistro, usuarioModificacion=:usuarioModificacion where id=:id');
        $sql->bindValue("id", $bodega->getId());
        $sql->bindValue("codigo", $bodega->getCodigo());
        $sql->bindValue("nombre", $bodega->getNombre());
        $sql->bindValue("departamento", $bodega->getDepartamento());
        $sql->bindValue("municipio", $bodega->getMunicipio());
        $sql->bindValue("direccion", $bodega->getDireccion());
        $sql->bindValue("fechaRegistro", $bodega->getFechaRegistro());
        $sql->bindValue("usuarioModificacion", $bodega->getUsuarioModificacion());
        $sql->execute();
    }
}

?>