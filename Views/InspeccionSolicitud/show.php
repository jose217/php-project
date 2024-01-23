<?php if (!isset($_SESSION)) {
    session_start();

} ?>
<div class="container">
    <h1 class="mt-3">Solicitudes de Inspección</h1>

    <button type="button" class="btn btn-primary" 
        onclick="location.href='?controller=InspeccionSolicitud&action=register'">
        <span class="p-1">
            <i class="fas fa-plus"></i>
        </span>Nuevo
    </button>
    <button type="button" class="btn btn-secondary"  data-bs-toggle="modal"
        data-bs-target="#staticBackdrop">
        <span class="p-1">
            <i class="fas fa-filter"></i>
        </span>Buscar
    </button>
    <button type="button" class="btn btn-success" 
        onclick="location.href='?controller=InspeccionSolicitud&action=show'">
        <span class="p-1">
            <i class="fas fa-redo-alt"></i>
        </span>Limpiar
    </button>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Solicitud</h5>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item" style="border:none;">
                            <form class="form-inline" action="?controller=InspeccionSolicitud&action=buscar"
                                method="post" name="ola" id="oplm">
                                <div class="">
                                    <label for="residencial" class="col-auto col-form-label">Residencial:</label>
                                    <div class="col-auto">
                                        <select type="select" name="residencial" class="form-select" id="residencial"
                                            required>
                                            <option value="0">Sin Seleccion</option>
                                            <?php foreach ($GET_PROJ_ID as $row) { ?>
                                                <option value="<?php echo $row->getId(); ?>">
                                                    <?php echo $row->getId(); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="form-group">
                                        <div class="col-xs-4">
                                            <button type="submit" class="btn btn-primary"><span><i
                                                        class="fas fa-search"></i></span> Buscar</button>
                                            <button type="button" class="btn btn-secondary" style="margin-left:1%;"
                                                data-bs-dismiss="modal" aria-label="Close"><span><i
                                                        class="fas fa-times"></i></span>Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['mensaje'])) { //mensaje, cuando realiza alguna acción crud ?>
        <div class="alert alert-success mt-3">
            <strong>
                <?php echo $_SESSION['mensaje']; ?>
            </strong>
        </div>
    <?php }
    unset($_SESSION['mensaje']);
    ?>
    <div style="margin-top:1%;">
        <div class="table-responsive">

            <table id="Table" class="table research" style="width:100%;">
                <thead>
                    <tr>
                        <th>Código Cliente</th>
                        <th>Estado</th>
                        <th>Fecha de Creación</th>
                        <th id="hide" class="notog" style="width:150px;"></th>
                        <th id="hide" class="notog" style="width: 300px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($paginationUtils->getListaElementos() as $row) {
                        ?>
                        <tr class="accordion">
                            <td>
                                <?php echo $row->getCodCliente(); ?>
                            </td>
                            <td>
                                <?php echo $row->getEstado(); ?>
                            </td>
                            <td>
                                <?php echo $row->getFechaCreacion(); ?>
                            </td>
                            <td id="hide" class="notog"><button type="button" class="btn btn-danger"
                                    onclick="location.href='?controller=InspeccionSolicitud&action=delete&id=<?php echo $row->getId(); ?>'"><span
                                        class="p-1"><i class="bi bi-trash-fill"></i></span>Eliminar</button></td>
                            <td id="hide" class="notog"><button type="button" class="btn btn-primary"
                                    onclick="location.href='?controller=InspeccionSolicitud&action=showupdate&id=<?php echo $row->getId(); ?>'"><span
                                        class="p-1"><i class="fas fa-sync-alt"></i></span>Editar</button></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <p id="p" class="text-letf">Total de registros:
        <?php echo $paginationUtils->getNumeroElementos(); ?>
    </p>
    <nav aria-label="Page navigation " id="lol1">
        <ul class="pagination justify-content-center" id="lol1">
            <?php if ($paginationUtils->getActivoAnterior()) { ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
            <?php } ?>
            <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getPrimero(); ?>">
                        <?php echo $paginationUtils->getPrimero(); ?>
                    </a>
                </li>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
            <?php }
            for ($i = $paginationUtils->getInicioPaginacion(); $i <= $paginationUtils->getNumeroCiclos(); $i++) { ?>
                <?php if ($_GET['boton'] == $i) { ?>
                    <li class="page-item active"><a class="page-link" href="#">
                            <?php echo $i; ?><span class="sr-only">(página
                                actual)</span>
                        </a></li>
                <?php } else { ?>
                    <li class="page-item"><a class="page-link"
                            href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $i ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
            <?php }
            if ($paginationUtils->getVisibleUltimo()) { ?>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                        <?php echo $paginationUtils->getUltimo(); ?>
                    </a>
                </li>
            <?php } ?>
            <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
            <?php } ?>
        </ul>
    </nav>
    <nav aria-label="Page navigation " id="lol">
        <ul class="pagination justify-content-center pagination-sm" id="lol">
            <?php if ($paginationUtils->getActivoAnterior()) { ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
            <?php } ?>
            <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getPrimero(); ?>">
                        <?php echo $paginationUtils->getPrimero(); ?>
                    </a>
                </li>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
            <?php }
            for ($i = $paginationUtils->getInicioPaginacion(); $i <= $paginationUtils->getNumeroCiclos(); $i++) { ?>
                <?php if ($_GET['boton'] == $i) { ?>
                    <li class="page-item active"><a class="page-link" href="#">
                            <?php echo $i; ?><span class="sr-only">(página
                                actual)</span>
                        </a></li>
                <?php } else { ?>
                    <li class="page-item"><a class="page-link"
                            href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $i ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
            <?php }
            if ($paginationUtils->getVisibleUltimo()) { ?>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                        <?php echo $paginationUtils->getUltimo(); ?>
                    </a>
                </li>
            <?php } ?>
            <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=InspeccionSolicitud&action=show&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
            <?php } ?>
        </ul>
    </nav>
</div>
<script>
    var myModalEl = document.getElementById('staticBackdrop')
    myModalEl.addEventListener('hidden.bs.modal', function (event) {
        document.getElementById("oplm").reset();
        $('#staticBackdrop').removeData();
        location.reload();

    });


</script>