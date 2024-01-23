<?php if (!isset($_SESSION)) {
    session_start();
}

$meses = array(
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
<div class="container">
    <form action="?controller=evaluacionV&action=generateExcel" method="post">
        <div class="mt-3">
            <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
            <div class="col-auto">
                <select type="select" name="proyectoId" class="form-select" id="proyectoId" required>
                    <option value="" selected>SIN SELECCION</option>
                    <?php foreach ($GET_PROYECTO_ID as $project) { ?>
                        <option value="<?php echo $project->getId(); ?>">
                            <?php echo $project->getNombre(); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mt-3">
                <select name="mesActivo" id="mesActivo" class="form-select" required>
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
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-danger">Generar Reporte</button>
            </div>
    </form>
</div>