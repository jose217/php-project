<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Registro de Tipos de Negocio</h2>
  </div>
  <form action="?controller=catalogos&action=saveTipoNegocio" method="post" name="formulario">
    <div class="mt-3">
      <label for="proyectoId" class="col-auto col-form-label">Tipo de negocio:</label>

      <div class="col-auto">
        <input type="text" name="descripcion" class="form-control" id="descripcion" onkeyup="mayus(this);"
          autocomplete="off" required>
      </div>
    </div>
    <br />
    <button type="submit" class="btn btn-primary">Guardar</button>
    <button type="button" class="btn btn-secondary"
      onclick="location.href='?controller=catalogos&action=showTNegocio'">Cancelar</button>
  </form>
</div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>