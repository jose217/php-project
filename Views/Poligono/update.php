<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>
<div class="container">
	<h2 class="mt-3">Actualizar Polígono</h2>
	<form class="form-horizontal" action='?controller=poligono&action=update' method='post'>
    <input type="hidden" name="id" value="<?php echo $poligono->getId(); ?>">
      <div class="mt-3">
        <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
        <div class="col-sm-10">
          	<select type="select"  name="proyectoId" class="form-select" id="proyectoId" onchange="getEtapa(this,'etapaId',datosEtapa);">
            <?php foreach($GET_PROJECT_ID as $project){ if($poligono->getProyectoId()==$project->getId()){ ?>
			        <option value="<?php echo $project->getId(); ?>" selected="true"><?php echo $project->getNombre(); ?></option>
			        <?php }else{ ?>
              <option value="<?php echo $project->getId(); ?>"><?php echo $project->getNombre(); ?></option>
              <?php } } ?>
			      </select>
        </div>
      </div>
      <div class="mt-3">
        <label for="etapaId" class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
        <div class="col-sm-10">
          	<select type="select"  name="etapaId" class="form-select" id="etapaId">
              <?php foreach($GET_ETAPA_ID_V2 as $etapa){ if($poligono->getEtapaId()==$etapa->getId()){ ?>
			          <option value="<?php echo $etapa->getId(); ?>" selected="true"><?php echo $etapa->getNombre(); ?></option>
			        <?php }else{ ?>
                <option value="<?php echo $etapa->getId(); ?>"><?php echo $etapa->getNombre(); ?></option>
              <?php } } ?>
			      </select>
        </div>
      </div>

    <div class="form-group mt-3">
      <label class=" col-sm-2" for="nombre">Polígono:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $poligono->getNombre(); ?>" required="true" autocomplete="off">
      </div>
    </div>

    <div class="mt-3 ">
      <button type="submit" class="btn btn-success col-md-2"> <i class="fas fa-save"></i> Guardar</button>
      <button type="button" class="btn btn-danger col-md-2" onclick="location.href='?controller=poligono&action=show'"><i class="fas fa-window-close"></i> Cancelar</button>
    </div>
  </form>
</div>

<!-- scripts for functions select -->
<script>
    var datosEtapa = [<?php echo $GET_ETAPA_ID; ?>];
  
    function getEtapa(sel, idsel, datos){
      $("#"+idsel).find('option').remove().end();
      $.each( datos, function( key, value ) {      
        if(value.proyectoId == sel.value){
          $("#"+idsel).append('<option value="'+value.id+'" selected="true">'+value.nombre+'</option>')
          // document.getElementById("numeroSerieMedidor").value = ''+value.numeroSerieMedidor+''; 
        }
      });
    };
</script>
