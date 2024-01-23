<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<?php if (isset($_SESSION['mensaje'])) { //mensaje, cuando realiza alguna acción crud ?>
  <div class="alert alert-success mt-3">
    <strong>
      <?php echo $_SESSION['mensaje']; ?>
    </strong>
  </div>
<?php }
unset($_SESSION['mensaje']);
?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Registro de Solicitud de Inspección</h2>
  </div>
  <form action="?controller=InspeccionSolicitud&action=save" method="post" name="formulario">
    <div class="mt-3">
      <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
      <div class="col-auto">
        <select type="select" name="proyectoId" class="form-select" id="proyectoId"
          onchange="getEtapa(this,'etapaId',datosEtapa);">
          <option value="null" selected>Sin Selección</option>
          <?php foreach ($GET_PROYECTO_ID as $proyecto) { ?>
            <option value="<?php echo $proyecto->getId(); ?>">
              <?php echo $proyecto->getNombre(); ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="mt-3">
      <label for="etapaId" class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
      <div class="col-auto">
        <select type="select" name="etapaId" onchange="getPoligono(this,'poligonoId',datosPoligono);"
          class="form-select" id="etapaId">
          <!-- informacion extraida de script -->

        </select>
      </div>
    </div>

    <div class="mt-3">
      <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
      <div class="col-auto">
        <select type="select" name="poligonoId" class="form-select" id="poligonoId"
          onchange="getLote(this,'loteId',datosLote);">
          <!-- informacion extraida de script -->

        </select>
      </div>
    </div>

    <div class="mt-3">
      <label for="loteId" class="col-auto col-form-label">Numero Casa:</label>
      <div class="col-auto">
        <select type="select" name="loteId" class="form-select" id="loteId"
          onchange="getCodCliente(this,'codCliente', getListCodigos);">
          <!-- informacion extraida de script -->

        </select>
      </div>
    </div>

    <div class=" mt-3">
      <label for="codCliente" class="col-auto col-form-label">Cod. Cliente:</label>
      <div class="col-auto">
        <input type="text" class="form-control" id="codCliente" name="codCliente" autocomplete="off" readonly
          required="true">
      </div>
    </div>

    <div class="form-check mt-3">
      <input class="form-check-input" type="checkbox" value="" name="habitada" id="habitada" required>
      <label class="form-check-label" for="habitada">
        Habitada
      </label>
    </div>

    <div class="form-check mt-3">
      <input class="form-check-input" type="checkbox" value="" name="negocio" id="negocio" required>
      <label class="form-check-label" for="negocio">
        Negocio
      </label>
    </div>

    <div class="mt-3">
      <label for="negocioId" id="negocioIdlbl" class="col-auto col-form-label">Tipo de Negocio:</label>
      <div class="col-auto">
        <select type="select" name="negocioId" class="form-select" id="negocioId">
          <option value="0" selected>Sin Selección</option>
          <?php foreach ($tipoNegocioList as $TNEGOCIO) { ?>
            <option value="<?php echo $TNEGOCIO->getId(); ?>">
              <?php echo $TNEGOCIO->getDescripcion(); ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class="mt-3">
      <label for="motivoInspeccion" id="cbx_motivoInspeccion" class="col-auto col-form-label">Motivo:</label>
      <div class="col-auto">
        <select type="select" name="cbx_motivoInspeccion" class="form-select" id="cbx_motivoInspeccion">
          <option value="0" selected>Sin Selección</option>
          <?php foreach ($GET_MOTIVO_INSP_LIST as $motivoInsp) { ?>
            <option value="<?php echo $motivoInsp->getId(); ?>">
              <?php echo $motivoInsp->getDescripcion(); ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>

    <div class=" mt-3">
      <label for="txa_motivo_insp" class="col-auto col-form-label">Especifique:</label>
      <div class="col-auto">
        <textarea class="form-control" name="txa_motivo_insp" id="txa_motivo_insp" rows="3"></textarea>
      </div>
    </div>

    <div class="mt-3 mb-3">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <button type="button" class="btn btn-secondary"
        onclick="location.href='?controller=InspeccionSolicitud&action=show'">Cancelar</button>
    </div>
  </form>
</div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }

  var datosEtapa = [<?php echo $GET_ETAPA_LIST; ?>];

  function getEtapa(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $("#" + idsel).append('<option value="1" selected>Sin Seleccion</option>')
    $.each(datos, function (key, value) {
      if (value.proyectoId == sel.value) {
        $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
      }
    });
  }

  var datosPoligono = [<?php echo $GET_POLIGONO_LIST; ?>];

  function getPoligono(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $("#" + idsel).append('<option value="1" selected>Sin Seleccion</option>')
    $.each(datos, function (key, value) {
      if (value.etapaId == sel.value) {
        $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
      }
    });
  }

  var datosLote = [<?php echo $GET_LOTE_LIST; ?>];

  function getLote(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $("#" + idsel).append('<option value="1">Sin Seleccion</option>');
    $.each(datos, function (key, value) {
      if (value.poligonoId == sel.value) {
        $("#" + idsel).append('<option value="' + value.id + '">' + value.numeroLote + '</option>');
      }
    });
  }

  var getListCodigos = [<?php echo $GET_LOTE_LIST; ?>];

  function getCodCliente(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $.each(datos, function (key, value) {
      if (value.id == sel.value) {
        $("#codCliente").val(value.codCliente);
      }
    });
  }

</script>