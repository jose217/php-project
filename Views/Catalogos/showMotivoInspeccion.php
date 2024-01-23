<?php if (!isset($_SESSION)) {
    session_start();

} ?>

<div class="container">
    <h1 class="mt-3">Motivo de Inspección</h1>

    <button type="button" class="btn btn-primary"
        onclick="location.href='?controller=catalogos&action=registerMotivoInspeccion'">
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
        onclick="location.href='?controller=catalogos&action=showMotivoInspeccion'">
        <span class="p-1">
            <i class="fas fa-redo-alt"></i>
        </span>Limpiar
    </button>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Motivo de Inspección</h5>
                </div>
                <div class="modal-body">
                    <form class="form-inline" action="?controller=catalogos&action=buscarMotivoInspeccion" method="post"
                        name="ola" id="oplm">
                        <div class="container text-center">
                            <div class="row p-1">
                                <div class="col-12">
                                    <input class="form-control" id="descripcion" name="descripcion" type="text"
                                        placeholder="Buscar Motivo de Inspección" required>
                                    <div class="invalid-feedback">
                                        Valar es requerido
                                    </div>
                                </div>
                            </div>
                            <div class="row p-1">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="fas fa-search">
                                        </span> Buscar
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span class="fas fa-times">
                                        </span> Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <?php print_r($lista_emedidor); ?>
    <div style="margin-top:1%;">
        <div class="table-responsive">

            <table id="Table" class="table research" style="width:100%;">
                <thead>
                    <tr>
                        <th>Motivo de Inspección</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($paginationUtils->getListaElementos() as $row) { ?>
                        <tr class="accordion">
                            <td>
                                <?php echo $row->getDescripcion(); ?>
                            </td>
                            <td id="hide" class="notog col-md-2">
                                <button type="button" class="btn btn-danger"
                                    onclick="location.href='?controller=catalogos&action=deleteMotivoInspeccion&id=<?php echo $row->getId(); ?>'">
                                    <span class="p-1"><i class="bi bi-trash-fill"></i></span>
                                    Eliminar
                                </button>
                            </td>
                            <td id="hide" class="notog col-md-2">
                                <button type="button" class="btn btn-primary"
                                    onclick="location.href='?controller=catalogos&action=showupdateMotivoInspeccion&id=<?php echo $row->getId(); ?>'">
                                    <span class="p-1"><i class="fas fa-sync-alt"></i></span>
                                    Editar
                                </button>
                            </td>
                        </tr>
                        <tr class="rowContent" style="border-style:hidden;">
                            <td class="hl" style="overflow: auto;">
                                <button type="button" class="btn btn-danger col-auto"
                                    onclick="location.href='?controller=catalogos&action=deleteMotivoInspeccion&id=<?php echo $row->getId(); ?>'">
                                    <span class="p-1"><i class="bi bi-trash-fill"></i></span>
                                    Eliminar
                                </button>
                            </td>
                            <td class="hl" style="overflow: auto;">
                                <button type="button" class="btn btn-primary col-auto"
                                    onclick="location.href='?controller=catalogos&action=showupdateMotivoInspeccion&id=<?php echo $row->getId(); ?>'">
                                    <span class="p-1"><i class="fas fa-sync-alt"></i></span>
                                    Editar
                                </button>
                            </td>
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
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
            <?php } ?>
            <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getPrimero(); ?>">
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
                            href="?controller=catalogos&action=showEMedidor&boton=<?php echo $i ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
            <?php }
            if ($paginationUtils->getVisibleUltimo()) { ?>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link"
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                        <?php echo $paginationUtils->getUltimo(); ?>
                    </a>
                </li>
            <?php } ?>
            <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
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
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
            <?php } ?>
            <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getPrimero(); ?>">
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
                            href="?controller=catalogos&action=showEMedidor&boton=<?php echo $i ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
            <?php }
            if ($paginationUtils->getVisibleUltimo()) { ?>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link"
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                        <?php echo $paginationUtils->getUltimo(); ?>
                    </a>
                </li>
            <?php } ?>
            <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=catalogos&action=showEMedidor&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
            <?php } ?>
        </ul>
    </nav>

</div>