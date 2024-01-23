<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Registro de Casa</h2>
  </div>
  <form method="post" action="?controller=lote&action=update" name="formulario">
    <input type="hidden" name="id" value="<?php echo $lote->getId(); ?>">
    <div class="mt-3">
      <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
      <div class="col-auto">
        <select type="select" name="proyectoId" class="form-select" id="proyectoId" onchange="getEtapa(this,'etapaId',datosEtapa);">
          <?php foreach ($GET_PROYECTO_ID as $project) {
            if ($lote->getProyectoId() == $project->getId()) { ?>
              <option value="<?php echo $project->getId(); ?>" selected="true"><?php echo $project->getNombre(); ?></option>
            <?php } else { ?>
              <option value="<?php echo $project->getId(); ?>"><?php echo $project->getNombre(); ?></option>
          <?php }
          } ?>
        </select>
      </div>
    </div>
    <div class="mt-3">
      <label for="etapaId" class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
      <div class="col-auto">
        <select type="select" name="etapaId" class="form-select" id="etapaId" onchange="getPoligono(this,'poligonoId',datosPoligono);">
          <?php foreach ($GET_ETAPA_ID_V2 as $etapa) {
            if ($lote->getEtapaId() == $etapa->getId()) { ?>
              <option value="<?php echo $etapa->getId(); ?>" selected="true"><?php echo $etapa->getNombre(); ?></option>
            <?php } else { ?>
              <option value="<?php echo $etapa->getId(); ?>"><?php echo $etapa->getNombre(); ?></option>
          <?php }
          } ?>
        </select>
      </div>
    </div>

    <div class="mt-3">
      <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
      <div class="col-auto">
        <select type="select" name="poligonoId" class="form-select" id="poligonoId" required>
          <?php foreach ($GET_POLIGONO_ID_V2 as $poligono) {
            if ($lote->getPoligonoId() == $poligono->getId()) { ?>
              <option value="<?php echo $poligono->getId(); ?>" selected="true"><?php echo $poligono->getNombre(); ?></option>
            <?php } else { ?>
              <option value="<?php echo $poligono->getId(); ?>"><?php echo $poligono->getNombre(); ?></option>
          <?php }
          } ?>
        </select>
      </div>
    </div>

    <div class=" mt-3">
      <label for="numeroLote" class="col-auto col-form-label">Número de Casa:</label>
      <div class="col-auto">
        <input type="text" required="true" class="form-control" name="numeroLote" id="numeroLote" autocomplete="off" value="<?php echo $lote->getNumeroLote(); ?>">
      </div>
    </div>
    <div class=" mt-3">
      <label for="numeroSerieMedidor" class="col-auto col-form-label">Número Serie del Medidor:</label>
      <div class="col-auto">
        <input type="text" class="form-control" name="numeroSerieMedidor" required="true" id="numeroSerieMedidor" autocomplete="off" value="<?php echo $lote->getNumeroSerieMedidor(); ?>">
      </div>
    </div>
    <div class=" mt-3">
      <label for="orden" class="col-auto col-form-label">Orden:</label>
      <div class="col-auto">
        <input type="number" class="form-control" name="indice" required id="indice" autocomplete="off" value="<?php echo $lote->getIndice(); ?>">
        <p id="p6"></p>
      </div>
    </div>

    <div class=" mt-3">
      <label for="numeroSerieMedidor" class="col-auto col-form-label">Código de Cliente:</label>
      <div class="col-auto">
        <input type="text" class="form-control" name="codigoCliente" id="codigoCliente" onkeyup="mayus(this);" value="<?php echo $lote->getCodCliente();?>">
        <p id="p7"></p>
      </div>
    </div>

    <div class="mt-3">
      <button type="submit" class="btn btn-primary col-sm-2">Guardar</button>
      <button type="button" class="btn btn-secondary " onclick="location.href='?controller=lote&action=show'">Cancelar</button>
    </div>
  </form>
</div>
<!-- scripts for functions select -->
<script>
  var datosEtapa = [<?php echo $GET_ETAPA_LIST; ?>];

  function getEtapa(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $("#" + idsel).append('<option value="1">Sin Seleccion</option>')
    $.each(datos, function(key, value) {
      if (value.proyectoId == sel.value) {
        $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
      }
    });
  };
  var datosPoligono = [<?php echo $GET_POLIGONO_LIST; ?>];

  function getPoligono(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $("#" + idsel).append('<option value="1">Sin Seleccion</option>')
    $.each(datos, function(key, value) {
      if (value.etapaId == sel.value) {
        $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
      }
    });
  };

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>