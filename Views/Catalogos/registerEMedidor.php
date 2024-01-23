<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Registro de Estado Medidor</h2>
  </div>
  <form action="?controller=catalogos&action=saveEMedidor" method="post" id="formulario" name="formulario">
    <div class=" mt-3">
      <label for="descripcion" class="col-auto col-form-label">Estado Medidor:</label>
      <div class="col-auto">
        <input type="text" class="form-control" id="descripcion" name="descripcion" onkeyup="mayus(this);"
          autocomplete="off" required>
      </div>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <button type="button" class="btn btn-secondary"
        onclick="location.href='?controller=catalogos&action=showEMedidor'">Cancelar</button>
    </div>
  </form>
</div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>