<?php
if (!isset($_SESSION)) {
    session_start();
}

//import class 
require_once ('Models/Catalogos.php');
require_once ('Utils/paginationUtils.php');
class BodegaController
{
    public function __construct()
    {
    }

    public function showRegister()
    {
        $depa = Catalogos::getDepartamentos();
        $mun = Catalogos::getMunicipiosJSON();
        require_once ('Views/Bodega/register.php');
    }

    public function getMunicipio()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['departamento'])) {
            $departamento = $_POST['departamento'];

            // Aquí deberías tener tu función getMunicipios implementada en el modelo
            $municipios = Catalogos::getMunicipio($departamento);

            // Asegúrate de que la respuesta se codifique correctamente en JSON
            header('Content-Type: application/json');
            echo json_encode($municipios);
            exit;
        }
    }

    public function save()
    {
        $bodega = new Bodega(null, $_POST['codigo'], $_POST['nombre'], $_POST['departamento'], $_POST['municipio'], $_POST['direccion'], date('Y-m-d H:m:s'), $_SESSION['usuario_id']);
        Bodega::save($bodega);
        $_SESSION['mensaje'] = 'Registro guardado correctamente';
        $this->show();
    }

    public function show()
    {
        require_once('Models/Usuario.php');
        $bodegas = Bodega::getAll();
        $registros = 10;
        if (count($bodegas) > $registros) {
            $paginationUtils = PaginationUtils::calcularPaginacion($registros, count($bodegas), $_GET['boton'], $bodegas, 5);
        } else {
            $paginationUtils = new PaginationUtils(1, $bodegas, count($bodegas), 0, 1, 1, 1);
        }
        require_once ('Views/Bodega/show.php');
    }

    public function showUpdate(){
        $id = $_GET['id'];
        $bodega = Bodega::getById($id);
        require_once('Views/Bodega/update.php');
    }

    public function update(){
        $bodega = new Bodega($_POST['id'], $_POST['codigo'], $_POST['nombre'], $_POST['departamento'], $_POST['municipio'], $_POST['direccion'], date('Y-m-d H:m:s'), $_SESSION['usuario_id']);
        Bodega::update($bodega);
        $_SESSION['mensaje'] = 'Registro guardado correctamente';
        $this->show();
    }

}

?>