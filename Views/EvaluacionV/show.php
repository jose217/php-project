<?php if (!isset($_SESSION)) {
    session_start();

} ?>


<script>
    var datosEtapa = [<?php echo $GET_ETAPA_LIST; ?>];

    function getEtapa(sel, idsel, datos) {
        $("#" + idsel).find('option').remove().end();
        $("#" + idsel).append('<option value="">Sin Seleccion</option>');
        $.each(datos, function (key, value) {
            if (value.proyectoId == sel.value) {
                $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
            }
        });
    };

    var datosPoligono = [<?php echo $GET_POLIGONO_LIST; ?>];

    function getPoligono(sel, idsel, datos) {
        $("#" + idsel).find('option').remove().end();
        $("#" + idsel).append('<option value="">Sin Seleccion</option>');
        $.each(datos, function (key, value) {
            if (value.etapaId == sel.value) {
                $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
            }
        });
    };

    var datosLote = [<?php echo $GET_LOTE_LIST; ?>];

    function getLote(sel, idsel, datos) {
        $("#" + idsel).find('option').remove().end();
        $("#" + idsel).append('<option value="">Sin Seleccion</option>');
        $.each(datos, function (key, value) {
            if (value.poligonoId == sel.value) {
                $("#" + idsel).append('<option value="' + value.id + '">' + value.numeroLote + '</option>')
            }
        });
    };
</script>
<script>
    $(document).ready(function () {
        $("#CategoriaActivo").change(function () {
            $.ajax({
                type: "POST",
                url: "?controller=evaluacionV&action=selectPorMes",
                data: { CategoriaActivo: $("#CategoriaActivo").val() },
                success: function () {
                    //$(".container").load("<--?php //echo '?controller=evaluacionV&action=selectPorMes'; ?>");//
                    location.href = "?controller=evaluacionV&action=selectPorMes";
                }
            });
        });
    });
