<?php if (!isset($_SESSION)) {
  session_start();
} ?>

<?php if (isset($_SESSION['mensaje'])) { //mensaje, cuando realiza alguna acción crud ?>
<div class="alert alert-success mt-3">
    <strong><?php echo $_SESSION['mensaje']; ?></strong>
</div>
<?php }
		unset($_SESSION['mensaje']);
	?>

<div class="container">
  <div>
    <h2 class="mt-3 ">Actualizacion de Solicitud de Inspección</h2>
  </div>
  <form action="?controller=InspeccionSolicitud&action=update" method="post" name="formulario">
      <input type="hidden" name="id" value="<?php echo $solicitud->getId(); ?>" >
      <div class="mt-3">
        <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
        <div class="col-auto">
          	<select type="select" disabled name="proyectoId" class="form-select" id="proyectoId">
			          <option value="<?php echo $GET_PROYECTO_ID->getId(); ?>"><?php echo $GET_PROYECTO_ID->getNombre(); ?></option>
			      </select>
        </div>
      </div>

      <div class="mt-3">
        <label for="etapaId"  class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
        <div class="col-auto">
          	<select type="select" disabled name="etapaId" class="form-select" id="etapaId" >
			        <option value="<?php echo $GET_ETAPA_ID->getId(); ?>"><?php echo $GET_ETAPA_ID->getNombre(); ?></option>
			      </select>
        </div>
      </div>

      <div class="mt-3">
        <label for="poligonoId"  class="col-auto col-form-label">Poligono:</label>
        <div class="col-auto">
          	<select type="select" disabled name="poligonoId" class="form-select" id="poligonoId">
			        <option value="<?php echo $GET_POLIGONO_ID->getId(); ?>"><?php echo $GET_POLIGONO_ID->getNombre(); ?></option>
			      </select>
        </div>
      </div>

      <div class="mt-3">
        <label for="loteId" class="col-auto col-form-label">Numero Casa:</label>
        <div class="col-auto">
          	<select type="select" disabled name="loteId" class="form-select" id="loteId" > 
			        <option value="<?php echo $GET_LOTE_ID->getId(); ?>"><?php echo $GET_LOTE_ID->getNumeroLote(); ?></option>
			      </select>
        </div>
      </div>  
      
      <div class=" mt-3">
        <label for="codCliente" class="col-auto col-form-label">Cod. Cliente:</label>
        <div class="col-auto">
          <input type="text" class="form-control" id="codCliente" name="codCliente" autocomplete="off" readonly required="true" value="<?php echo $solicitud->getCodCliente(); ?>">
        </div>
      </div>

    <div class="form-check mt-3">
      <input class="form-check-input" type="checkbox" <?php if($solicitud->getHabitada() != null){ echo ' checked '; }  ?> name="habitada" id="habitada" />
      <label class="form-check-label" for="habitada">
        Habitada
      </label>
    </div>

    <div class="form-check mt-3">
      <input class="form-check-input" type="checkbox" value="" <?php if($solicitud->getNegocio() != null){ echo 'checked'; } ?> name="negocio" id="negocio"  />
      <label class="form-check-label" for="negocio">
        Negocio
      </label>
    </div>    
    
    <div class="mt-3">
        <label for="negocioId" id="negocioIdlbl" class="col-auto col-form-label">Tipo de Negocio:</label>
        <div class="col-auto">
          	<select type="select" name="negocioId" class="form-select" id="negocioId">
                <option value="0">Sin Selección</option>
                <?php foreach($tipoNegocioList as $TNEGOCIO){ ?>
                    <?php if($TNEGOCIO->getId() === $solicitud->getNegocioId()){ ?>
			                <option value="<?php echo $TNEGOCIO->getId(); ?>" selected><?php echo $TNEGOCIO->getDescripcion(); ?></option>
                    <?php } else { ?>
			                <option value="<?php echo $TNEGOCIO->getId(); ?>"><?php echo $TNEGOCIO->getDescripcion(); ?></option>
                    <?php } ?>
                  <?php } ?>
			      </select>
        </div>
    </div>

    <div class="mt-3">
        <label for="motivoInspeccion" id="cbx_motivoInspeccion" class="col-auto col-form-label">Motivo:</label>
        <div class="col-auto">
          	<select type="select"  name="cbx_motivoInspeccion" class="form-select" id="cbx_motivoInspeccion">
                <option value="0">Sin Selección</option>
                <?php foreach($GET_MOTIVO_INSP_LIST as $motivoInsp){ ?>
                  <?php if($motivoInsp->getId() === $solicitud->getMtvInspeccionId()){ ?>
			              <option value="<?php echo $motivoInsp->getId(); ?>" selected ><?php echo $motivoInsp->getDescripcion(); ?></option>
                  <?php } else { ?>
			              <option value="<?php echo $motivoInsp->getId(); ?>" ><?php echo $motivoInsp->getDescripcion(); ?></option>
                  <?php } ?>
                <?php } ?>
			      </select>
        </div>
    </div>

    <div class=" mt-3">
        <label for="txa_motivo_insp" class="col-auto col-form-label">Especifique:</label>
        <div class="col-auto">
          <textarea class="form-control" name="txa_motivo_insp" id="txa_motivo_insp" rows="3"><?php echo $solicitud->getEspecificacionMtv(); ?></textarea>
        </div>
    </div>    
      
    <div class="mt-3">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <button type="button" class="btn btn-secondary" onclick="location.href='?controller=InspeccionSolicitud&action=show'">Cancelar</button>
    </div>
  </form>
</div>
<script>
  function mayus(e) {
    e.value = e.value.toUpperCase();
  }
</script>