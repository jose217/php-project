<?php if (isset($_SESSION['mensaje'])) { //mensaje, cuando realiza alguna acción crud ?>
    <div class="alert alert-success mt-3">
        <strong>
            <?php echo $_SESSION['mensaje']; ?>
        </strong>
    </div>
<?php }
unset($_SESSION['mensaje']);
?>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Municipio</th>
            <th>Fecha de Modificación</th>
            <th>Usuario</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($paginationUtils->getListaElementos() as $row) { ?>
            <tr>
                <td><?php echo $row->getCodigo(); ?></td>
                <td><?php echo $row->getNombre(); ?></td>
                <td><?php $departamento = Catalogos::getDepartamentoById($row->getDepartamento());
                echo $departamento->getDescripcion(); ?>
                </td>
                <td><?php $municipio = Catalogos::getMunicipioById($row->getMunicipio());
                echo $municipio->getDescripcion(); ?>
                </td>
                <td><?php echo $row->getFechaRegistro(); ?></td>
                <td><?php $usuario = Usuario::getById($row->getUsuarioModificacion());
                echo $usuario->getAlias(); ?></td>
                <td><button type="button" class="btn btn-success"
                        onclick="location.href='?controller=bodega&action=showUpdate&id=<?php echo $row->getId(); ?>'">Actualizar</button>
                </td>
                <td><button type="button" class="btn btn-danger">Eliminar</button></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<p id="p" class="text-letf">Total de registros: <?php echo $paginationUtils->getNumeroElementos(); ?></p>

<nav aria-label="">
    <ul class="pagination justify-content-center">
        <?php if ($paginationUtils->getActivoAnterior()) { ?>
            <li class="page-item">
                <a class="page-link"
                    href="?controller=bodega&action=show&boton=<?php echo $paginationUtils->getAnterior(); ?>">Previous</a>
            </li>
        <?php } else { ?>
            <li class="page-item disabled"><a class="page-link" href="#" aria-disabled="true" tabindex="-1">&laquo;</a></li>
        <?php } ?>
        <?php if ($paginationUtils->getVisiblePrimero()) { ?>
            <li class="page-item"><a class="page-link"
                    href="?controller=bodega&action=show&boton=<?php echo $paginationUtils->getPrimero(); ?>"><?php echo $paginationUtils->getPrimero(); ?></a>
            </li>
            <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
        <?php }
        for ($i = $paginationUtils->getInicioPaginacion(); $i <= $paginationUtils->getNumeroCiclos(); $i++) { ?>
            <?php if ($_GET['boton'] == $i) { ?>
                <li class="page-item active"><a class="page-link" href="#">
                        <?php echo $i; ?><span class="sr-only">(página actual)</span>
                    </a></li>
            <?php } else { ?>
                <li class="page-item"><a class="page-link"
                        href="?controller=bodega&action=show&boton=<?php echo $i ?>"><?php echo $i; ?></a></li>
            <?php } ?>
        <?php }
        if ($paginationUtils->getVisibleUltimo()) { ?>
            <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link"
                    href="?controller=bodega&action=show&boton=<?php echo $paginationUtils->getUltimo(); ?>"><?php echo $paginationUtils->getUltimo(); ?></a>
            </li>
        <?php } ?>
        <?php if ($paginationUtils->getActivoSiguiente()) { ?>
            <li class="page-item"><a class="page-link"
                    href="?controller=bodega&action=show&boton=<?php echo $paginationUtils->getSiguiente(); ?>">next</a>
            </li>
        <?php } else { ?>
            <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
        <?php } ?>
    </ul>
</nav>