</script>
<div class="container">
    <h1 class="mt-3">Lista de Toma de Lectura</h1>

    <?php $meses = array(
        '01' => 'ENERO',
        '02' => 'FEBRERO',
        '03' => 'MARZO',
        '04' => 'ABRIL',
        '05' => 'MAYO',
        '06' => 'JUNIO',
        '07' => 'JULIO',
        '08' => 'AGOSTO',
        '09' => 'SEPTIEMBRE',
        '10' => 'OCTUBRE',
        '11' => 'NOVIEMBRE',
        '12' => 'DICIEMBRE'
    );
    ?>

    <button type="button" class="btn btn-primary" 
        onclick="location.href='?controller=evaluacionV&action=register'">
        <span class="p-1">
            <i class="fas fa-plus"></i>
        </span>Nuevo
    </button>
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><span
            class="p-1"><i class="fas fa-filter"></i></span>Buscar</button>
    <button type="button" class="btn btn-success" 
        onclick="location.href='?controller=evaluacionV&action=show'"><span class="p-1"><i
                class="fas fa-redo-alt"></i></span>Limpiar</button>
    <select name="CategoriaActivo" id="CategoriaActivo" class="form-select"
        style="width:15rem; margin-top:1%; margin-left:35%;margin-bottom:2%;">
        <?php foreach ($GET_MES_ID as $listActivo) {
            if ($listActivo->getEstado() == 'si') { ?>
                <option value="<?php echo $listActivo->getId(); ?>" selected>
                    <?php echo $listActivo->getAnnio() . ' - ' . $meses[$listActivo->getMes()]; ?>
                </option>
            <?php } else { ?>
                <option value="<?php echo $listActivo->getId(); ?>">
                    <?php echo $listActivo->getAnnio() . ' - ' . $meses[$listActivo->getMes()]; ?>
                </option>
            <?php }
        } ?>
    </select>


    <!-- &mesActivo='+$('#CategoriaActivo2').val() -->


    <div class="container">
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buscar Evaluaciones</h5>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item" style="border:none;">
                                <form class="form-inline" action="?controller=evaluacionV&action=buscarExtendida"
                                    method="post" name="ola" id="oplm">
                                    <div class="">
                                        <div class="">
                                            <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
                                            <div class="col-auto">
                                                <select type="select" name="proyectoId" class="form-select"
                                                    id="proyectoId" onchange="getEtapa(this,'etapaId',datosEtapa);">
                                                    <option value="null" selected>Sin Selección</option>
                                                    <?php foreach ($GET_PROYECTO_ID as $proyecto) { ?>
                                                        <option value="<?php echo $proyecto->getId(); ?>">
                                                            <?php echo $proyecto->getNombre(); ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <label for="etapaId"
                                                class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
                                            <div class="col-auto">
                                                <select type="select" name="etapaId" class="form-select" id="etapaId"
                                                    onchange="getPoligono(this,'poligonoId',datosPoligono);">
                                                    <!-- informacion extraida de script -->

                                                </select>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
                                            <div class="col-auto">
                                                <select type="select" name="poligonoId" class="form-select"
                                                    id="poligonoId" onchange="getLote(this,'loteId',datosLote);">
                                                    <!-- informacion extraida de script -->

                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="loteId" class="col-auto col-form-label">Numero Casa:</label>
                                            <div class="col-auto">
                                                <select type="select" name="loteId" class="form-select" id="loteId">
                                                    <!-- informacion extraida de script -->

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group mt-3">
                                            <div class="col-xs-4">
                                                <button type="submit" class="btn btn-primary"><span><i
                                                            class="fas fa-search"></i></span> Buscar</button>
                                                <button type="button" class="btn btn-secondary" style="margin-left:1%;"
                                                    data-bs-dismiss="modal" aria-label="Close"><span><i
                                                            class="fas fa-times"></i></span>Cerrar</button>
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
        <?php print_r($lista_evaluaciones); ?>
        <div style="margin-top:1%;">
            <div class="table-responsive">

                <table id="Table" class="table  research" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Residencial</th>
                            <th>Etapa/Quartier/Otros.</th>
                            <th>Polígono</th>
                            <th>Casa</th>
                            <th>N° Serie Medidor</th>
                            <th>Lectura tomada</th>
                            <th>Estado Medidor</th>
                            <th>Estado Vivienda</th>
                            <th>Tipo Vivienda</th>
                            <th id="hide" class="notog" style="width:150px;"></th>
                            <th id="hide" class="notog" style="width: 300px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($paginationUtils->getListaElementos() as $evaluacion) {
                            $proyecto = Residencia::getById($evaluacion->getProyectoId());
                            $etapa = Etapa::getById($evaluacion->getEtapaId());
                            $poligono = Poligono::getById($evaluacion->getPoligonoId());
                            $lote = Lote::getById($evaluacion->getLoteId());
                            $catalogo = Catalogos::getByIdM($evaluacion->getEstadoMedidor())
                                ?>
                            <tr class="accordion">
                                <td>
                                    <?php echo $proyecto->getNombre(); ?>
                                </td>
                                <td>
                                    <?php echo $etapa->getNombre(); ?>
                                </td>
                                <td>
                                    <?php echo $poligono->getNombre(); ?>
                                </td>
                                <td>
                                    <?php echo $lote->getNumeroLote(); ?>
                                </td>
                                <td>
                                    <?php echo $lote->getNumeroSerieMedidor(); ?>
                                </td>
                                <td>
                                    <?php echo $evaluacion->getLecturaFinal(); ?>
                                </td>
                                <td>
                                    <?php echo $catalogo->getDescripcion(); ?>
                                </td>
                                <td>
                                    <?php echo $evaluacion->getEstadoVivienda(); ?>
                                </td>
                                <td>
                                    <?php echo $evaluacion->getTipoVivienda(); ?>
                                </td>
                                <td id="hide" class="notog"><button type="button" class="btn btn-danger"
                                        onclick="location.href='?controller=evaluacionV&action=delete&id=<?php echo $evaluacion->getId(); ?>'"><span
                                            class="p-1"><i class="bi bi-trash-fill"></i></span>Eliminar</button></td>
                                <td id="hide" class="notog"><button type="button" class="btn btn-primary"
                                        onclick="location.href='?controller=evaluacionV&action=showupdate&id=<?php echo $evaluacion->getId(); ?>'"><i
                                            class="fas fa-sync-alt"></i>Editar</button></td>
                            </tr>
                            <tr class="rowContent" style="border-style:hidden;">
                                <td class="hl" style="width:130px;overflow: auto;"><button type="button"
                                        class="btn btn-danger"
                                        onclick="location.href='?controller=evaluacionV&action=delete&id=<?php echo $evaluacion->getId(); ?>'"><span
                                            class="p-1"><i class="bi bi-trash-fill"></i></span>Eliminar</button></td>
                                <td class="hl" style="width:130px;overflow: auto;"><button disabled="true" type="button"
                                        class="btn btn-primary"
                                        onclick="location.href='?controller=evaluacionV&action=showupdate&id=<?php echo $evaluacion->getId(); ?>'">
                                        <i class="fas fa-sync-alt"></i> Editar</button></td>

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
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                    </li>
                <?php } else { ?>
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
                <?php } ?>
                <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                    <li class="page-item"><a class="page-link"
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getPrimero(); ?>">
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
                                href="?controller=evaluacionV&action=show&boton=<?php echo $i ?>">
                                <?php echo $i; ?>
                            </a></li>
                    <?php } ?>
                <?php }
                if ($paginationUtils->getVisibleUltimo()) { ?>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link"
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                            <?php echo $paginationUtils->getUltimo(); ?>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                    <li class="page-item"><a class="page-link"
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
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
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
                    </li>
                <?php } else { ?>
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">&laquo;</a></li>
                <?php } ?>
                <?php if ($paginationUtils->getVisiblePrimero()) { ?>
                    <li class="page-item"><a class="page-link"
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getPrimero(); ?>">
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
                                href="?controller=evaluacionV&action=show&boton=<?php echo $i ?>">
                                <?php echo $i; ?>
                            </a></li>
                    <?php } ?>
                <?php }
                if ($paginationUtils->getVisibleUltimo()) { ?>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link"
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getUltimo(); ?>">
                            <?php echo $paginationUtils->getUltimo(); ?>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($paginationUtils->getActivoSiguiente()) { ?>
                    <li class="page-item"><a class="page-link"
                            href="?controller=evaluacionV&action=show&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
                    </li>
                <?php } else { ?>
                    <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>