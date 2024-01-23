<?php if(!isset($_SESSION))
    {
        session_start();
    } ?>

<div class="container">
    
  <div>
  <h2 class="mt-3 ">Actualizacion de Lectura</h2>
  </div>
	<form method="post" action="?controller=evaluacionV&action=updateTec" name="formulario">
        <input type="hidden" name="id" value="<?php echo $lectura->getId(); ?>">
        <div class="mt-3">
            <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
            <div class="col-sm-10">
              	<select type="select"  name="proyectoId" class="form-select" id="proyectoId" onchange="getEtapa(this,'etapaId',datosEtapa);">
                <?php foreach($GET_PROYECTO_ID as $project){ if($lectura->getProyectoId()==$project->getId()){ ?>
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
          	<select type="select"  name="etapaId" class="form-select" id="etapaId" onchange="getPoligono(this,'poligonoId',datosPoligono);">
                <?php foreach($etapaNoUser as $etapa){ if($lectura->getEtapaId()==$etapa->getId()){ ?>
			          <option value="<?php echo $etapa->getId(); ?>" selected="true"><?php echo $etapa->getNombre(); ?></option>
			    <?php }else{ ?>
                    <option value="<?php echo $etapa->getId(); ?>"><?php echo $etapa->getNombre(); ?></option>
                <?php } } ?>
			</select>
        </div>
      </div>

      <div class="mt-3">
        <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
        <div class="col-auto">
          	<select type="select"  name="poligonoId" class="form-select" id="poligonoId" required>
			        <?php foreach($poligonoNoUser as $poligono){ if($lectura->getPoligonoId()==$poligono->getId()){ ?>
			          <option value="<?php echo $poligono->getId(); ?>" selected="true"><?php echo $poligono->getNombre(); ?></option>
			        <?php }else{ ?>
                        <option value="<?php echo $poligono->getId(); ?>"><?php echo $poligono->getNombre(); ?></option>
              <?php } } ?>
			      </select>
        </div>
      </div>
      <div class="mt-3">
        <label for="loteId" class="col-auto col-form-label">Numero Casa:</label>
        <div class="col-auto">
          	<select type="select" name="loteId" class="form-select" id="loteId" > 
              <?php foreach($loteNoUser as $lote){ if($lectura->getLoteId()==$lote->getId()){ ?>
			          <option value="<?php echo $lote->getId(); ?>" selected="true"><?php echo $lote->getNumeroLote(); ?></option>
			        <?php }else{ ?>
                        <option value="<?php echo $lote->getId(); ?>"><?php echo $lote->getNumeroLote(); ?></option>
              <?php } } ?>
			</select>
        </div>
      </div>
      <div class=" mt-3">
        <label for="numeroSerieMedidor" class="col-auto col-form-label">Número Serie del Medidor:</label>
        <div class="col-auto">
          <input type="text" class="form-control" name="numeroSerieMedidor" id="numeroSerieMedidor" autocomplete="off" value="<?php echo $lectura->getNumSerieMedidor(); ?>">
        </div>
      </div>
      
      <div class="mt-3">
        <label for="estadoMedidor" class="col-auto col-form-label">Estado Medidor:</label>
        <div class="col-auto">
          	<select type="select"  name="estadoMedidor" class="form-select" id="estadoMedidor">
                <?php foreach($estadoMedidorList as $medidor){ if($lectura->getEstadoMedidor()==$medidor->getId()){ ?>
			            <option value="<?php echo $medidor->getId(); ?>" selected="true"><?php echo $medidor->getDescripcion(); ?></option>
			        <?php }else{ ?>
                        <option value="<?php echo $medidor->getId(); ?>"><?php echo $medidor->getDescripcion(); ?></option>
                    <?php } } ?>
			</select>
        </div>
      </div>
      <div class="mt-3">
        <label for="lecturaFinal" class="col-auto col-form-label">Lectura:</label>
        <div class="col-auto">
          <input type="text" name="lecturaFinal" class="form-control" id="lecturaFinal" autocomplete="off" value="<?php echo $lectura->getLecturaFinal(); ?>">
        </div>
      </div>
      <div class="mt-3">
        <label for="consumo" class="col-auto col-form-label">Consumo:</label>
        <div class="col-auto">
          <input type="text" name="consumo" class="form-control" id="consumo" autocomplete="off" value="<?php //echo $lectura->getConsumo();?>">
        </div>
      </div>
      
      <div class="mt-3">
        <label for="" class="col-auto col-form-label">Estado de Vivienda:</label>
        <div class="col-auto">
          <div class="form-check form-check-inline">
           
                
            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="estadoVivienda" value="Habitada" <?php if($lectura->getEstadoVivienda()=='Habitada'){echo 'checked';}  ?> >
            <label class="form-check-label" for="inlineCheckbox1">Habitada</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="estadoVivienda" value="No Habitada" <?php if($lectura->getEstadoVivienda()=='No Habitada'){echo 'checked';} ?>>
            <label class="form-check-label" for="inlineCheckbox1">No Habitada</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="estadoVivienda" value="Abandonada" <?php if($lectura->getEstadoVivienda()=='Abandonada'){echo 'checked';} ?>>
            <label class="form-check-label" for="inlineCheckbox1">Abandonada</label>
          </div>
        </div>
      </div>
      <div class="mt-3">
        <label for="tipoVivienda" class="col-auto col-form-label">Tipo de Vivienda:</label>
        <div class="col-auto">
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda1" value="Residencia" <?php if($lectura->getTipoVivienda()=='Residencia'){echo 'checked';} ?>>
            <label class="form-check-label" for="inlineCheckbox1">Residencia</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda2" value="Negocio" <?php if($lectura->getTipoVivienda()=='Negocio'){echo 'checked';}?>>
            <label class="form-check-label" for="inlineCheckbox1">Negocio</label>
          </div>
        </div>
      </div>
      <div class="mt-3" id="tipoNdiv">
        <label for="tipoNegocio" id="tipoNegocio" class="col-auto col-form-label">Tipo de Negocio:</label>
        <div class="col-auto">
          	<select type="select"  name="tipoNegocio" class="form-select" id="tipoNegocio">
                <?php foreach($tipoNegocioList as $TNEGOCIO){ if($lectura->getTipoNegocio()==$TNEGOCIO->getId()){?>
			            <option value="<?php echo $TNEGOCIO->getId(); ?>" selected="true"><?php echo $TNEGOCIO->getDescripcion(); ?></option>
			    <?php }else{ ?>
                        <option value="<?php echo $TNEGOCIO->getId(); ?>"><?php echo $TNEGOCIO->getDescripcion(); ?></option>
                <?php } } ?>
			</select>
        </div>
      </div>
      <div class="mt-3">
        <button type="submit" class="btn btn-primary col-sm-2" >Guardar</button>
        <button type="button" class="btn btn-secondary " onclick="location.href='?controller=evaluacionV&action=showLecturaEMP'">Cancelar</button>
      </div>
	</form>
</div>
<!-- scripts for functions select -->
<script>
    $(document).ready(function(){
        if ($('#tipoVivienda1').is(':checked')) {
            $("#tipoNdiv").hide();
        }
        if ($('#tipoVivienda2').is(':checked')) {
            $("#tipoNdiv").show();
        }
        
    });
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="Residencia"){
            $("#tipoNdiv").hide('slow');
            

        }
        if($(this).attr("value")=="Negocio"){
            $("#tipoNdiv").show('slow');

        }        
    });

    var datosEtapa = [<?php echo $GET_ETAPA_LIST; ?>];  
  
    function getEtapa(sel, idsel, datos){
      $("#"+idsel).find('option').remove().end();
      $("#"+idsel).append('<option value="1">Sin Seleccion</option>');
      $.each( datos, function( key, value ) {      
        if(value.proyectoId == sel.value){
          $("#"+idsel).append('<option value="'+value.id+'">'+value.nombre+'</option>');
        }
      });
    };

    var datosPoligono = [<?php echo $GET_POLIGONO_LIST;  ?>];

    function getPoligono(sel, idsel, datos){
      $("#"+idsel).find('option').remove().end();
      $("#"+idsel).append('<option value="1">Sin Seleccion</option>');
      $.each( datos, function( key, value ) {      
        if(value.etapaId == sel.value){
          $("#"+idsel).append('<option value="'+value.id+'">'+value.nombre+'</option>');
        }
      });
    };

    var datosLote = [<?php echo $GET_LOTE_LIST; ?>];

    function getLote(sel, idsel, datos){
      $("#"+idsel).find('option').remove().end();
      $("#"+idsel).append('<option value="1">Sin Seleccion</option>');
      $.each( datos, function( key, value ) {      
        if(value.poligonoId == sel.value){
          $("#"+idsel).append('<option value="'+value.id+'">'+value.numeroLote+'</option>')
        }
      });
    };
    </script>