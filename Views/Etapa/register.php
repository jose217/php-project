<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Registro de Etapa - Cluster - Quartier - Villa - Otros</h2>
  </div>
  <form action="?controller=etapa&action=save" method="post" name="formulario">
    <div class="mt-3">
      <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
      <div class="col-auto">
        <select type="select" name="proyectoId" class="form-select" id="proyectoId" required>
          <option value="1">Sin Seleccion</option>
          <?php foreach ($GET_PROJ_ID as $row) { ?>
            <option value="<?php echo $row->getId(); ?>"><?php echo $row->getNombre(); ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class=" mt-3">
      <label for="codigo" class="col-auto col-form-label">Código:</label>
      <div class="col-auto">
        <input type="text" class="form-control" id="codigo" name="codigo" autocomplete="off" required>
      </div>
    </div>
    <div class=" mt-3">
      <label for="nombre" class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
      <div class="col-auto">
        <input type="text" name="nombre" class="form-control" id="nombre" onkeyup="mayus(this);" autocomplete="off" onkeyup="mayus(this);" required>
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