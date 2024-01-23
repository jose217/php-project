<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>

<div class="container">
<div> 
  <h2 class="mt-3 ">Registro de Poligono</h2>
</div>
	<form class="form-horizontal" action='?controller=poligono&action=save' method='post' id="eventForm">
      <div class="mt-3">
        <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
        <div class="col-auto">
          	<select type="select"  name="proyectoId" class="form-select" id="proyectoId" onchange="getEtapa(this,'etapaId',datosEtapa);" required>
            <option value="1">Sin seleccion</option>
            <?php foreach($GET_PROJECT_ID as $project){ ?>
			        <option value="<?php echo $project->getId(); ?>"><?php echo $project->getNombre(); ?></option>
			        <?php } ?>
			      </select>
        </div>
      </div>
  
      <div class="mt-3">
        <label for="etapaId" class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
        <div class="col-auto">
          	<select type="select"  name="etapaId" class="form-select" id="etapaId" required>
      
			      </select>
        </div>
      </div>
    
      <div class=" mt-3">
        <label for="nombre" class="col-auto col-form-label">Poligono:</label>
        <div class="col-auto">
          <input type="text" name="nombre" class="form-control" id="nombre" autocomplete="off" required onkeyup="mayus(this);"> 
        </div>
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="location.href='?controller=poligono&action=show'">Cancelar</button>

      </div>
  </form>
</div>
<!-- scripts for functions select -->
<script>
    var datosEtapa = [<?php echo $GET_ETAPA_LIST; ?>];
  
    function getEtapa(sel, idsel, datos){
      $("#"+idsel).find('option').remove().end();
      $("#"+idsel).append('<option value="1">Sin Seleccion</option>')
      $.each( datos, function( key, value ) {
        if(value.proyectoId == sel.value){
          $("#"+idsel).append('<option value="'+value.id+'">'+value.nombre+'</option>')
          // document.getElementById("numeroSerieMedidor").value = ''+value.numeroSerieMedidor+''; 
        }
      });
    };
</script>
<script>
  function mayus(e) 
  {
    e.value = e.value.toUpperCase();
  }
</script>