<?php if(!isset($_SESSION))
    {
        session_start();
    } 
    ?>

<div id="alrt">

</div>
<div class="container">
  <div>
    <h2 class="mt-3">Registro de Toma de Lectura</h2>
  </div>
  <form class="form-horizontal" method='post' id="eventForm" >
        <div class="col-auto">
            <?php $meses = array(
                                  '01'=>'enero',
                                  '02'=>'febrero',
                                  '03'=>'marzo',
                                  '04'=>'abril',
                                  '05'=>'mayo',
                                  '06'=>'junio',
                                  '07'=>'julio',
                                  '08'=>'agosto',
                                  '09'=>'septiembre',
                                  '10'=>'octubre',
                                  '11'=>'noviembre',
                                  '12'=>'diciembre'
                                ); 
              ?>
            
            <?php foreach($GET_MES_ID as $mes){
                      if($mes->getEstado()=='si' && $mes->getMes()==date('m')){ $m=$mes->getMes(); ?>
          	            <input type="hidden" name="mesActivo" id="mesActivo" value="<?php echo $mes->getId(); ?>">  
                        <p>Mes Activo: <span><button type="button" disabled class="btn btn-sm btn-success"></button><?php echo ' '.$meses[$m] ; ?></span></p>
		
            <?php   }  } ?>
            <?php  foreach ($ultimoRegistro as $ultimo){ 
                      $lote=Lote::getById($ultimo->getLoteId()); 
                      $fechaRe=MesActivo::getById($ultimo->getMesActivo());
              ?>
                    <p>Última Lectura Registrada: Casa N°: <button type="button" disabled class="btn-sm btn btn-secondary"><?php echo $lote->getNumeroLote().' '; ?></button>mes de: <button type="button" disabled class="btn-sm btn btn-secondary"><?php echo ' '.$meses[$fechaRe->getMes()]; ?></button></p>
              <?php }?>
        </div>
      <div class="mt-3">
        <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
        <div class="col-auto">
          	<select type="select" name="proyectoId" class="form-select" id="proyectoId" onchange="getEtapa(this,'etapaId',datosEtapa);">
            <option value="null" selected>Sin Selección</option>
			        <?php foreach($GET_PROYECTO_ID as $proyecto){ ?>
			          <option value="<?php echo $proyecto->getId(); ?>"><?php echo $proyecto->getNombre(); ?></option>
			        <?php } ?>
			      </select>
        </div>
      </div>

      <div class="mt-3">
        <label for="etapaId" class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa/Otro:</label>
        <div class="col-auto">
          	<select type="select" name="etapaId" class="form-select" id="etapaId" onchange="getPoligono(this,'poligonoId',datosPoligono);">
			        <!-- informacion extraida de script -->

			      </select>
        </div>
      </div>

      <div class="mt-3">
        <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
        <div class="col-auto">
          	<select type="select" name="poligonoId" class="form-select" id="poligonoId" onchange="getLote(this,'loteId',datosLote);">
			       <!-- informacion extraida de script -->

			      </select>
        </div>
      </div>
      <div class="mt-3">
        <label for="loteId" class="col-auto col-form-label">Numero Casa:</label>
        <div class="col-auto">
          	<select type="select" name="loteId" class="form-select" id="loteId" onchange="getNumeroSerie(this,'numeroSerieMedidor',datosLote);"> 
                <!-- informacion extraida de script -->

			      </select>
        </div>
      </div>
      <div class="mt-3">
        <label for="numeroSerieMedidor" class="col-auto col-form-label">Número Serie del Medidor:</label>
      <div class="row">
          <div class="col">
            <input type="text" class="form-control" id="numeroSerie" name="numeroSerieMedidor" value="" readonly>
          </div>
          <div class="order-last col-auto">
            <button type="button" class=" btn btn-warning" onclick="$('#show-page').show('slow')">Cambiar Número Serie</button>
          </div>
      </div>
      </div>

      <div id="show-page" class="hide">
        <div id="container-content">
          <div class="mt-3">
            <div class="">
            <div class="alert alert-danger" role="alert">
              Esta a punto de cambiar el numero serie del medidor!
            </div>
              <div class="">
                <input type="text" class="form-control" id="nuevoNumeroSerie" name="nuevoNumeroSerie" placeholder="Nuevo numero de serie" >
              </div>
              <div class="mt-3">
                <button type="button" class="col-auto btn btn-secondary" onclick="updateNumber();">Confirmar</button>
                <button type="button" class="col-auto btn btn-secondary" onclick="$('#show-page').hide('slow')">Cancelar</button>
               
              </div>
            </div>
           </div>
        </div>
      </div>
      <div class="mt-3">
        <label for="estadoMedidor" class="col-auto col-form-label">Estado Medidor:</label>
        <div class="col-auto">
          	<select type="select"  name="estadoMedidor" class="form-select" id="estadoMedidor" onchange="validMedidor()">
                <option value="0" selected>Sin Selección</option>
                <?php foreach($estadoMedidorList as $medidor){ ?>
			            <option value="<?php echo $medidor->getId(); ?>"><?php echo $medidor->getDescripcion(); ?></option>
			          <?php } ?>
            
			      </select>
        </div>
      </div>
      <div class="mt-3">
        <label for="lecturaFinal" class="col-auto col-form-label">Lectura:</label>
        <div class="col-auto">
          <input type="number" name="lecturaFinal" class="form-control" id="lecturaFinal" autocomplete="off" onkeyup="calcularConsumo(this, 'consumo', DatosLecConsumo)">
        </div>
      </div>
      <div class="mt-3">
        <label for="consumo" class="col-auto col-form-label">Consumo:</label>
        <div class="col-auto">
          <input type="number" name="consumo" class="form-control" id="consumo" value="0" autocomplete="off">
        </div>
      </div>
      <div class="mt-3">
          <input type="hidden" name="lecturAnterior" id="lecturaAnterior" value="">
      </div>
      
      <div class="mt-3">
        <label for="" class="col-auto col-form-label">Estado de Vivienda:</label>
        <div class="col-auto">
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="estadoVivienda" value="Habitada">
            <label class="form-check-label" for="inlineCheckbox1">Habitada</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="estadoVivienda" value="No Habitada">
            <label class="form-check-label" for="inlineCheckbox1">No Habitada</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="estadoVivienda[]" type="radio" id="estadoVivienda" value="Abandonada">
            <label class="form-check-label" for="inlineCheckbox1">Abandonada</label>
          </div>
        </div>
      </div>
      <div class="mt-3">
        <label for="tipoVivienda" class="col-auto col-form-label">Tipo de Vivienda:</label>
        <div class="col-auto">
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda" value="Residencia">
            <label class="form-check-label" for="inlineCheckbox1">Residencia</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="tipoVivienda[]" type="radio" id="tipoVivienda" value="Negocio">
            <label class="form-check-label" for="inlineCheckbox1">Negocio</label>
          </div>
        </div>
      </div>
      <div class="mt-3" id="tipoNdiv">
        <label for="tipoNegocio" id="tipoNegocio" class="col-auto col-form-label">Tipo de Negocio:</label>
        <div class="col-auto">
          	<select type="select"  name="tipoNegocio" class="form-select" id="tipoNegocio">
                <option value="0" selected>Sin Selección</option>
                <?php foreach($tipoNegocioList as $TNEGOCIO){ ?>
			            <option value="<?php echo $TNEGOCIO->getId(); ?>"><?php echo $TNEGOCIO->getDescripcion(); ?></option>
			          <?php } ?>
			      </select>
        </div>
      </div>
      <div class="mt-4" id="shotextarea">

      </div>
      <div class="mt-3 row">
      <div class="col-auto">  
      <button type="button" id="guardarContinuar" class="mt-2 btn btn-success" onclick="sendForm()">Guardar y Continuar</button>
      </div>
      <div class="col-auto">
      <button type="submit" class="mt-2 btn btn-primary" id="save" onclick="this.form.action='?controller=evaluacionV&action=save'">Guardar y Salír</button>
      </div>
      <div class="col-auto">
      <button type="button" class="mt-2 btn btn-secondary" onclick="location.href='?controller=evaluacionV&action=show'">Cancelar</button>
      </div>
      <div class="col-auto">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-warning mt-2  " data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showtextarea()"> Observación</button>
        <script>function showtextarea(){if($("#observaciones").length){$("#observaciones").show('slow')}else{$("#shotextarea").append('<textarea class="form-control" id="observaciones"  name="observaciones" rows="3" placeholder="Cuadro de observaciones"></textarea>')}}</script>
      </div>
  </form>
