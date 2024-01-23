<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>

<div class="container">
  <div>
  <h2 class="mt-3 ">Actualización de Residencia</h2>
  </div>
	<form action="?controller=residencia&action=update" method="post" name="formulario">
        <input type="hidden" id="id" name="id" value="<?php echo $residencia->getId(); ?>">
        <div class=" mt-3">
        <label for="codigo" class="col-auto col-form-label">Código:</label>
        <div class="col-auto">
          <input type="text" class="form-control" id="codigo" name="codigo" autocomplete="off" value="<?php echo $residencia->getCodigo(); ?>" readonly >
        </div>          
          <label for="nombre" class="col-auto col-form-label">Nombre de residencia:</label>
          <div class="col-auto">
            <input type="text" class="form-control" id="nombre" name="nombre" autocomplete="off" value="<?php echo $residencia->getNombre(); ?>">
          </div>
        </div>
        <div class="mt-3">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-secondary" onclick="location.href='?controller=residencia&action=show'">Cancelar</button>
        </div>
	</form>
</div>