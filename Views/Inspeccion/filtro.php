<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="container">
    <div id="title" class="mt-3">
        <h3>Busqueda de Solicitud</h3>
    </div>
    <div id="filter" class="mt-4">
        <form action="?controller=Inspeccion&action=showSolicitudesByClientActive" class="" method="POST">
            <div class="row">
                <div class="col">
                    <input type="text" autocomplete="false" name="codCliente" id="codCliente" class="form-control"
                        placeholder="Ingrese el codigo del cliente o numero de casa">
                </div>
                <div class="col-md-2">
                    <input type="submit" class="form-control btn btn-primary" value="Buscar"><span><i
                            class="fa-solid fa-magnifying-glass"></i></span>
                </div>
            </div>
        </form>
    </div>
    <div class=" mt-3">
        <table class="table">
            <thead>
                <th>Solicitud N°</th>
                <th>Cod. Cliente</th>
                <th>Fecha Solicitud</th>
                <th>Estado de Solicitud</th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach ($paginationUtils->getListaElementos() as $row) { ?>
                    <td>
                        <?php echo $row->getId(); ?>
                    </td>
                    <td>
                        <?php echo $row->getCodCliente(); ?>
                    </td>
                    <td>
                        <?php echo $row->getFechaSolicitud(); ?>
                    </td>
                    <td>
                        <?php echo $row->getEstado(); ?>
                    </td>
                    <td>
                        <div class="row">
                            <button type="button" class="form-control btn btn-primary col-sm-2"
                                onclick="location.href='?controller=Inspeccion&action=register&id=<?php echo $row->getId(); ?>'">Registrar
                                Inspección</button>
                        </div>
                    </td>
                <?php } ?>
            </tbody>
        </table>


    </div>
</div>