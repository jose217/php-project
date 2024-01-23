<?php if (!isset($_SESSION)) {
  session_start();
} ?>
<?php $meses = array(
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
<div class="container">
  <div>
    <h2 class="mt-3 ">Actualizar mes activo</h2>
  </div>
  <form class="form-horizontal" action='?controller=mesActivo&action=update' method='post'>
    <input type="hidden" name="id" id="id" value="<?php echo $activo->getId(); ?>">
    <div class="">
      <label for="annio" class="col-auto col-form-label">A&ntilde;o:</label>
      <div class="col-auto">
        <input type="number" name="annio" class="form-control" id="annio" autocomplete="off"
          value="<?php echo $activo->getAnnio(); ?>" required readonly>
      </div>
    </div>
    <div class="mt-3">
      <label for="mes" class="col-auto col-form-label">Mes:</label>
      <div class="col-auto">
        <select type="select" name="mes" class="form-select" id="mes" required>
          <option value="<?php echo $activo->getMes(); ?>">
            <?php echo $meses[$activo->getMes()]; ?>
          </option>
        </select>
      </div>
    </div>
    <div class=" mt-3 row">
      <label for="estado" class="col-auto col-form-label">Activo ? :</label>
      <div class="bootstrap-switch-square col-auto ">
        <label for="estado" class="col-auto col-form-label">Sí:</label>
        <input type="radio" data-toggle="switch" name="estado" id="estadoTrue" value="si" <?php if ($activo->getEstado() == 'si') {
          echo 'checked';
        } ?> />
      </div>
      <div class="bootstrap-switch-square col-auto">
        <label for="estado" class="col-auto col-form-label">No:</label>
        <input type="radio" data-toggle="switch" name="estado" id="estado" value="no" <?php if ($activo->getEstado() == 'no') {
          echo 'checked';
        } ?> />
      </div>
    </div>
    <div class="mt-3">
      <button type="submit" id="guardar" class="btn btn-primary ">Guardar</button>
      <button type="button" class="btn btn-secondary "
        onclick="location.href='?controller=mesActivo&action=show'">Cancelar</button>
    </div>
  </form>
</div>