<?php if (!isset($_SESSION)) {
  session_start();
} ?>
<div name="alerta" id="alerta" style="visibility: hidden" class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
  Ya existe un registro con este nombre!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
</div>
<div class="container">
  <div>
    <h2 class="mt-3 ">Registro de Casa</h2>
  </div>
  <form method="post" name="formulario" id="validate-form">
    <div class="mt-3">
      <label for="proyectoId" class="col-auto col-form-label">Residencial:</label>
      <div class="col-auto">
        <select type="select" name="proyectoId" class="form-select" id="proyectoId" onchange="getEtapa(this,'etapaId',datosEtapa);" required>
          <option value="1" selected>Sin Seleccion</option>
          <?php foreach ($GET_PROYECTO_ID as $project) { ?>
            <option value="<?php echo $project->getId(); ?>"><?php echo $project->getNombre(); ?></option>
          <?php } ?>
        </select>
        <p id="p1"></p>
      </div>
    </div>

    <div class="mt-3">
      <label for="etapaId" class="col-auto col-form-label">Etapa/Quartier/Cluster/Villa:</label>
      <div class="col-auto">
        <select type="select" name="etapaId" class="form-select" id="etapaId" onchange="getPoligono(this,'poligonoId',datosPoligono);" required>

        </select>
        <p id="p2"></p>
      </div>
    </div>

    <div class="mt-3">
      <label for="poligonoId" class="col-auto col-form-label">Poligono:</label>
      <div class="col-auto">
        <select type="select" name="poligonoId" class="form-select" id="poligonoId" required>


        </select>
        <p id="p3"></p>
      </div>
    </div>

    <div class=" mt-3">
      <label for="numeroLote" class="col-auto col-form-label">Número de Casa:</label>
      <div class="col-auto">
        <input type="text" required class="form-control" name="numeroLote" id="numeroLote" onkeyup="mayus(this);" autocomplete="off">
        <p id="p4"></p>
      </div>
    </div>
    <div class=" mt-3">
      <label for="numeroSerieMedidor" class="col-auto col-form-label">Número Serie del Medidor:</label>
      <div class="col-auto">
        <input type="text" class="form-control" name="numeroSerieMedidor" id="numeroSerieMedidor" onkeyup="mayus(this);" autocomplete="off">
        <p id="p5"></p>
      </div>
    </div>
    <div class=" mt-3">
      <label for="orden" class="col-auto col-form-label">Orden:</label>
      <div class="col-auto">
        <input type="number" class="form-control" name="orden" required id="orden" autocomplete="off">
        <p id="p6"></p>
      </div>
    </div>
    <div class=" mt-3">
      <label for="numeroSerieMedidor" class="col-auto col-form-label">Código de Cliente:</label>
      <div class="col-auto">
        <input type="text" class="form-control" name="codigoCliente" id="codigoCliente" onkeyup="mayus(this);" autocomplete="off">
        <p id="p7"></p>
      </div>
    </div>    

    <div class="mt-3">
      <button type="button" class="btn btn-success col-sm-2 mt-2" onclick="sendForm()">Guardar y Continuar</button>
      <button type="submit" class="btn btn-primary col-sm-2 mt-2" onclick="this.form.action='?controller=lote&action=save'">Guardar y Salir</button>
      <button type="button" class="btn btn-secondary col-sm-2 mt-2" onclick="location.href='?controller=lote&action=show'">Cancelar</button>
    </div>

    <div name="alerta2" id="alerta2" style="visibility: hidden" class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
      Datos Registrados Correctamente!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </div>

  </form>
</div>
<!-- scripts for functions select -->
<script>
  var datosEtapa = [<?php echo $GET_ETAPA_LIST; ?>];


  function getEtapa(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $("#" + idsel).append('<option value="1" selected>Sin Seleccion</option>')
    $.each(datos, function(key, value) {
      if (value.proyectoId == sel.value) {
        $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
      }
    });
  };
  var datosPoligono = [<?php echo $GET_POLIGONO_LIST; ?>];

  function getPoligono(sel, idsel, datos) {
    $("#" + idsel).find('option').remove().end();
    $("#" + idsel).append('<option value="1" selected>Sin Seleccion</option>')
    $.each(datos, function(key, value) {
      if (value.etapaId == sel.value) {
        $("#" + idsel).append('<option value="' + value.id + '">' + value.nombre + '</option>');
      }
    });
  };
</script>

<!-- validaciones -->
<script>
  $("#numeroLote").keyup(function() {
    var t = $("#numeroLote");
    text = t.val().replace(/ /g, "");
    t.val(text)
  });
  $("#numeroSerieMedidor").keyup(function() {
    var t = $("#numeroSerieMedidor");
    text = t.val().replace(/ /g, "");
    t.val(text)
  });

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }

  function validate() {

  }
</script>

<script>
  function sendForm() {
    var lote = [<?php echo $GET_LOTE_LIST; ?>];

    $.each(lote, function(key, value) {
      if (value.numeroLote == $("#numeroLote").val() && value.poligonoId == $("#poligonoId").val()) {


        $('#alerta').css("visibility", "visible");


      } else {
        // if($("#numeroLote").val()!= "" && $("#poligonoId").val()!=null)
        //{

        $.ajax({
          type: "POST",
          url: "?controller=lote&action=savecontinue",
          data: {
            proyectoId: $("#proyectoId").val(),
            etapaId: $("#etapaId").val(),
            poligonoId: $("#poligonoId").val(),
            numeroLote: $("#numeroLote").val(),
            numeroSerieMedidor: $("#numeroSerieMedidor").val(),
            orden: $("#orden").val()
          },
          success: function() {
            $('#alerta2').css("visibility", "visible");
            $("#numeroLote").val("")
            $("#orden").val("")
            $("#numeroSerieMedidor").val("")
            //  $('#proyectoId').get(0).selectedIndex = 0;
            //  $('#etapaId').get(0).selectedIndex = 0;
            //  $('#poligonoId').get(0).selectedIndex = 0;

          }
        });
        //}else
        //{
        // //  if($("#poligonoId").val()==null)
        //   //{
        //     $("#p1").text("Debe completar este campo").css({ 'color': 'red', 'font-size': '90%' })
        //     $("#p2").text("Debe completar este campo").css({ 'color': 'red', 'font-size': '90%' })
        //     $("#p3").text("Debe completar este campo").css({ 'color': 'red', 'font-size': '90%' })
        //   }
        //   if($("#numeroLote").val()=="")
        //   {
        //     $("#p4").text("Debe completar este campo").css({ 'color': 'red', 'font-size': '90%' })
        //   }
        //}

      }
    });

  }
</script>