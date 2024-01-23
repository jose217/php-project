<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>

<div class="container">
  <div>
  <h2 class="mt-3 ">Registro de Residencial</h2>
  </div>
	<form action="?controller=residencia&action=save" method="post" id="formulario" name="formulario">
      <div class=" mt-3">
        <label for="codigo" class="col-auto col-form-label">Código:</label>
        <div class="col-auto">
          <input type="text" class="form-control" id="codigo" name="codigo" autocomplete="off" required>
        </div>
        <label for="nombre" class="col-auto col-form-label">Residencial:</label>
        <div class="col-auto">
          <input type="text" class="form-control" id="nombre" name="nombre" onkeyup="mayus(this);" autocomplete="off" required>
        </div>
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='?controller=residencia&action=show'">Cancelar</button>
      </div>
	</form>
</div>
<script>
  function mayus(e) 
  {
    e.value = e.value.toUpperCase();
  }
</script>