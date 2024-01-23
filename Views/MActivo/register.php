<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Mes Activo</h2>
  </div>
  <form class="form-horizontal" action='?controller=mesActivo&action=save' method='post'>
    <div class="">
      <label for="annio" class="col-auto col-form-label">A&ntilde;o:</label>
      <div class="col-auto">
        <input type="number" name="annio" class="form-control" id="annio" autocomplete="off" required>
      </div>
    </div>
    <div class="mt-3">
      <label for="mes" class="col-auto col-form-label">Mes:</label>
      <div class="col-auto">
        <select type="select" name="mes" class="form-select" id="mes" required>
          <option value="0">Sin Selección</option>
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
        <input type="radio" data-toggle="switch" name="estado[]" id="estadoTrue" value="si" />
      </div>
      <div class="bootstrap-switch-square col-auto">
        <label for="estado" class="col-auto col-form-label">No:</label>
        <input type="radio" data-toggle="switch" name="estado[]" id="estado" value="no" />
      </div>
    </div>
    <div class="mt-3">
      <button type="submit" id="guardar" class="btn btn-primary ">Guardar</button>
      <button type="button" class="btn btn-secondary "
        onclick="location.href='?controller=mesActivo&action=show'">Cancelar</button>
    </div>
  </form>
</div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>