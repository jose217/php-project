<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>

<div class="container">
    
  <div>
  <h2 class="mt-3 ">Actualización de codigo</h2>
  </div>
  <!-- action="?controller=lote&action=update" -->
	<form method="post"  name="formulario">
      <div class=" mt-3">
        <label for="numeroLote" class="col-auto col-form-label">Número de Casa:</label>
        <div class="col-auto">
          <input type="text" required="true" class="form-control" name="numeroLote" id="numeroLote" autocomplete="off" value="<?php echo $lote->getNumeroLote(); ?>">
        </div>
      </div>
      <div class=" mt-3">
        <label for="numeroSerieMedidor" class="col-auto col-form-label">Nuevo Número Serie del Medidor:</label>
        <div class="col-auto">
          <input type="text" class="form-control" name="numeroSerieMedidor" required="true" id="numeroSerieMedidor" autocomplete="off" value="<?php echo $lote->getNumeroSerieMedidor(); ?>">
        </div>
      </div>
      <div class="mt-3">
        <button type="button" class="btn btn-primary col-sm-2" >Guardar</button>
      </div>
	</form>
</div>