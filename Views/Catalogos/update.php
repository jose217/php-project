<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Actualización de Tipo de Catalogos</h2>
  </div>
  <form action="?controller=catalogos&action=updateTNegocio" method="post" name="formulario">
    <input type="hidden" id="id" name="id" value="<?php echo $catalogos->getId(); ?>">
    <div class=" mt-3">
      <label for="nombre" class="col-auto col-form-label">Tipo de Negocio:</label>
      <div class="col-auto">
        <input type="text" class="form-control" id="descripcion" name="descripcion" onkeyup="mayus(this);"
          autocomplete="off" value="<?php echo $catalogos->getDescripcion(); ?>">
      </div>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <button type="button" class="btn btn-secondary"
        onclick="location.href='?controller=catalogos&action=showTNegocio'">Cancelar</button>
    </div>
  </form>
</div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>