<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Actualización de Etapa/Quartier/Villa/Cluster</h2>
  </div>
  <form action="?controller=etapa&action=update" method="post" name="formulario">
    <input type="hidden" id="id" name="id" value="<?php echo $etapa->getId(); ?>">
    <div class="mt-3">
      <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
      <div class="col-auto">
        <select type="select" name="proyectoId" class="form-select" id="proyectoId" onkeyup="mayus(this);">
          <?php foreach ($GET_PROJ_ID as $project) {
            if ($etapa->getProyectoId() == $project->getId()) { ?>
              <option value="<?php echo $project->getId(); ?>" selected="true"><?php echo $project->getNombre(); ?></option>
            <?php } else { ?>
              <option value="<?php echo $project->getId(); ?>"><?php echo $project->getNombre(); ?></option>
          <?php }
          } ?>
        </select>
      </div>
    </div>
    <div class=" mt-3">
      <label for="codigo" class="col-auto col-form-label">Código:</label>
      <div class="col-auto">
        <input type="text" class="form-control" id="codigo" name="codigo" autocomplete="off" value="<?php echo $etapa->getCodigo(); ?>" readonly>
      </div>
    </div>
    <div class=" mt-3">
      <label for="nombre" class="col-auto col-form-label">Etapa/Quartier/Villa/Cluster/Otro:</label>
      <div class="col-auto">
        <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="mayus(this);" autocomplete="off" value="<?php echo $etapa->getNombre(); ?>">
      </div>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <button type="button" class="btn btn-secondary" onclick="location.href='?controller=etapa&action=show'">Cancelar</button>
    </div>
  </form>
</div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>