</div>
<!-- scripts onready -->
<script>
  
$( document ).ready(function() {
    $("#tipoNdiv").hide();
    $("#show-page").hide();
    $("#numeroSerie").load(this.getNumeroSerie());
    
  });
</script>
<!-- scripts validations -->
<script>
  
  $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="Residencia"){
            $("#tipoNdiv").hide('slow');
            

        }
        if($(this).attr("value")=="Negocio"){
            $("#tipoNdiv").show('slow');

        }        
    });
</script>
<!-- scripts get data -->
<script>

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

    
    
    function getNumeroSerie(sel, idsel, datos){
      $("#"+idsel).find('option').remove().end();
      $.each( datos, function( key, value ) {      
        if(value.id == sel.value){
          
          $("#numeroSerie").val(value.numeroSerieMedidor);
          
        }
      });
    };

    function sendForm(){
      var lectura = [<?php echo $GET_EXIST; ?>]
      var exist=false;
      $.each( lectura, function( key, value ) {  
        if(value.loteId == $("#loteId").val() && value.mesActivo==$("#mesActivo").val() && value.lecturaFinal==$("#lecturaFinal").val()){
          exist=true;
        }
      });

      if(!exist){
          $.ajax({
            type: "POST",
            url: "?controller=evaluacionV&action=savecontinue",
            data: { proyectoId: $("#proyectoId").val(), 
                    etapaId: $("#etapaId").val(),
                    poligonoId: $("#poligonoId").val(),
                    loteId: $("#loteId").val(),
                    numeroSerieMedidor: $("#numeroSerie").val(),
                    lecturaFinal: $("#lecturaFinal").val(),
                    estadoMedidor: $("#estadoMedidor").val(),
                    estadoVivienda: $("input[id=estadoVivienda]:checked").val(),
                    tipoVivienda: $("input[id=tipoVivienda]:checked").val(),
                    tipoNegocio: $("#tipoNegocio").val(),
                    observaciones: $("#observaciones").val(),
                    mesActivo: $("#mesActivo").val(),
                    lecturaAnterior: $("#lecturaAnterior").val(),
                    consumo: $("#consumo").val()
                  },
            success: function(){
              console.log("Registro guardado correctamente")
              $("#estadoMedidor").get(0).selectedIndex = 0;
              $("#tipoNegocio").get(0).selectedIndex = 0;
              $("#observaciones").val("");
              $("#consumo").val('0');
              $("#observaciones").hide();
              $("#lecturaFinal").val("");
              $("#lecturaAnterior").val("");
              var data=[<?php echo $GET_LOTE_NEXT; ?>]

                // 
                  $.each(data , function( key, value ) {      
                    if(value.poligonoId == $("#poligonoId").val() && value.id == parseFloat($("#loteId").val())+parseFloat(1)){
                        //$("#loteId").val(value.id)
                        //$("#numeroSerie").val(value.numeroSerieMedidor)
                        //$("#loteId").remove('option');
                        //$("#loteId option").attr("selected","selected")
                        //$("#loteId option").attr("selected","selected")
                        //$("#loteId").append('<option value="'+value.id+'">'+value.numeroLote+'</option>')
                        console.log(next+'-'+nextn+'--'+nextns);
                    }
                  });
                  

                // }
            }
          });  
      }
      else
      {
        $("#alrt").append('<div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">Ya existe una lectura registrada similar de esta casa!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>')
      }
    }




  function changeNumber(){
    $.ajax({
      type: "POST",
      url: "?controller=evaluacionV&action=savelastnumber",
      data: { 
              loteId: $("#loteId").val(),
              numeroSerieMedidor: $("#numeroSerie").val()
            },
      success: function(){
        console.log('paramettro enviado correctamente')
      }
    });
  }

  function updateNumber(){
    changeNumber();
    $.ajax({
      type: "POST",
      url: "?controller=evaluacionV&action=updateNewNumber",
      data: { 
              loteId: $("#loteId").val(),
              newNumeroSerie: $("#nuevoNumeroSerie").val()
            },
      success: function(){
        $("#show-page").hide('slow');
        $("#numeroSerie").val($("#nuevoNumeroSerie").val());
        $("#nuevoNumeroSerie").val('');
        
      }
    });
    
  }
  function validMedidor(){
    
    if( $("#estadoMedidor").val()==4 ){
      $("#lecturaFinal").val('0');
      $("#lecturaFinal").attr('readonly', true);
    }
    if( $("#estadoMedidor").val()==5 ){
      $("#lecturaFinal").val('0');
      $("#lecturaFinal").attr('readonly', true);
    }
    if( $("#estadoMedidor").val()==8 ){
      $("#lecturaFinal").val('0');
      $("#lecturaFinal").attr('readonly', true);
    }
    if( $("#estadoMedidor").val()==10 ){
      $("#lecturaFinal").val('0');
      $("#lecturaFinal").attr('readonly', true);
    }
    if( $("#estadoMedidor").val()==12 ){
      $("#lecturaFinal").val('0');
      $("#lecturaFinal").attr('readonly', true);
    }
    if( $("#estadoMedidor").val()!=12 && $("#estadoMedidor").val()!=10 && $("#estadoMedidor").val()!=8 && $("#estadoMedidor").val()!=5 && $("#estadoMedidor").val()!=4){
      $("#lecturaFinal").val(' ');
      $("#lecturaFinal").attr('readonly', false);
    }
  }

  var DatosLecConsumo=[<?php echo $GET_LECTURA_LIST; ?>]
  function calcularConsumo(lec,con,datos)
  {
    
    
    $.each( datos, function( key, value ) {      
        if(value.loteId == $("#loteId").val() && value.mesActivo < $("#mesActivo").val()){

          consumo = parseFloat($("#lecturaFinal").val()) - parseFloat(value.lecturaFinal)
          $("#consumo").val(consumo)
        }
        if(value.lecturaFinal < $("#lecturaFinal").val()){
          $("#lecturaAnterior").val(value.lecturaFinal)
        }
      });
  }
</script>
<!-- <style>
  #obser
  {
    border:none;
    background-color:yellow;
    margin-top: 1% ; 
  }
</style> -->