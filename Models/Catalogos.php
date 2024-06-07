<?php

class Catalogos
{

    private $id;
    private $codigo;
    private $descripcion;
    private $add;

    public function __construct($id, $codigo, $descripcion, $add)
    {
        $this->setId($id);
        $this->setCodigo($codigo);
        $this->setDescripcion($descripcion);
        $this->setAdd($add);
    }

    // Getter para $id
    public function getId()
    {
        return $this->id;
    }

    // Setter para $id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter para $codigo
    public function getCodigo()
    {
        return $this->codigo;
    }

    // Setter para $codigo
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    // Getter para $descripcion
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    // Setter para $descripcion
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getAdd()
    {
        return $this->add;
    }

    public function setAdd($add)
    {
        $this->add = $add;
    }

    public static function getAll()
    {
        $lista = [];
        $connect = Db::getConnect();
        $sql = $connect->prepare("select id,descripcion from cat_tipo_usuario order by id desc");
        $sql->execute();
        foreach ($sql->fetchAll() as $value) {
            $lista[] = new Catalogos($value['id'], $value['codigo'], $value['descripcion'], null);
        }
        return $lista;
    }

    public static function getDepartamentos()
    {
        $lista = [];
        $conn = Db::getConnect();
        $sql = $conn->prepare("select * from cat_departamentos order by id desc");
        $sql->execute();
        foreach ($sql->fetchAll() as $value) {
            $lista[] = new Catalogos($value['id'], $value['codigo'], $value['descripcion'], null);
        }
        return $lista;
    }

    public static function getDepartamentoById($id)
    {
        $conn = Db::getConnect();
        $sql = $conn->prepare("select * from cat_departamentos where id = :id");
        $sql->bindParam('id', $id);
        $sql->execute();
        $value = $sql->fetch();
        $departamento = new Catalogos($value['id'], $value['codigo'], $value['descripcion'], null);
        return $departamento;
    }

    public static function getMunicipioById($id)
    {
        $conn = Db::getConnect();
        $sql = $conn->prepare("select * from cat_municipios where id = :id");
        $sql->bindParam('id', $id);
        $sql->execute();
        $value = $sql->fetch();
        $municipio = new Catalogos($value['id'], $value['codigo'], $value['descripcion'], $value['departamento']);
        return $municipio;
    }

    public function getArray()
    {
        return array("id" => $this->id, "codigo" => $this->codigo, "descripcion" => $this->descripcion, "add" => $this->add);
    }

    public static function getMunicipiosJSON()
    {
        $lista = "";
        $conn = Db::getConnect();
        $sql = $conn->prepare("select * from cat_municipios order by id");
        $sql->execute();
        foreach ($sql->fetchAll() as $value) {
            $listaMunicipios = new Catalogos($value['id'], $value['codigo'], $value['descripcion'], $value['departamento']);
            $lista .= json_encode($listaMunicipios->getArray()) . ',';
        }
        return substr($lista, 0, -1);
    }

}

?>