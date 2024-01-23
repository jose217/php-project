<?php
if (isset($_SESSION)) {
    session_start();
}
?>

<div class="container">
    <h1 class="mt-3">Meses Activos</h1>
    <button type="button" class="btn btn-primary" onclick="location.href='?controller=mesActivo&action=register'">
        <span class="p-1">
            <i class="fas fa-plus"></i>
        </span>Nuevo
    </button>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span
            class="p-1"><i class="fas fa-filter"></i></span>Buscar</button>
    <button type="button" class="btn btn-success" onclick="location.href='?controller=mesActivo&action=show'"><span
            class="p-1"><i class="fas fa-redo-alt"></i></span>Limpiar</button>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buscar Mes</h5>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item" style="border:none;">
                            <form class="form-inline" action="?controller=mesActivo&action=buscarExtendida"
                                method="post" name="ola" id="oplm">
                                <div class="row">
                                    <div class="col-sm-4 col-xs-2 col-md-4 mb-2">
                                        <div class="form-group">
                                            <input class="form-control" id="annio" name="annio" type="text"
                                                placeholder="annio">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-2 col-md-4 mb-2">
                                        <div class="form-group">
                                            <select type="select" name="mes" class="form-select" id="mes">
                                                <option value="0">mes</option>
                                                <option value="01">enero</option>
                                                <option value="02">febrero</option>
                                                <option value="03">marzo</option>
                                                <option value="04">abril</option>
                                                <option value="05">mayo</option>
                                                <option value="06">junio</option>
                                                <option value="07">julio</option>
                                                <option value="08">agosto</option>
                                                <option value="09">septiembre</option>
                                                <option value="10">octubre</option>
                                                <option value="11">noviembre</option>
                                                <option value="12">diciembre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" mt-3 row">
                                        <label for="estado" class="col-auto col-form-label">Activo ? :</label>
                                        <div class="bootstrap-switch-square col-auto ">
                                            <label for="estado" class="col-auto col-form-label">Sí:</label>
                                            <input type="radio" data-toggle="switch" name="estado" id="estado"
                                                value="si" />
                                        </div>
                                        <div class="bootstrap-switch-square col-auto">
                                            <label for="estado" class="col-auto col-form-label">No:</label>
                                            <input type="radio" data-toggle="switch" name="estado" id="estado"
                                                value="no" />
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <div class="col-xs-4">
                                            <button type="submit" class="btn btn-primary">
                                                <span>
                                                    <i class="fas fa-search"></i>
                                                </span> Buscar
                                            </button>
                                            <button type="button" class="btn btn-secondary" style="margin-left:1%;"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <span>
                                                    <i class="fas fa-times"></i>
                                                </span> Cerrar
                                            </button>
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
    <?php print_r($lista_mes); ?>
    <div style="margin-top:1%;">
        <div class="table-responsive">

            <table id="Table" class="table  research" style="width:100%;">
                <thead>
                    <tr>
                        <th>A&ntilde;o</th>
                        <th>Mes</th>
                        <th>Estado</th>
                        <th id="hide" class="notog" style="width:150px;"></th>
                        <th id="hide" class="notog" style="width: 300px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $m = array(
                        '01' => 'enero',
                        '02' => 'febrero',
                        '03' => 'marzo',
                        '04' => 'abril',
                        '05' => 'mayo',
                        '06' => 'junio',
                        '07' => 'julio',
                        '08' => 'agosto',
                        '09' => 'septiembre',
                        '10' => 'octubre',
                        '11' => 'noviembre',
                        '12' => 'diciembre'
                    );
                    ?>
                    <p></p>
                    <?php foreach ($paginationUtils->getListaElementos() as $mes) { ?>
                        <tr class="accordion">
                            <td>
                                <?php echo $mes->getAnnio(); ?>
                            </td>
                            <td>
                                <?php echo $m[$mes->getMes()]; ?>
                            </td>
                            <?php if ($mes->getEstado() == 'si') {
                                $estado = 'activo';
                            } else if ($mes->getEstado() == 'no') {
                                $estado = 'inactivo';
                            } ?>
                            <td>
                                <?php echo $estado; ?>
                            </td>
                            <td id="hide" class="notog">
                                <button type="button" class="btn btn-danger"
                                    onclick="location.href='?controller=mesActivo&action=delete&id=<?php echo $mes->getId() ?>'">
                                    <span class="p-1">
                                        <i class="bi bi-trash-fill"></i>
                                    </span>Eliminar
                                </button>
                            </td>
                            <td id="hide" class="notog">
                                <button type="button" disabled class="btn btn-primary"
                                    onclick="location.href='?controller=mesActivo&action=showupdate&id=<?php echo $mes->getId() ?>'">
                                    <span class="p-1">
                                        <i class="fas fa-sync-alt"></i>Editar
                                    </span>
                                </button>
                            </td>
                        </tr>
                        <tr class="rowContent" style="border-style:hidden;">
                            <td class="hl" style="width:130px;overflow: auto;">
                                <button type="button" class="btn btn-danger"
                                    onclick="location.href='?controller=mesActivo&action=delete&id=<?php echo $mes->getId() ?>'">
                                    <span class="p-1">
                                        <i class="bi bi-trash-fill"></i>
                                    </span>Eliminar
                                </button>
                            </td>
                            <td class="hl" disabled style="width:130px;overflow: auto;">
                                <button type="button" class="btn btn-primary"
                                    onclick="location.href='?controller=mesActivo&action=showupdate&id=<?php echo $mes->getId() ?>'">
                                    <span class="p-1">
                                        <i class="fas fa-sync-alt"></i>
                                    </span>Editar
                                </button>
                            </td>
                            <td></td>
                            <td></td>
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
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
            <?php } ?>
            <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getPrimero(); ?>">
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
                    <li class="page-item"><a class="page-link" href="?controller=mesActivo&action=show&boton=<?php echo $i ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
            <?php }
            if ($paginationUtils->getVisibleUltimo()) { ?>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link"
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                        <?php echo $paginationUtils->getUltimo(); ?>
                    </a>
                </li>
            <?php } ?>
            <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
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
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
            <?php } ?>
            <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getPrimero(); ?>">
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
                    <li class="page-item"><a class="page-link" href="?controller=mesActivo&action=show&boton=<?php echo $i ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
            <?php }
            if ($paginationUtils->getVisibleUltimo()) { ?>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link"
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                        <?php echo $paginationUtils->getUltimo(); ?>
                    </a>
                </li>
            <?php } ?>
            <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=mesActivo&action=show&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
            <?php } ?>
        </ul>
    </nav>
</div>